<?php

return [
    'key' => env('FCM_SERVER_KEY'),
    'sender_id' => env('FCM_SENDER_ID'),
    'service_account' => [
        'file' => env('FCM_SERVICE_ACCOUNT_PATH'), // Path to your Firebase service account JSON file
    ],
];
