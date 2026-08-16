<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendPasswordResetOtpNotification extends Notification
{
    use Queueable;

    public function __construct(protected string $code) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your BeFit Password Reset Code')
            ->greeting('Hello '.$notifiable->name)
            ->line('Use this code to reset your BeFit password:')
            ->line('## '.$this->code)
            ->line('This code is valid for 10 minutes only.')
            ->line('If you did not request a password reset, you can safely ignore this email.');
    }
}
