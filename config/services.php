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
        'key' => env('STRIPE_API_PUBLIC_KEY','pk_test_Fvey8N8U57K2SKTlX5i6hHMt'),
        'secret' => env('STRIPE_API_KEY', 'sk_test_bTpUHRml0ZS5txpqmbJ71zG5'),
    ],
    
    'facebook' => [
        'client_id' => env('FACEBOOK_ID', '133145634018728'),
        'client_secret' => env('FACEBOOK_SECRET', 'c918205ecd383b9333b3d1c2d1b72023'),
        'redirect' => env('FACEBOOK_URL', '/api/auth/facebook/callback'),
    ],
    'google' => [
        'client_id' => env('GOOGLE_ID', '716797004122-6q7p6dqu4uriaaiqq5sjldl8qkq4k9oi.apps.googleusercontent.com'),
        'client_secret' => env('GOOGLE_SECRET', 'PP4n79pvznH-t1UguMOJP-ee'),
        'redirect' => env('GOOGLE_URL', '/api/auth/google/callback'),
    ],
    
    'cookie_url' => env('COOKIE_URL', 'jobmap.co'),
    
    'send_resume_interval' => 30

];
