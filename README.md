# User invitation for Laravel using built in PasswordBroker

[![Latest Version on Packagist](https://img.shields.io/packagist/v/karabinse/laravel-user-invitation.svg)](https://packagist.org/packages/karabinse/laravel-user-invitation)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/karabinse/laravel-user-invitation/run-tests.yml?branch=main&label=tests)](https://github.com/karabinse/laravel-user-invitation/actions?query=workflow%3Arun-tests+branch%3Amain)


## Installation

You can install the package via composer:

```bash
composer require karabinse/laravel-user-invitation
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-user-invitation-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-user-invitation-config"
```

This is the contents of the published config file:

```php
return [
    'notification_class' => \Karabin\UserInvitation\Notifications\InvitationNotification::class,
    'notification_subject' => 'Registered account',
    'notification_text' => "You're receiving this message because someone has registered an account for you on ".config('app.name').'. Click the link below to complete the registration by choosing a password',
    'notification_action_text' => 'Complete registration',
    'route' => 'register-user.create',
    'users_registration' => [
        'provider' => 'users',
        'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
        'expire' => env('USER_INVITATION_EXPIRE', (60 * 24) * 7),
        'throttle' => 60,
    ],
];

```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-user-invitation-views"
```

## Usage

Add the trait
```php
<?php

namespace Karabin\UserInvitation\Tests\Fixtures;

//...
use Karabin\UserInvitation\Traits\Inviteable;

class User extends AuthUser
{
    use Inviteable, Notifiable;
}

```

This gives access to two functions

```php
<?php

$user->createTokenForRegistration() // Returns a token string

$user->sendInvitation() // Creates a token and sends a notification

```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Albin J Nilsson](https://github.com/KarabinSE)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
