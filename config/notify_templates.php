<?php

return [
    'contact_admin_sms' => [
        'channel'           => 'sms',
        'provider_template' => [
            'kavenegar' => 'contact-admin-sms',
        ],
        // The order of this array is very important; the same order as we mapped in the driver
        'tokens'            => [
            ['name' => 'token', 'type' => 'string', 'required' => true, 'max' => 200],
            ['name' => 'token2', 'type' => 'string', 'required' => false, 'max' => 200],
            ['name' => 'token3', 'type' => 'string', 'required' => false, 'max' => 200],
            ['name' => 'token10', 'type' => 'string', 'required' => false, 'max' => 200],
            ['name' => 'token20', 'type' => 'string', 'required' => false, 'max' => 200],
        ],
    ],
];