<?php

namespace App\Http\Controllers\nurse;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use App\Models\JobsModel;
use App\Models\NurseApplication;
use App\Models\BlockedUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    /**
     * Display nurse chat dashboard
     * Shows healthcare facilities from jobs the nurse has applied to
     */
    public function index()
    {
        $user = Auth::guard('nurse_middle')->user();

        // Get conversations from job applications
        $conversations = Conversation::with(['healthcare', 'latestMessage', 'job'])
            ->where('nurse_id', $user->id)
            ->where('nurse_deleted', 0)
            ->orderBy('last_message_at', 'desc')
            ->paginate(20);

        $unreadCount = Message::whereHas('conversation', function($q) use ($user) {
                $q->where('nurse_id', $user->id);
            })
            ->where('sender_id', '!=', $user->id)
            ->where('is_read', 0)
            ->count();

        // Get healthcare facilities from nurse's job applications
        $healthcareFacilities = DB::table('nurse_applications')
            ->join('users', 'nurse_applications.employer_id', '=', 'users.id')
            ->join('job_boxes', 'nurse_applications.job_id', '=', 'job_boxes.id')
            ->where('nurse_applications.nurse_id', $user->id)
            ->where('users.role', 2)
            ->where('users.status', 1)
            ->select(
                'users.id',
                'users.name',
                'users.lastname',
                'users.email',
                'users.profile_img',
                'job_boxes.job_title',
                'nurse_applications.id as application_id',
                'nurse_applications.status as application_status'
            )
            ->orderBy('users.name')
            ->get();

        return view('nurse.chat.index', compact('conversations', 'unreadCount', 'healthcareFacilities'));
    }

    /**
     * Show conversation with healthcare
     */
    public function showConversation($id)
    {
        $user = Auth::guard('nurse_middle')->user();

        $conversation = Conversation::with(['healthcare', 'messages.sender', 'messages.attachments', 'job'])
            ->where('id', $id)
            ->where('nurse_id', $user->id)
            ->firstOrFail();

        // Check if blocked
        if (BlockedUser::isBlocked($conversation->healthcare_id, $user->id)) {
            return redirect()->route('nurse.chat.index')
                ->with('error', 'You have been blocked by this healthcare facility');
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

        $otherParticipant = $conversation->healthcare;
        $isOnline = $this->checkUserOnline($otherParticipant->id);

        return view('nurse.chat.conversation', compact('conversation', 'otherParticipant', 'isOnline'));
    }

    /**
     * Start chat from job posting
     */
    public function chatFromJob($jobId)
    {
        $user = Auth::guard('nurse_middle')->user();
        $job = JobsModel::findOrFail($jobId);

        // Check if conversation exists
        $conversation = Conversation::where('nurse_id', $user->id)
            ->where('healthcare_id', $job->created_by ?? $job->user_id)
            ->where('job_id', $jobId)
            ->first();

        if ($conversation) {
            return redirect()->route('nurse.chat.show', $conversation->id);
        }

        $healthcare = User::find($job->created_by ?? $job->user_id);

        return view('nurse.chat.start_from_job', compact('job', 'healthcare'));
    }

    /**
     * Get healthcare facilities for dropdown (AJAX)
     * Shows facilities from nurse's job applications
     */
    public function getHealthcareFacilities()
    {
        $user = Auth::guard('nurse_middle')->user();

        // Get healthcare facilities from nurse's job applications
        $healthcareFacilities = DB::table('nurse_applications')
            ->join('users', 'nurse_applications.employer_id', '=', 'users.id')
            ->join('job_boxes', 'nurse_applications.job_id', '=', 'job_boxes.id')
            ->where('nurse_applications.nurse_id', $user->id)
            ->where('users.role', 2)
            ->where('users.status', 1)
            ->select(
                'users.id',
                'users.name',
                'users.lastname',
                'users.email',
                'users.profile_img',
                'job_boxes.title as job_title',
                'nurse_applications.id as application_id'
            )
            ->orderBy('users.name')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $healthcareFacilities
        ]);
    }

    /**
     * Auto-create conversation when nurse applies to a job
     * Call this from the job application submission
     */
    public function createConversationFromApplication($applicationId)
    {
        $application = NurseApplication::with(['job', 'health_care'])->find($applicationId);

        if (!$application) {
            return response()->json(['success' => false, 'message' => 'Application not found']);
        }

        $nurse = Auth::guard('nurse_middle')->user();
        $healthcare = $application->health_care;

        // Check if conversation already exists
        $conversation = Conversation::where('nurse_id', $nurse->id)
            ->where('healthcare_id', $healthcare->id)
            ->where('job_id', $application->job_id)
            ->first();

        if ($conversation) {
            return response()->json([
                'success' => true,
                'conversation_id' => $conversation->id,
                'exists' => true
            ]);
        }

        // Create new conversation
        $conversation = Conversation::create([
            'subject' => 'Job Application: ' . ($application->job->title ?? 'Position'),
            'job_id' => $application->job_id,
            'nurse_id' => $nurse->id,
            'healthcare_id' => $healthcare->id,
            'status' => 'active',
        ]);

        // Create initial system message
        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $nurse->id,
            'sender_type' => 'nurse',
            'message' => 'You have submitted your application for the position of ' . ($application->job->title ?? 'this role') . '. The healthcare facility will review your application.',
            'message_type' => 'system',
        ]);

        // Create participants
        \App\Models\ConversationParticipant::create([
            'conversation_id' => $conversation->id,
            'user_id' => $nurse->id,
        ]);

        \App\Models\ConversationParticipant::create([
            'conversation_id' => $conversation->id,
            'user_id' => $healthcare->id,
        ]);

        return response()->json([
            'success' => true,
            'conversation_id' => $conversation->id,
            'exists' => false
        ]);
    }

    /**
     * Check if user is online
     */
    private function checkUserOnline($userId)
    {
        return cache()->get("user_{$userId}_online", false);
    }
}