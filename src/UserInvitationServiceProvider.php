<?php

namespace Karabin\UserInvitation;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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
            ], 'laravel-user-invitation-config');

            $now = Str::slug(now()->toDateTimeString(), '_');
            $this->publishes([
                __DIR__.'/../database/migrations/add_invitation_fields_to_user_table.php.stub' => database_path("migrations/{$now}_add_invitation_fields_to_user_table.php"),
            ], 'laravel-user-invitation-migrations');
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
