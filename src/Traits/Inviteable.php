<?php

namespace Karabin\UserInvitation\Traits;

// use Illuminate\Auth\Passwords\PasswordBrokerManager;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Karabin\UserInvitation\Passwords\PasswordBrokerManager;

trait Inviteable
{
    public function createTokenForRegistration(): string
    {
        $token = (new PasswordBrokerManager(app()))
            ->broker('users_registration')
            ->createToken($this);

        return $token;
    }

    public function sendInvitation(): self
    {
        $token = $this->createTokenForRegistration();
        $class = config('user-invitation.notification_class');
        $this->notify(new $class($token));

        $this->invite_sent_at = now();
        $this->save();

        return $this;
    }

    public function registerViaInvite(string $token, array $resetData): string
    {
        $fields = array_merge(['token' => $token, ...$resetData]);
        $status = Password::reset(
            $fields,
            function ($user) use ($fields) {
                $user->forceFill([
                    'password' => Hash::make($fields['password']),
                    'remember_token' => Str::random(60),
                    'invite_accepted_at' => now(),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return $status;
    }
}
