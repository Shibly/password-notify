<?php

namespace shibly\PasswordNotify\listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use shibly\PasswordNotify\Notifications\PasswordChangedNotification;

class PasswordUpdatedListener implements ShouldQueue
{

    /**
     * @param $eventName
     * @param array $data
     * @return void
     */
    public function handle($eventName, array $data): void
    {
        /** @var Model $user */
        $user = $data[0];
        $config = config('passwordnotify');
        $passwordField = $config['password_field'];

        if ($user->wasChanged($passwordField)) {
            // IMPORTANT: You must have stored the plaintext password temporarily elsewhere
            if ($user->plain_password ?? false) {
                $user->notify(new PasswordChangedNotification($user->plain_password));
            }
        }
    }
}