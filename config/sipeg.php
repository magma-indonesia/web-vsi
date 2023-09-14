<?php

return [
    'url' => env('SIPEG_API_URL'),
    'headers' => [
        'APIKey' => env('SIPEG_API_KEY'),
        'client-id' => env('SIPEG_C_ID'),
        'client-secret' => env('SIPEG_C_SECRET')
    ],
    'photo_url' => env('SIPEG_PHOTO_URL'),
    'org_code' => env('ORG_CODE'),
];
