<?php

namespace App\Http\Controllers\medical_facilities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;
use App\Models\Message;

class NotificationController extends Controller
{
    public function getNotifications(Request $request)
    {
        $user = $this->getAuthUser();

        if (!$user) {
            return response()->json(['success' => false], 401);
        }

        $perPage = 15;
        $page = (int) $request->get('page', 1);

        // =========================
        // Notifications (Laravel)
        // =========================
        $notifQuery = DatabaseNotification::where('notifiable_id', $user->id)
            ->where('notifiable_type', get_class($user));

        $notifications = $notifQuery->get()->map(function ($n) {
            return $this->formatNotification($n);
        });

        $notifUnread = (clone $notifQuery)->whereNull('read_at')->count();

        // =========================
        // Messages (FIXED)
        // =========================
        $messages = Message::whereHas('conversation', function ($q) use ($user) {

            if (Auth::guard('nurse_middle')->check()) {
                $q->where('nurse_id', $user->id);
            }

            if (Auth::guard('healthcare_facilities')->check()) {
                $q->where('healthcare_id', $user->id); // ✅ FIX
            }

        })
        ->where('sender_id', '!=', $user->id)
        ->orderBy('created_at', 'desc')
        ->limit(10)
        ->get()
        ->map(function ($msg) use ($user) {

            $isHealthcare = Auth::guard('healthcare_facilities')->check();

            return [
                'id' => 'msg_' . $msg->id,
                'type' => 'message',
                'title' => 'New message',
                'body' => $msg->message ?? 'New message received',
                'icon' => 'message',
                'url' => $isHealthcare
                    ? url('/healthcare-facilities/chat/conversation/' . $msg->conversation_id)
                    : url('/nurse/chat/conversation/' . $msg->conversation_id),
                'is_read' => $msg->is_read == 1,
                'created_at' => $msg->created_at->toISOString(),
                'created_at_human' => $msg->created_at->diffForHumans(),
            ];
        });

        // =========================
        // Unread messages (FIXED)
        // =========================
        $messageUnread = Message::whereHas('conversation', function ($q) use ($user) {

            if (Auth::guard('nurse_middle')->check()) {
                $q->where('nurse_id', $user->id);
            }

            if (Auth::guard('healthcare_facilities')->check()) {
                $q->where('healthcare_id', $user->id); // ✅ FIX
            }

        })
        ->where('sender_id', '!=', $user->id)
        ->where('is_read', 0)
        ->count();

        // =========================
        // Merge + paginate
        // =========================
        $all = collect($notifications)
            ->merge($messages)
            ->sortByDesc('created_at')
            ->values();

        $total = $all->count();

        $paginated = $all->slice(($page - 1) * $perPage, $perPage)->values();

        return response()->json([
            'success' => true,
            'unread_count' => $notifUnread + $messageUnread,
            'notifications' => $paginated,
            'has_more' => ($page * $perPage) < $total,
            'total' => $total,
            'per_page' => $perPage,
            'current_page' => $page,
        ]);
    }

    public function markAsRead(Request $request)
    {
        $user = $this->getAuthUser();

        if (!$user) {
            return response()->json(['success' => false], 401);
        }

        $id = $request->notification_id;

        if (str_starts_with($id, 'msg_')) {
            $msgId = str_replace('msg_', '', $id);

            $message = Message::where('id', $msgId)
                ->where('sender_id', '!=', $user->id)
                ->first();

            if ($message && $message->is_read == 0) {
                $message->update([
                    'is_read' => 1,
                    'read_at' => now()
                ]);
            }
        } else {
            $notification = DatabaseNotification::where('id', $id)
                ->where('notifiable_id', $user->id)
                ->first();

            if ($notification && is_null($notification->read_at)) {
                $notification->markAsRead();
            }
        }

        return response()->json([
            'success' => true,
            'unread_count' => $this->getUnreadCount($user),
        ]);
    }

