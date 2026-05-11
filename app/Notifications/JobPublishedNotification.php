<?php

namespace App\Notifications;

use App\Models\JobsModel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Contracts\Queue\ShouldQueue;

class JobPublishedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $job;

    /**
     * Create a new notification instance.
     */
    public function __construct(JobsModel $job)
    {
        $this->job = $job;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        $channels = ['database'];

        // Only broadcast if user has app notifications enabled
        if ($notifiable->hasAppNotification()) {
            $channels[] = 'broadcast';
        }

        return $channels;
    }

    /**
     * Get the broadcastable representation of the notification.
     */
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'job_id' => $this->job->id,
            'title' => $this->job->title ?? 'New Job Opportunity',
            // 'facility_name' => $this->job->postedBy->name ?? 'Healthcare Facility',
            'facility_name' => optional($this->job->postedBy)->name ?? 'Healthcare Facility',
            'location' => $this->job->location ?? 'Location TBD',
            'specialty' => $this->job->specialty ?? 'General',
            'message' => 'A new job matching your preferences has been posted',
            'type' => 'job_published',
            'created_at' => $this->job->created_at->toIso8601String(),
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'job_id' => $this->job->id,
            'title' => $this->job->title ?? 'New Job Opportunity',
            // 'facility_name' => $this->job->postedBy->name ?? 'Healthcare Facility',
            'facility_name' => optional($this->job->postedBy)->name ?? 'Healthcare Facility',
            'location' => $this->job->location ?? 'Location TBD',
            'specialty' => $this->job->specialty ?? 'General',
            'message' => 'A new job matching your preferences has been posted',
            'type' => 'job_published',
        ];
    }
}
