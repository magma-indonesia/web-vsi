<?php

return [

    /**
     * ULR untuk sipeg API
     */
    'url' => env('SIPEG_API_URL'),

    /**
     * API Key sipeg
     */
    'api_key' => env('SIPEG_API_KEY'),

    /**
     * Username dan password untuk mengakses API SIPEG
     */
    'username' => env('SIPEG_API_USERNAME'),
    'password' => env('SIPEG_API_PASSWORD'),

    /**
     * Set request header
     */
    'headers' => [
        'APIkey' => env('SIPEG_API_KEY'),
        'Authorization' => 'Basic ' . base64_encode(env('SIPEG_API_USERNAME') . ':' . env('SIPEG_API_PASSWORD'))
    ],

    /**
     * Photo URL Sipeg
     */
    'photo_url' => env('SIPEG_PHOTO_URL'),
];
