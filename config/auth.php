<?php

return [

    'defaults' => [
        'guard' => 'web',  // Set default guard to 'web'
        'passwords' => 'users',  // Set default password broker to 'users'
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | This section defines authentication guards for the application. 
    | We'll define a guard for 'web' users and a separate one for 'admin'.
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',  // Use the admins provider for admin users
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | User providers define how users are retrieved from your database. 
    | We'll define separate providers for users and admins.
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,  // Default user model
        ],

        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,  // Use the Admin model for admins
        ],

        // You can also define more providers or use a 'database' driver if needed.
        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | We will define separate password reset settings for users and admins.
    | This allows different token tables and expiration times.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,  // Tokens expire after 60 minutes
            'throttle' => 60,  // Throttle requests to prevent abuse
        ],

        'admins' => [
            'provider' => 'admins',  // Use the admins provider
            'table' => 'password_reset_tokens',
            'expire' => 60,  // Tokens expire after 60 minutes
            'throttle' => 60,  // Throttle requests for security
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | The amount of time, in seconds, before password confirmation expires. 
    | The default is set to three hours (10800 seconds).
    |
    */

    'password_timeout' => 10800,  // 3 hours

];
