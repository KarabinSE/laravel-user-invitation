<?php

// config for Karabin/UserInvitation
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
