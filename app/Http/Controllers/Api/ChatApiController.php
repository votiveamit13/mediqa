<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\ConversationParticipant;
use App\Models\BlockedUser;
use App\Events\MessageSent;
use App\Events\UserTyping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatApiController extends Controller
{
    /**
     * Get all conversations for authenticated user
     */
    public function conversations()
    {
        $user = Auth::user();

        $conversations = Conversation::with(['nurse', 'healthcare', 'latestMessage'])
            ->where(function($query) use ($user) {
                $query->where('nurse_id', $user->id)
                      ->orWhere('healthcare_id', $user->id);
            })
            ->where(function($query) use ($user) {
                if ($user->role === 1) {
                    $query->where('nurse_deleted', 0);
                } else {
                    $query->where('healthcare_deleted', 0);
                }
            })
            ->orderBy('last_message_at', 'desc')
            ->paginate(20);

        return response()->json([
            'success' => true,
            'data' => [
                'conversations' => $conversations->items(),
                'pagination' => [
                    'current_page' => $conversations->currentPage(),
                    'total' => $conversations->total(),
                    'per_page' => $conversations->perPage(),
                    'last_page' => $conversations->lastPage(),
                ]
            ]
        ]);
    }

    /**
     * Get specific conversation with messages
     */
    public function conversation($id)
    {
        $user = Auth::user();

        $conversation = Conversation::with(['nurse', 'healthcare', 'messages.sender', 'job'])
            ->where('id', $id)
            ->where(function($query) use ($user) {
                $query->where('nurse_id', $user->id)
                      ->orWhere('healthcare_id', $user->id);
            })
            ->first();

        if (!$conversation) {
            return response()->json([
                'success' => false,
                'message' => 'Conversation not found'
            ], 404);
        }

        // Mark messages as read
        $messagesQuery = Message::where('conversation_id', $id)
            ->where('sender_id', '!=', $user->id)
            ->where('is_read', 0);

        $messageIds = $messagesQuery->pluck('id')->toArray();

        if (!empty($messageIds)) {
            $messagesQuery->update(['is_read' => 1, 'read_at' => now()]);

            // Broadcast read status to sender
            try {
                broadcast(new \App\Events\MessageStatusUpdated($id, $messageIds, 'read'))->toOthers();
            } catch (\Exception $e) {
                \Log::error('API Broadcast read status failed: ' . $e->getMessage());
            }
        }

        return response()->json([
            'success' => true,
            'data' => ['conversation' => $conversation]
        ]);
    }

    /**
     * Send a message
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'message' => 'required|string|max:5000',
        ]);

        $user = Auth::user();
        $conversation = Conversation::findOrFail($request->conversation_id);

        if (!$conversation->isParticipant($user->id)) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        if ($conversation->status === 'closed') {
            return response()->json([
                'success' => false,
                'message' => 'This conversation has been closed'
            ], 403);
        }

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $user->id,
            'sender_type' => $user->role === 1 ? 'nurse' : 'healthcare',
            'message' => strip_tags($request->message),
            'message_type' => 'text',
        ]);

        $conversation->update([
            'last_message_id' => $message->id,
            'last_message_at' => now(),
        ]);

        ConversationParticipant::where('conversation_id', $conversation->id)
            ->where('user_id', '!=', $user->id)
            ->each(function($participant) {
                $participant->incrementUnread();
            });

        broadcast(new MessageSent($message))->toOthers();

        return response()->json([
            'success' => true,
            'data' => ['message' => $message]
        ]);
    }

    /**
     * Mark messages as read
     */
    public function markAsRead(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
        ]);

        $user = Auth::user();
        $id = $request->conversation_id;

        $messagesQuery = Message::where('conversation_id', $id)
            ->where('sender_id', '!=', $user->id)
            ->where('is_read', 0);

        $messageIds = $messagesQuery->pluck('id')->toArray();

        if (!empty($messageIds)) {
            $messagesQuery->update(['is_read' => 1, 'read_at' => now()]);

            // Broadcast read status to sender
            try {
                broadcast(new \App\Events\MessageStatusUpdated($id, $messageIds, 'read'))->toOthers();
            } catch (\Exception $e) {
                \Log::error('API markAsRead Broadcast failed: ' . $e->getMessage());
            }
        }

        ConversationParticipant::where('conversation_id', $id)
            ->where('user_id', $user->id)
            ->update(['unread_count' => 0]);

        return response()->json([
            'success' => true,
            'message' => 'Messages marked as read'
        ]);
    }

    /**
     * Delete a message
     */
    public function deleteMessage($id)
    {
        $user = Auth::user();
        $message = Message::findOrFail($id);

        $conversation = Conversation::find($message->conversation_id);

        if (!$conversation || !$conversation->isParticipant($user->id)) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        if ($message->sender_id === $user->id) {
            $message->deleted_by_sender = 1;
        } else {
            $message->deleted_by_receiver = 1;
        }

        $message->save();

        if ($message->deleted_by_sender && $message->deleted_by_receiver) {
            $message->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Message deleted'
        ]);
    }

    /**
     * Update typing status
     */
    public function typingStatus(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'is_typing' => 'required|boolean',
        ]);

        $user = Auth::user();
        $conversation = Conversation::findOrFail($request->conversation_id);

        if (!$conversation->isParticipant($user->id)) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        broadcast(new UserTyping(
            $conversation->id,
            $user->id,
            $user->name . ' ' . ($user->lastname ?? ''),
            $user->profile_img,
            $request->is_typing
        ))->toOthers();

        return response()->json([
            'success' => true,
            'message' => 'Typing status updated'
        ]);
    }

    /**
     * Get unread message count
     */
    public function unreadCount()
    {
        $user = Auth::user();

        $count = ConversationParticipant::where('user_id', $user->id)
            ->sum('unread_count');

        return response()->json([
            'success' => true,
            'data' => ['unread_count' => $count]
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

        $sender = Auth::user();
        $recipient = User::find($request->recipient_id);

        if ($sender->role === $recipient->role) {
            return response()->json([
                'success' => false,
                'message' => 'Can only chat between nurses and healthcare facilities'
            ], 422);
        }

        if (BlockedUser::isEitherBlocked($sender->id, $recipient->id)) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot start conversation due to block status'
            ], 403);
        }

        $nurseId = $sender->role === 1 ? $sender->id : $recipient->id;
        $healthcareId = $sender->role === 2 ? $sender->id : $recipient->id;

        $existingConversation = Conversation::where('nurse_id', $nurseId)
            ->where('healthcare_id', $healthcareId)
            ->where('status', '!=', 'closed')
            ->first();

        if ($existingConversation) {
            return response()->json([
                'success' => true,
                'data' => [
                    'conversation_id' => $existingConversation->id,
                    'exists' => true
                ]
            ]);
        }

        $conversation = Conversation::create([
            'subject' => $request->subject ?? 'New Conversation',
            'job_id' => $request->job_id,
            'nurse_id' => $nurseId,
            'healthcare_id' => $healthcareId,
            'status' => 'active',
        ]);

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $sender->id,
            'sender_type' => $sender->role === 1 ? 'nurse' : 'healthcare',
            'message' => strip_tags($request->message),
            'message_type' => 'text',
        ]);

        $conversation->update([
            'last_message_id' => $message->id,
            'last_message_at' => now(),
        ]);

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
            'data' => [
                'conversation_id' => $conversation->id,
                'exists' => false
            ]
        ]);
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

        $user = Auth::user();
        $conversation = Conversation::findOrFail($request->conversation_id);

        if (!$conversation->isParticipant($user->id)) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
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

        return response()->json([
            'success' => true,
            'message' => 'User blocked successfully'
        ]);
    }

    /**
     * Search conversations
     */
    public function search(Request $request)
    {
        $user = Auth::user();
        $query = $request->get('q', '');

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

        return response()->json([
            'success' => true,
            'data' => ['conversations' => $conversations]
        ]);
    }
}
