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

        // Check if the password was changed
        if ($user->wasChanged($passwordField)) {
            // Check if plain_password was temporarily set in memory
            if (isset($user->plain_password) && !empty($user->plain_password)) {
                $user->notify(new PasswordChangedNotification($user->plain_password));
            }
        }
    }
}
