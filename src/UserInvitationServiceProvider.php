<?php

namespace Karabin\UserInvitation;

use Illuminate\Support\ServiceProvider;

class UserInvitationServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/user-invitation.php' => config_path('user-invitation.php'),
            ], 'config');
        }
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/user-invitation.php', 'user-invitation');
        $this->mergeConfigFrom(__DIR__.'/../config/user-invitation.php', 'auth.passwords');
    }
}
