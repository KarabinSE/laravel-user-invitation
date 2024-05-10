<?php

namespace Karabin\UserInvitation;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class UserInvitationServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-user-invitation')
            ->hasConfigFile()
            ->hasMigration('add_invitation_fields_to_user_table');
    }
}
