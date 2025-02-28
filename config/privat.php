<?php

return [
    // Set to true to block site access with Privat
    'enabled' => env('PRIVAT_ENABLED', false),

    // Choose a good Privat password
    'password' => env('PRIVAT_PASSWORD', ''),

    // Set the middleware group to protect
    'middleware_groups' => env('PRIVAT_MIDDLEWARE_GROUP', 'web'),

    // If you want a public waiting page, type its view name here
    'waiting_view' => env('PRIVAT_WAITING_VIEW', false),

    // Hosts and Urls excluded
    'except' => [
        'hosts' => env('PRIVAT_EXCEPTED_HOSTS', ''),
        'urls' => env('PRIVAT_EXCEPTED_URLS', '')
    ]
];