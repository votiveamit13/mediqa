<?php

namespace App\Http\Controllers\medical_facilities;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use App\Models\JobsModel;
use App\Models\BlockedUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    /**
     * Display healthcare chat dashboard
     */
    public function index()
    {
        $user = Auth::guard('healthcare_facilities')->user();

        $conversations = Conversation::with(['nurse', 'latestMessage'])
            ->where('healthcare_id', $user->id)
            ->where('healthcare_deleted', 0)
            ->orderBy('last_message_at', 'desc')
            ->paginate(20);

        $unreadCount = Message::whereHas('conversation', function($q) use ($user) {
                $q->where('healthcare_id', $user->id);
            })
            ->where('sender_id', '!=', $user->id)
            ->where('is_read', 0)
            ->count();

        return view('healthcare.chat.index', compact('conversations', 'unreadCount'));
    }

    /**
     * Show conversation with nurse
     */
    public function showConversation($id)
    {
        $user = Auth::guard('healthcare_facilities')->user();

        $conversation = Conversation::with(['nurse', 'messages.sender', 'messages.attachments', 'job'])
            ->where('id', $id)
            ->where('healthcare_id', $user->id)
            ->firstOrFail();

        // Check if blocked
        if (BlockedUser::isBlocked($conversation->nurse_id, $user->id)) {
            return redirect()->route('medical-facilities.chat.index')
                ->with('error', 'You have been blocked by this nurse');
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
                \Log::error('Broadcast read status failed: ' . $e->getMessage());
            }
        }

        $otherParticipant = $conversation->nurse;
        $isOnline = $this->checkUserOnline($otherParticipant->id);

        return view('healthcare.chat.conversation', compact('conversation', 'otherParticipant', 'isOnline'));
    }

    /**
     * View all nurses available to chat
     */
    public function nursesList()
    {
        $user = Auth::guard('healthcare_facilities')->user();

        $nurses = User::where('role', 1)
            ->where('status', 1)
            ->where('user_stage', '4') // Complete profile
            ->orderBy('name')
            ->paginate(20);

        return view('healthcare.chat.nurses_list', compact('nurses'));
    }

    /**
     * Start conversation from nurse profile
     */
    public function chatFromNurseProfile($nurseId)
    {
        $user = Auth::guard('healthcare_facilities')->user();
        $nurse = User::findOrFail($nurseId);

        // Check if conversation exists
        $conversation = Conversation::where('nurse_id', $nurseId)
            ->where('healthcare_id', $user->id)
            ->first();

        if ($conversation) {
            return redirect()->route('healthcare.chat.show', $conversation->id);
        }

        return view('medical_facilities.chat.start_from_profile', compact('nurse'));
    }

    /**
     * Get conversations related to specific job
     */
    public function jobConversations($jobId)
    {
        $user = Auth::guard('healthcare_facilities')->user();

        $conversations = Conversation::with(['nurse', 'latestMessage'])
            ->where('healthcare_id', $user->id)
            ->where('job_id', $jobId)
            ->orderBy('last_message_at', 'desc')
            ->get();

        return response()->json(['conversations' => $conversations]);
    }

    /**
     * Check if user is online
     */
    private function checkUserOnline($userId)
    {
        return cache()->get("user_{$userId}_online", false);
    }

    /**
     * Get nurse applications with chat status
     */
    public function applicationsWithChat()
    {
        $user = Auth::guard('healthcare_facilities')->user();

        $applications = DB::table('nurse_applications')
            ->join('users', 'nurse_applications.nurse_id', '=', 'users.id')
            ->leftJoin('conversations', function($join) use ($user) {
                $join->on('conversations.nurse_id', '=', 'users.id')
                     ->where('conversations.healthcare_id', '=', $user->id);
            })
            ->select(
                'nurse_applications.*',
                'users.name',
                'users.lastname',
                'users.profile_img',
                'conversations.id as conversation_id',
                'conversations.last_message_at'
            )
            ->where('nurse_applications.job_id', '=', request('job_id'))
            ->orderBy('conversations.last_message_at', 'desc')
            ->get();

        return response()->json(['applications' => $applications]);
    }
}
