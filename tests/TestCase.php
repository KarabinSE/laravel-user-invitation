<?php

namespace Karabin\UserInvitation\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Karabin\UserInvitation\UserInvitationServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Karabin\\UserInvitation\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            UserInvitationServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        $migration = include __DIR__.'/../tests/migrations/0001_01_01_000000_create_users_table.php';
        $migration->up();
        $migration = include __DIR__.'/../database/migrations/add_invitation_fields_to_user_table.php.stub';
        $migration->up();
    }
}
