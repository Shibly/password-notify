<?php

namespace shibly\PasswordNotify\listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use shibly\PasswordNotify\Notifications\PasswordChangedNotification;

class PasswordUpdatedListener implements ShouldQueue
{
    /**
     * Handle the model updated event.
     *
     * @param string $eventName
     * @param array $data
     * @return void
     */
    public function handle($eventName, array $data): void
    {
        /** @var Model $user */
        $user = $data[0];
        $passwordField = config('passwordnotify.password_field', 'password');

        // If the password field was changed, send a notification
        if ($user->wasChanged($passwordField)) {
            $user->notify(new PasswordChangedNotification());
        }
    }
}
