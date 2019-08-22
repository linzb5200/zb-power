<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
//    'github' => [
//        'client_id'     => 'your-app-id',
//        'client_secret' => 'your-app-secret',
//        'redirect'      => 'http://localhost/socialite/callback.php',
//    ],
//
//    'weibo' => [
//        'client_id'     => 'your-app-id',
//        'client_secret' => 'your-app-secret',
//        'redirect'      => 'http://localhost/socialite/callback.php',
//    ],
//    'qq' => [
//        'client_id'     => 'your-app-id',
//        'client_secret' => 'your-app-secret',
//        'redirect'      => 'http://localhost/socialite/callback.php',
//    ],
//    'wechat' => [
//        'client_id' => 'appid',
//        'client_secret' => 'appSecret',
//        'redirect' => 'http://xxxxxx.proxy.qqbrowser.cc/oauth/callback/driver/wechat',
//    ]

];
