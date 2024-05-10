<?php

namespace Karabin\UserInvitation\Traits;

use Illuminate\Auth\Passwords\PasswordBrokerManager;

trait Inviteable
{
    public function sendInvitation(): string
    {
        $token = (new PasswordBrokerManager(app()))
            ->broker('users_registration')
            ->createToken($this);

        $this->notify(new InvitationNotification($token));

        $this->invite_sent_at = now();
        $this->save();

        return $token;
    }
}
