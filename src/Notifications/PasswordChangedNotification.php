<?php

namespace shibly\PasswordNotify\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordChangedNotification extends Notification
{
    use Queueable;

    protected string $plainPassword;

    public function __construct(string $plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your Password Has Been Changed')
            ->greeting('Hello, ' . $notifiable->name . '!')
            ->line('Your password has been successfully changed.')
            ->line('Your new password is:')
            ->line('**' . $this->plainPassword . '**')
            ->line('If you did not change your password, please contact support immediately.');
    }
}