    public function markAllRead(Request $request)
    {
        $user = $this->getAuthUser();

        if (!$user) {
            return response()->json(['success' => false], 401);
        }

        DatabaseNotification::where('notifiable_id', $user->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        Message::whereHas('conversation', function ($q) use ($user) {

            if (Auth::guard('nurse_middle')->check()) {
                $q->where('nurse_id', $user->id);
            }

            if (Auth::guard('healthcare_facilities')->check()) {
                $q->where('healthcare_id', $user->id);
            }

        })
        ->where('sender_id', '!=', $user->id)
        ->where('is_read', 0)
        ->update([
            'is_read' => 1,
            'read_at' => now()
        ]);

        return response()->json([
            'success' => true,
            'unread_count' => 0,
        ]);
    }

    // =========================
    // Helpers
    // =========================
    private function getUnreadCount($user)
    {
        $notifUnread = DatabaseNotification::where('notifiable_id', $user->id)
            ->whereNull('read_at')
            ->count();

        $messageUnread = Message::whereHas('conversation', function ($q) use ($user) {

            if (Auth::guard('nurse_middle')->check()) {
                $q->where('nurse_id', $user->id);
            }

            if (Auth::guard('healthcare_facilities')->check()) {
                $q->where('healthcare_id', $user->id);
            }

        })
        ->where('sender_id', '!=', $user->id)
        ->where('is_read', 0)
        ->count();

        return $notifUnread + $messageUnread;
    }

        private function formatNotification(DatabaseNotification $n): array
    {
        $data = $n->data;

        $typeClass = class_basename($n->type);
        $type = $this->resolveType($typeClass, $data);

        $title = $data['title'] ?? $this->defaultTitle($type, $data);

        $body = $data['message'] ?? $data['body'] ?? 'You have a new notification';

        $url = $this->resolveUrl($type, $data);

        return [
            'id' => $n->id,
            'type' => $type,
            'title' => $title,
            'body' => $body,
            'icon' => $this->iconForType($type),
            'url' => $url,
            'is_read' => !is_null($n->read_at),
            'created_at_human' => $n->created_at->diffForHumans(),
            'created_at' => $n->created_at->toISOString(),
        ];
    }

    private function resolveType(string $typeClass, array $data): string
    {
        if (str_contains(strtolower($typeClass), 'job')) {
            return 'job';
        }

        if (str_contains(strtolower($typeClass), 'message') || isset($data['conversation_id'])) {
            return 'message';
        }

        return 'system';
    }

    private function defaultTitle(string $type, array $data): string
    {
        return match ($type) {
            'job' => 'New job match' . (isset($data['facility_name']) ? ' from ' . $data['facility_name'] : ''),
            'message' => 'New message' . (isset($data['sender_name']) ? ' from ' . $data['sender_name'] : ''),
            default => 'Notification',
        };
    }

    private function iconForType(string $type): string
    {
        return match ($type) {
            'job' => 'briefcase',
            'message' => 'message',
            default => 'bell',
        };
    }

    private function resolveUrl(string $type, array $data): string
    {
        $guard = Auth::guard('nurse_middle')->check() ? 'nurse' : 'healthcare';

        if ($type === 'job' && isset($data['job_id'])) {
            return $guard === 'nurse'
                ? route('nurse.job_details', $data['job_id'])
                : '#';
        }

        if ($type === 'message' && isset($data['conversation_id'])) {
            return $guard === 'nurse'
                ? url('nurse/chat/conversation/' . $data['conversation_id'])
                : url('healthcare-facilities/chat/conversation/' . $data['conversation_id']);
        }

        return $data['url'] ?? '#';
    }

    private function getAuthUser()
    {
        if (Auth::guard('nurse_middle')->check()) {
            return Auth::guard('nurse_middle')->user();
        }

        if (Auth::guard('healthcare_facilities')->check()) {
            return Auth::guard('healthcare_facilities')->user();
        }

        return null;
    }

    public function notificationPage()
    {
        return view('medical_facilities.notification-list');
    }
}