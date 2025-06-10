<?php

namespace shibly\PasswordNotify\listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use shibly\PasswordNotify\Notifications\PasswordChangedNotification;

class PasswordUpdatedListener implements ShouldQueue
{
    /**
     * Handle model updated events.
     *
     * @param string $eventName
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
            // Try to grab the plain password directly from the current request input
            $plainPassword = Request::input('new_password')
                ?? Request::input('password')
                ?? Request::input($passwordField);

            if ($plainPassword) {
                $user->notify(new PasswordChangedNotification($plainPassword));
            }
        }
    }
}
