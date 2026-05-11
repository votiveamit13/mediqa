<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\ConversationParticipant;
use App\Models\BlockedUser;
use App\Models\User;
use App\Events\MessageSent;
use App\Events\UserTyping;
use App\Events\UserOnlineStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    /**
     * Get authenticated user from any guard
     */
    private function getAuthenticatedUser()
    {
        return Auth::guard('nurse_middle')->check() ? Auth::guard('nurse_middle')->user() :
               (Auth::guard('healthcare_facilities')->check() ? Auth::guard('healthcare_facilities')->user() :
               (Auth::check() ? Auth::user() : null));
    }

    /**
     * Display chat interface
     */
    public function index()
    {
        $user = Auth::guard('nurse_middle')->user();
        $conversations = $this->getUserConversations($user->id);

        return view('chat.index', compact('conversations'));
    }

    /**
     * Get all conversations for a user
     */
    private function getUserConversations($userId)
    {
        $user = User::find($userId);

        if ($user->role === 1) { // Nurse
            return Conversation::with(['healthcare', 'latestMessage'])
                ->where('nurse_id', $userId)
                ->where('nurse_deleted', 0)
                ->orderBy('last_message_at', 'desc')
                ->get();
        } else { // Healthcare
            return Conversation::with(['nurse', 'latestMessage'])
                ->where('healthcare_id', $userId)
                ->where('healthcare_deleted', 0)
                ->orderBy('last_message_at', 'desc')
                ->get();
        }
    }

    /**
     * Get specific conversation
     */
    public function getConversation($conversationId)
    {
        $user = Auth::guard('nurse_middle')->user();

        $conversation = Conversation::with(['nurse', 'healthcare', 'messages.sender', 'job'])
            ->where('id', $conversationId)
            ->where(function($query) use ($user) {
                $query->where('nurse_id', $user->id)
                      ->orWhere('healthcare_id', $user->id);
            })
            ->firstOrFail();

        // Check if user is participant
        if (!$conversation->isParticipant($user->id)) {
            abort(403, 'Unauthorized access to conversation');
        }

        // Check if blocked
        if (BlockedUser::isEitherBlocked($conversation->nurse_id, $conversation->healthcare_id)) {
            $conversation->status = 'closed';
            $conversation->save();
        }

        // Mark messages as read
        $this->markMessagesAsRead($conversation->id, $user->id);

        // Update participant last seen
        $participant = ConversationParticipant::where('conversation_id', $conversation->id)
            ->where('user_id', $user->id)
            ->first();

        if ($participant) {
            $participant->updateLastSeen();
        }

        $otherParticipant = $conversation->getOtherParticipant($user->id);
        $isOnline = $this->checkUserOnline($otherParticipant->id);

        return view('chat.conversation', compact('conversation', 'otherParticipant', 'isOnline'));
    }

    /**
     * Send a new message
     */
    public function sendMessage(Request $request)
    {
        \Log::info('Chat message request:', $request->all());
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'message' => 'required|string|max:5000',
        ]);

        // Detect which guard is authenticated
        $user = Auth::guard('nurse_middle')->check() ? Auth::guard('nurse_middle')->user() : Auth::guard('healthcare_facilities')->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $conversation = Conversation::findOrFail($request->conversation_id);

        // Check if user is part of conversation
        if (!$conversation->isParticipant($user->id)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Check if conversation is closed due to blocking
        if ($conversation->status === 'closed') {
            return response()->json(['error' => 'This conversation has been closed'], 403);
        }

        // Check if blocked
        if (BlockedUser::isEitherBlocked($conversation->nurse_id, $conversation->healthcare_id)) {
            return response()->json(['error' => 'You cannot send messages in this conversation'], 403);
        }

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $user->id,
            'sender_type' => $user->role === 1 ? 'nurse' : 'healthcare',
            'message' => strip_tags($request->message),
            'message_type' => 'text',
        ]);

        // Update conversation
        $conversation->update([
            'last_message_id' => $message->id,
            'last_message_at' => now(),
        ]);

        // Update participants unread count
        ConversationParticipant::where('conversation_id', $conversation->id)
            ->where('user_id', '!=', $user->id)
            ->each(function($participant) {
                $participant->incrementUnread();
            });

        // Broadcast event only if Pusher is configured
        if (config('broadcasting.default') !== 'null') {
            try {
                broadcast(new MessageSent($message))->toOthers();
            } catch (\Exception $e) {
                \Log::error('Broadcast failed: ' . $e->getMessage());
            }
        }

        // if ($user->role === 1) {
        //     // Sender is nurse -> receiver is healthcare
        //     $receiver = DB::table("users")->find($conversation->healthcare_id);
        // } else {
        //     // Sender is healthcare -> receiver is nurse
        //     $receiver = DB::table("users")->find($conversation->nurse_id);
        // }

        // //print_r($receiver);die;

        // if ($receiver && $receiver->email_notification == 1) {

        //     $htmlBody = view('email.chat_message_notification', [
        //         'sender' => $user,
        //         'receiver' => $receiver,
        //         'messageText' => strip_tags($request->message),
        //         'conversation' => $conversation,
        //     ])->render();

        //     \App\Helpers\ZeptoMailHelper::sendMail(
        //         $receiver->email,
        //         "New Message Received - Mediqa",
        //         $htmlBody
        //     );
        // }

        return response()->json([
            'success' => true,
            'message' => $message->load(['sender', 'attachments'])
        ]);
    }

    /**
     * Start new conversation
     */
    public function startConversation(Request $request)
    {
        $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',
            'job_id' => 'nullable|exists:jobs,id',
        ]);

        $sender = Auth::guard('nurse_middle')->user();
        $recipient = User::find($request->recipient_id);

        // Validate roles - must be different (nurse <-> healthcare)
        if ($sender->role === $recipient->role) {
            return response()->json([
                'error' => 'Can only chat between nurses and healthcare facilities'
            ], 422);
        }

        // Check if either user has blocked the other
        if (BlockedUser::isEitherBlocked($sender->id, $recipient->id)) {
            return response()->json([
                'error' => 'Cannot start conversation due to block status'
            ], 403);
        }

        // Determine who is nurse and who is healthcare
        $nurseId = $sender->role === 1 ? $sender->id : $recipient->id;
        $healthcareId = $sender->role === 2 ? $sender->id : $recipient->id;

        // Check if conversation already exists
        $existingConversation = Conversation::where('nurse_id', $nurseId)
            ->where('healthcare_id', $healthcareId)
            ->where('status', '!=', 'closed')
            ->first();

        if ($existingConversation) {
            return response()->json([
                'conversation_id' => $existingConversation->id,
                'exists' => true
            ]);
        }

        // Create new conversation
        $conversation = Conversation::create([
            'subject' => $request->subject ?? 'New Conversation',
            'job_id' => $request->job_id,
            'nurse_id' => $nurseId,
            'healthcare_id' => $healthcareId,
            'status' => 'active',
        ]);

        // Create first message
        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $sender->id,
            'sender_type' => $sender->role === 1 ? 'nurse' : 'healthcare',
            'message' => strip_tags($request->message),
            'message_type' => 'text',
        ]);

        // Update conversation
        $conversation->update([
            'last_message_id' => $message->id,
            'last_message_at' => now(),
        ]);

        // Create participants
        ConversationParticipant::create([
            'conversation_id' => $conversation->id,
            'user_id' => $sender->id,
        ]);

        ConversationParticipant::create([
            'conversation_id' => $conversation->id,
            'user_id' => $recipient->id,
        ]);



        return response()->json([
            'success' => true,
            'conversation_id' => $conversation->id
        ]);
    }

    /**
     * Mark messages as read
     */
    private function markMessagesAsRead($conversationId, $userId)
    {
        $messagesQuery = Message::where('conversation_id', $conversationId)
            ->where('sender_id', '!=', $userId)
            ->where('is_read', 0);

        $messageIds = $messagesQuery->pluck('id')->toArray();

        if (!empty($messageIds)) {
            $messagesQuery->update([
                'is_read' => 1,
                'read_at' => now()
            ]);

            // Broadcast read status to sender
            try {
                broadcast(new \App\Events\MessageStatusUpdated($conversationId, $messageIds, 'read'))->toOthers();
            } catch (\Exception $e) {
                \Log::error('Broadcast read status failed: ' . $e->getMessage());
            }
        }

        ConversationParticipant::where('conversation_id', $conversationId)
            ->where('user_id', $userId)
            ->update(['unread_count' => 0]);
    }

    /**
     * Upload file attachment
     */
    // public function uploadAttachment(Request $request)
    // {
    //     $request->validate([
    //         'conversation_id' => 'required|exists:conversations,id',
    //         'file' => 'required|file|max:10240', // 10MB max
    //     ]);

    //     $user = Auth::guard('nurse_middle')->user();
    //     $conversation = Conversation::findOrFail($request->conversation_id);

    //     // Check if user is participant
    //     if (!$conversation->isParticipant($user->id)) {
    //         return response()->json(['error' => 'Unauthorized'], 403);
    //     }

    //     $file = $request->file('file');

    //     // Get file size before moving (temp file will be deleted after move)
    //     $fileSize = $file->getSize();

    //     // Create directory if it doesn't exist
    //     $uploadPath = public_path('uploads/chat_file');
    //     if (!file_exists($uploadPath)) {
    //         mkdir($uploadPath, 0755, true);
    //     }

    //     // Generate unique filename
    //     $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

    //     // Move file to public/uploads/chat_file (root public directory)
    //     $file->move($uploadPath, $fileName);

    //     // Store relative path from public folder
    //     $filePath = 'uploads/chat_file/' . $fileName;

    //     $message = Message::create([
    //         'conversation_id' => $conversation->id,
    //         'sender_id' => $user->id,
    //         'sender_type' => $user->role === 1 ? 'nurse' : 'healthcare',
    //         'message' => 'File: ' . $file->getClientOriginalName(),
    //         'message_type' => 'file',
    //         'file_url' => asset($filePath),
    //         'file_name' => $file->getClientOriginalName(),
    //         'file_size' => $fileSize,
    //     ]);

    //     // Create attachment record
    //     $message->attachments()->create([
    //         'file_name' => $file->getClientOriginalName(),
    //         'file_path' => $filePath,
    //         'file_type' => $file->getMimeType(),
    //         'file_size' => $fileSize,
    //     ]);

    //     // Update conversation
    //     $conversation->update([
    //         'last_message_id' => $message->id,
    //         'last_message_at' => now(),
    //     ]);

    //     // Broadcast event
    //     broadcast(new MessageSent($message))->toOthers();

    //     return response()->json([
    //         'success' => true,
    //         'message' => $message->load(['sender', 'attachments'])
    //     ]);
    // }

    public function uploadAttachment(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'file' => 'required|file|max:10240', // 10MB max
        ]);

        // Detect which guard is authenticated
        $user = Auth::guard('nurse_middle')->check() ? Auth::guard('nurse_middle')->user() :
                (Auth::guard('healthcare_facilities')->check() ? Auth::guard('healthcare_facilities')->user() :
                (Auth::check() ? Auth::user() : null));

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $conversation = Conversation::findOrFail($request->conversation_id);

        // Check if user is participant
        if (!$conversation->isParticipant($user->id)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $file = $request->file('file');

        // ✅ IMPORTANT: Get all file details BEFORE moving the file
        $fileSize = $file->getSize();
        $fileType = $file->getMimeType();
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();

        // Create directory if it doesn't exist
        $uploadPath = public_path('uploads' . DIRECTORY_SEPARATOR . 'chat_file');

        // Ensure the directory exists
        if (!is_dir($uploadPath)) {
            if (!@mkdir($uploadPath, 0755, true)) {
                \Log::error('mkdir failed', ['path' => $uploadPath]);
            }
        }

        // Double-check directory exists and is writable
        if (!is_writable($uploadPath)) {
            \Log::error('Upload directory is not writable', [
                'path' => $uploadPath,
                'exists' => file_exists($uploadPath),
                'is_dir' => is_dir($uploadPath)
            ]);
            return response()->json([
                'error' => 'Upload directory is not writable. Please check permissions.',
                'debug_path' => $uploadPath
            ], 500);
        }

        // Generate unique filename
        $fileName = time() . '_' . uniqid() . '.' . $extension;
        $fullPath = rtrim($uploadPath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $fileName;

        // Use PHP's native move_uploaded_file for better Windows compatibility
        if (!move_uploaded_file($file->getPathname(), $fullPath)) {
            \Log::error('move_uploaded_file failed', [
                'from' => $file->getPathname(),
                'to' => $fullPath,
                'upload_path' => $uploadPath,
                'is_writable' => is_writable($uploadPath),
                'file_exists' => file_exists($uploadPath)
            ]);
            return response()->json([
                'error' => 'Failed to upload file. Please check directory permissions.',
                'debug_path' => $fullPath
            ], 500);
        }

        // Store relative path (use forward slashes for URLs)
        $filePath = 'uploads/chat_file/' . $fileName;

        // Create message
        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $user->id,
            'sender_type' => $user->role === 1 ? 'nurse' : 'healthcare',
            'message' => 'File: ' . $originalName,
            'message_type' => 'file',
            'file_url' => asset($filePath),
            'file_name' => $originalName,
            'file_size' => $fileSize,
        ]);

        // Create attachment record
        $message->attachments()->create([
            'file_name' => $originalName,
            'file_path' => $filePath,
            'file_type' => $fileType, // ✅ use stored mime type
            'file_size' => $fileSize,
        ]);

        // Update conversation
        $conversation->update([
            'last_message_id' => $message->id,
            'last_message_at' => now(),
        ]);

        // Broadcast event
        broadcast(new MessageSent($message))->toOthers();

        return response()->json([
            'success' => true,
            'message' => $message->load(['sender', 'attachments'])
        ]);
    }

    /**
     * Delete message
     */
    public function deleteMessage(Request $request)
    {
        $request->validate([
            'message_id' => 'required|exists:messages,id',
        ]);

        $user = Auth::guard('nurse_middle')->user();
        $message = Message::findOrFail($request->message_id);

        // Check if user is sender or receiver
        $conversation = Conversation::find($message->conversation_id);
        if (!$conversation || !$conversation->isParticipant($user->id)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if ($message->sender_id === $user->id) {
            $message->deleted_by_sender = 1;
        } else {
            $message->deleted_by_receiver = 1;
        }

        $message->save();

        // Check if both deleted, then delete permanently
        if ($message->deleted_by_sender && $message->deleted_by_receiver) {
            $message->delete();
        }

        return response()->json(['success' => true]);
    }

    /**
     * Block user
     */
    public function blockUser(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'reason' => 'nullable|string|max:500',
        ]);

        $user = Auth::guard('nurse_middle')->user();
        $conversation = Conversation::findOrFail($request->conversation_id);

        // Check if user is participant
        if (!$conversation->isParticipant($user->id)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $blockedUserId = $user->id === $conversation->nurse_id
            ? $conversation->healthcare_id
            : $conversation->nurse_id;

        BlockedUser::create([
            'blocker_id' => $user->id,
            'blocked_id' => $blockedUserId,
            'reason' => $request->reason,
        ]);

        $conversation->update([
            'status' => 'closed',
            $user->role === 1 ? 'nurse_blocked' : 'healthcare_blocked' => 1
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Search conversations
     */
    public function search(Request $request)
    {
        $query = $request->get('q', '');
        $user = Auth::guard('nurse_middle')->user();

        $conversations = Conversation::where(function($q) use ($user) {
                $q->where('nurse_id', $user->id)
                  ->orWhere('healthcare_id', $user->id);
            })
            ->where(function($q) use ($query) {
                $q->where('subject', 'LIKE', "%{$query}%")
                  ->orWhereHas('messages', function($subQ) use ($query) {
                      $subQ->where('message', 'LIKE', "%{$query}%");
                  });
            })
            ->with(['nurse', 'healthcare', 'latestMessage'])
            ->orderBy('last_message_at', 'desc')
            ->get();

        return response()->json(['conversations' => $conversations]);
    }

    /**
     * Mark conversation as read
     */
    public function markAsRead(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
        ]);

        $user = $this->getAuthenticatedUser();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $this->markMessagesAsRead($request->conversation_id, $user->id);

        return response()->json(['success' => true]);
    }

    /**
     * Mark messages as delivered (when user opens chat)
     */
    public function markAsDelivered(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
        ]);

        $user = $this->getAuthenticatedUser();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $conversation = Conversation::findOrFail($request->conversation_id);

        // Check if user is participant
        if (!$conversation->isParticipant($user->id)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Mark all messages from other user as delivered
        $messages = Message::where('conversation_id', $conversation->id)
            ->where('sender_id', '!=', $user->id)
            ->where('is_delivered', 0)
            ->get();

        $updatedMessages = [];
        foreach ($messages as $message) {
            $message->markAsDelivered();
            $updatedMessages[] = $message;
        }

        // Broadcast delivery status to sender
        if (count($updatedMessages) > 0) {
            broadcast(new \App\Events\MessageStatusUpdated($conversation->id, $updatedMessages->pluck('id')->toArray(), 'delivered'))->toOthers();
        }

        return response()->json([
            'success' => true,
            'message_ids' => $messages->pluck('id')
        ]);
    }

    /**
     * Mark specific message as read (when it becomes visible)
     */
    public function markMessageRead(Request $request)
    {
        $request->validate([
            'message_id' => 'required|exists:messages,id',
        ]);

        $user = $this->getAuthenticatedUser();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $message = Message::findOrFail($request->message_id);
        $conversation = Conversation::find($message->conversation_id);

        // Check if user is participant
        if (!$conversation || !$conversation->isParticipant($user->id)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Only mark as read if not already read
        if (!$message->is_read) {
            $message->markAsRead();

            // Also mark all previous messages as delivered and read
            Message::where('conversation_id', $conversation->id)
                ->where('sender_id', '!=', $user->id)
                ->where('id', '<=', $message->id)
                ->where('is_delivered', 0)
                ->update([
                    'is_delivered' => 1,
                    'delivered_at' => now()
                ]);

            $updatedIds = Message::where('conversation_id', $conversation->id)
                ->where('sender_id', '!=', $user->id)
                ->where('id', '<=', $message->id)
                ->where('is_read', 0)
                ->pluck('id')
                ->toArray();

            if (!in_array($message->id, $updatedIds)) {
                $updatedIds[] = $message->id;
            }

            Message::where('conversation_id', $conversation->id)
                ->where('sender_id', '!=', $user->id)
                ->where('id', '<=', $message->id)
                ->where('is_read', 0)
                ->update([
                    'is_read' => 1,
                    'read_at' => now(),
                    'is_delivered' => 1,
                    'delivered_at' => now()
                ]);

            // Broadcast read status to sender for all updated messages
            broadcast(new \App\Events\MessageStatusUpdated($conversation->id, $updatedIds, 'read'))->toOthers();
        }

        return response()->json([
            'success' => true,
            'message_id' => $message->id,
            'status' => 'read'
        ]);
    }

    /**
     * Update typing status
     */
    public function typingStatus(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'is_typing' => 'boolean',
        ]);

        $user = $this->getAuthenticatedUser();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $conversation = Conversation::findOrFail($request->conversation_id);

        if (!$conversation->isParticipant($user->id)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $otherParticipant = $conversation->getOtherParticipant($user->id);

        broadcast(new UserTyping(
            $conversation->id,
            $user->id,
            $user->name . ' ' . ($user->lastname ?? ''),
            $user->profile_img,
            $request->is_typing
        ))->toOthers();

        return response()->json(['success' => true]);
    }

    /**
     * Update online status
     */
    public function updateOnlineStatus(Request $request)
    {
        $request->validate([
            'is_online' => 'boolean',
        ]);

        $user = $this->getAuthenticatedUser();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $isOnline = $request->is_online ?? true;

        // Update cache with user's online status
        if ($isOnline) {
            cache()->set("user_{$user->id}_online", true, now()->addMinutes(5));
        } else {
            cache()->forget("user_{$user->id}_online");
        }

        // Broadcast status to all relevant channels
        broadcast(new UserOnlineStatus($user->id, $isOnline, $isOnline ? null : now()))->toOthers();

        return response()->json(['success' => true, 'is_online' => $isOnline]);
    }

    /**
     * Check user online status
     */
    public function checkUserStatus($userId)
    {
        $isOnline = cache()->get("user_{$userId}_online", false);

        return response()->json([
            'success' => true,
            'user_id' => $userId,
            'is_online' => $isOnline,
            'last_seen' => $isOnline ? null : now()->toIso8601String()
        ]);
    }

    /**
     * Get unread count
     */
    public function unreadCount()
    {
        $user = $this->getAuthenticatedUser();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $count = ConversationParticipant::where('user_id', $user->id)
            ->sum('unread_count');

        return response()->json(['unread_count' => $count]);
    }

    /**
     * Delete conversation
     */
    public function deleteConversation(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
        ]);

        $user = $this->getAuthenticatedUser();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $conversation = Conversation::findOrFail($request->conversation_id);

        if (!$conversation->isParticipant($user->id)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if ($user->role === 1) {
            $conversation->update(['nurse_deleted' => 1]);
        } else {
            $conversation->update(['healthcare_deleted' => 1]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Check if user is online
     */
    private function checkUserOnline($userId)
    {
        // This is a simplified check - in production, use Redis or similar
        return cache()->get("user_{$userId}_online", false);
    }

    /**
     * Archive conversation
     */
    public function archiveConversation(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
        ]);

        $user = $this->getAuthenticatedUser();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $conversation = Conversation::findOrFail($request->conversation_id);

        if (!$conversation->isParticipant($user->id)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $conversation->update(['status' => 'archived']);

        return response()->json(['success' => true]);
    }
}
