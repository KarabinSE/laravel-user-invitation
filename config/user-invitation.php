<?php

// config for Karabin/UserInvitation
return [
    'expire' => env('USER_INVITATION_EXPIRE', (60 * 24) * 7),
    'notification_subject' => 'Registered account',
    'notification_text' => "You're receiving this message because someone has registered an account for you on ".config('app.name').'. Click the link below to complete the registration by choosing a password',
    'notification_action_text' => 'Complete registration',
    'route' => 'register-user.create',
];
