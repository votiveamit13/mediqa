<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;

class VerifyEmailCustom extends Notification
{
        public function via($notifiable)
    {
        return ['mail'];
    }

        protected function verificationUrl($notifiable): string
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(config('auth.verification.expire', 60)),
            [
                'id'   => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }

        public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Verify Your Email - MediQA')
            ->view('emails.verify-custom', [
                'user'      => $notifiable,
                'verifyUrl' => $this->verificationUrl($notifiable),
            ]);
    }
}