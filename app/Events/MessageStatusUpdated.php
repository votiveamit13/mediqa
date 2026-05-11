<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageStatusUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $messageIds;
    public $status;
    public $conversationId;

    /**
     * Create a new event instance.
     *
     * @param int $conversationId The conversation ID
     * @param array $messageIds Array of message IDs that were updated
     * @param string $status The new status: 'delivered' or 'read'
     */
    public function __construct(int $conversationId, array $messageIds, string $status)
    {
        $this->conversationId = $conversationId;
        $this->messageIds = $messageIds;
        $this->status = $status;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('conversation.' . $this->conversationId),
        ];
    }

    /**
     * The event's broadcast name.
     */
    public function broadcastAs(): string
    {
        return 'message.status.updated';
    }

    /**
     * Get the data to broadcast.
     */
    public function broadcastWith(): array
    {
        return [
            'message_ids' => $this->messageIds,
            'status' => $this->status,
            'updated_at' => now()->toIso8601String(),
        ];
    }
}
