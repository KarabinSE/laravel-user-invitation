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
        $token = $user->sendInvitation();

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
}
