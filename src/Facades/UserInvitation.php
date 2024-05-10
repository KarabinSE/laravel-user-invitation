<?php

namespace Karabin\UserInvitation\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Karabin\UserInvitation\UserInvitation
 */
class UserInvitation extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Karabin\UserInvitation\UserInvitation::class;
    }
}
