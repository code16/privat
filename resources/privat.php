<?php

return [

    // Set to true to block site access with Privat
    "restricted" => env("PRIVAT_RESTRICTED", false),

    // Choose a good Privat password
    "password" => env("PRIVAT_PASSWORD", ""),

    // If you want a public waiting page, type its view name here
    "waiting_view" => false,

    // Hosts and Urls excluded
    "except" => [
        "hosts" => env("PRIVAT_EXCEPTED_HOSTS", ""),
        "urls" => env("PRIVAT_EXCEPTED_URLS", "")
    ]

];