<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendOtpNotification extends Notification
{
    use Queueable;

    public function __construct(protected string $code) {}

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your BeFit Account Verification Code')
            ->greeting('Hello ' . $notifiable->name)
            ->line('Your verification code is:')
            ->line('## ' . $this->code)
            ->line('This code is valid for 10 minutes only.')
            ->line('If you did not attempt this, you can safely ignore this email.');
    }
}