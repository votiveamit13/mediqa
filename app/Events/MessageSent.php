<?php

namespace App\Events;

use App\Models\Message;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $recipientId;
    public $shouldNotifyRecipient;

    /**
     * Create a new event instance.
     */
    public function __construct(Message $message)
    {
        $this->message = $message->load('sender', 'conversation');

        // Determine the recipient ID
        $conversation = $this->message->conversation;
        if ($this->message->sender_id == $conversation->nurse_id) {
            $this->recipientId = $conversation->healthcare_id;
        } else {
            $this->recipientId = $conversation->nurse_id;
        }

        // Check if recipient has in-app notifications enabled
        $recipient = User::find($this->recipientId);
        $this->shouldNotifyRecipient = $recipient && $recipient->hasAppNotification();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        $channels = [
            new PrivateChannel('conversation.' . $this->message->conversation_id),
        ];

        // Only broadcast to user channel if recipient has app notifications enabled
        if ($this->shouldNotifyRecipient) {
            $channels[] = new PrivateChannel('user.' . $this->recipientId);
        }

        return $channels;
    }

    /**
     * The event's broadcast name.
     */
    public function broadcastAs(): string
    {
        return 'message.sent';
    }

    /**
     * Get the data to broadcast.
     */
    public function broadcastWith(): array
    {
        $data = [
            'id' => $this->message->id,
            'conversation_id' => $this->message->conversation_id,
            'sender_id' => $this->message->sender_id,
            'sender_name' => $this->message->sender->name . ' ' . ($this->message->sender->lastname ?? ''),
            'sender_avatar' => $this->message->sender->profile_img,
            'sender_role' => $this->message->sender->role,
            'message' => $this->message->message,
            'message_type' => $this->message->message_type,
            'file_url' => $this->message->file_url,
            'file_name' => $this->message->file_name,
            'file_size' => $this->message->file_size,
            'is_read' => $this->message->is_read,
            'created_at' => $this->message->created_at->toIso8601String(),
        ];

        // Include attachments if present
        if ($this->message->attachments->count() > 0) {
            $data['attachments'] = $this->message->attachments->map(function ($attachment) {
                return [
                    'id' => $attachment->id,
                    'file_name' => $attachment->file_name,
                    'file_path' => $attachment->file_path,
                    'file_type' => $attachment->file_type,
                    'file_size' => $attachment->file_size,
                    'file_url' => asset($attachment->file_path),
                    'is_image' => $attachment->is_image,
                    'file_icon' => $attachment->file_icon,
                    'formatted_file_size' => $attachment->formatted_file_size,
                ];
            })->toArray();
        }

        return $data;
    }
}
