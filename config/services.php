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

    'facebook' => [
        'client_id' => '277825625980540',
        'client_secret' => '7e8a2d6e9b0276d133dedeb5d2528186',
        'redirect' => 'http://localhost:8000/auth/facebook/callback'
    ],

    'twitter' => [
        'client_id' => env('TWITTER_ID'),
        'client_secret' => env('TWITTER_SECRET'),
        'redirect' => env('TWITTER_URL')
    ],

    'instagram' => [
        'client_id' => 'b47506421ec7437fa391981865617787',
        'client_secret' => '3acf58cc7b2b4cd6a75bec0f685098c8',
        'redirect' => 'http://localhost:8000/auth/instagram/callback'
    ]
];
