<?php

use Illuminate\Support\Facades\Notification;
use Karabin\UserInvitation\Notifications\InvitationNotification;
use Karabin\UserInvitation\Tests\Fixtures\User;
use Karabin\UserInvitation\Tests\TestCase;

class UserInviteTest extends TestCase
{
    public function test_it_can_generate_a_token()
    {
        // Arrange
        Notification::fake();
        User::unguard();
        $user = User::create(['name' => 'Tester', 'email' => 'albin@karabin.se', 'password' => bcrypt('secret')]);
        User::reGuard();

        // Act
        $token = $user->createTokenForRegistration();

        // Assert
        $this->assertIsString($token, $token);
    }

    public function test_it_can_invite_a_user()
    {
        // Arrange
        Notification::fake();
        User::unguard();
        $user = User::create(['name' => 'Tester', 'email' => 'albin@karabin.se', 'password' => bcrypt('secret')]);
        User::reGuard();

        // Act
        $token = $user->sendInvitation();

        // Assert
        Notification::assertSentTimes(InvitationNotification::class, 1);
    }

    public function test_it_can_use_an_invite_token_to_register()
    {
        // Arrange
        User::unguard();
        $user = User::create(['name' => 'Tester', 'email' => 'albin@karabin.se', 'password' => bcrypt('secret')]);
        User::reGuard();
        $token = $user->createTokenForRegistration();

        // Act
        $return = $user->registerViaInvite($token, [
            'email' => 'albin@karabin.se',
            'password' => 'a_super_Secret_password1',
            'password_confirmation' => 'a_super_Secret_password1',
        ]);

        // Assert
        $this->assertEquals($return, trans('passwords.reset'));
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
        ]);
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
            'invite_accepted_at' => null,
        ]);
    }
}
