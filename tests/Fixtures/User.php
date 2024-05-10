<?php

namespace Karabin\UserInvitation\Tests\Fixtures;

use Illuminate\Foundation\Auth\User as AuthUser;
use Karabin\UserInvitation\Traits\Inviteable;

class User extends AuthUser
{
    use Inviteable;
}
