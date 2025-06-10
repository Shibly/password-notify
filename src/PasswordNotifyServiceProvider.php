<?php

namespace shibly\PasswordNotify;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use shibly\PasswordNotify\listeners\PasswordUpdatedListener;

class PasswordNotifyServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/config/passwordnotify.php' => config_path('passwordnotify.php'),
        ], 'config');

        Event::listen('eloquent.updated:*', PasswordUpdatedListener::class);
    }

    /**
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/config/passwordnotify.php', 'passwordnotify');
    }
}