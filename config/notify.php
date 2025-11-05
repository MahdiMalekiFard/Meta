<?php

return [
    'sms' => [
        'default'                => env('NOTIFY_SMS_DEFAULT', 'kavenegar'),
        'drivers'                => [
            'kavenegar' => [
                'class'  => \App\Services\Notify\Sms\Drivers\KavenegarDriver::class,
                'sender' => env('KAVENEGAR_SENDER', ''),
                'apiKey' => env('KAVENEGAR_API_KEY', ''),
            ],
            // other drivers here
        ],
        'contact_sms_recipients' => env('CONTACT_SMS_RECIPIENTS', ''),
    ],
    
    'email'        => [
        'default' => env('NOTIFY_EMAIL_DEFAULT', 'laravel_mail'),
        'drivers' => [
            'laravel_mail' => [
                'class' => \App\Services\Notify\Email\Drivers\LaravelMailDriver::class,
            ],
            // 'mailgun' => [...],
        ],
    ],
    
    // You can add push notifications later (FCM/APN/WebPush)
    'notification' => [
        'default' => 'database', // placeholder
        'drivers' => [
            // 'fcm' => [...],
        ],
    ],
];