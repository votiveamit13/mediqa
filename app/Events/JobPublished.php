<?php

namespace App\Events;

use App\Models\JobsModel;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class JobPublished implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $job;
    public $nurseIds;

    /**
     * Create a new event instance.
     */
    public function __construct(JobsModel $job, array $nurseIds = [])
    {
        $this->job = $job->load(['postedBy']);
        $this->nurseIds = $nurseIds;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        $channels = [];

        // If specific nurse IDs are provided, broadcast only to them
        if (!empty($this->nurseIds)) {
            foreach ($this->nurseIds as $nurseId) {
                $channels[] = new PrivateChannel('user.' . $nurseId);
            }
        } else {
            // Broadcast to all nurses with app notifications enabled
            $nurses = User::whereHasAppNotifications()
                ->pluck('id');
            
            foreach ($nurses as $nurseId) {
                $channels[] = new PrivateChannel('user.' . $nurseId);
            }
        }

        return $channels;
    }

    /**
     * The event's broadcast name.
     */
    public function broadcastAs(): string
    {
        return 'job.published';
    }

    /**
     * Get the data to broadcast.
     */
    public function broadcastWith(): array
    {
        return [
            'job_id' => $this->job->id,
            'title' => $this->job->title ?? 'New Job Opportunity',
            'facility_name' => $this->job->postedBy->name ?? 'Healthcare Facility',
            'location' => $this->job->location ?? 'Location TBD',
            'specialty' => $this->job->specialty ?? 'General',
            'message' => 'A new job matching your preferences has been posted',
            'created_at' => $this->job->created_at->toIso8601String(),
        ];
    }
}
