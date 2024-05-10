<?php

namespace Karabin\UserInvitation\Passwords;

use Illuminate\Auth\Passwords\PasswordBrokerManager as IllumniatePasswordBrokerManager;

/**
 * @mixin \Illuminate\Contracts\Auth\PasswordBroker
 */
class PasswordBrokerManager extends IllumniatePasswordBrokerManager
{
    /**
     * Attempt to get the broker from the local cache.
     *
     * @param  string|null  $name
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker($name = null)
    {
        $name = $name ?: $this->getDefaultDriver();

        return $this->resolve($name);
    }
}
