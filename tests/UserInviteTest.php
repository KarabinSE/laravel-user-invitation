<?php

use Illuminate\Support\Facades\Notification;
use Karabin\Notifications\InvitationNotification;
use Karabin\UserInvitation\Tests\Fixtures\User;
use Karabin\UserInvitation\Tests\TestCase;

class UserInviteTest extends TestCase
{
    public function test_it_can_invite_a_user()
    {
        // Arrange
        Notification::fake();
        User::unguard();
        $user = User::make(['name' => 'Tester', 'email' => 'albin@karabin.se', 'password' => bcrypt('secret')]);
        User::reGuard();

        // Act
        $token = $user->sendInvitation();
        dd($token);

        // Assert
        Notification::assertSentTimes(new InvitationNotification($token));
    }
}
