<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Environment
    |--------------------------------------------------------------------------
    |
    | Possibles values: "sandbox" or "live".
    |
    */

    'env' => env('MA_MOMO_ENV', "live"),

    /*
    |--------------------------------------------------------------------------
    | Live Config
    |--------------------------------------------------------------------------
    */

    /** @var string */
    'user_id' => env('MA_MOMO_API_USER_ID'),


    /*
    |--------------------------------------------------------------------------
    | Api keys
    |--------------------------------------------------------------------------
    */

    'api_keys' => [
        'collection'   => env('MA_MOMO_COL_API_KEY'),
        'disbursement' => env('MA_MOMO_DIS_API_KEY'),
        'remittance'   => env('MA_MOMO_REM_API_KEY'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Sandbox subscriptions keys
    |--------------------------------------------------------------------------
    */

    'sandbox' => [
        'subscriptions_keys' => [
            'collection'   => env('MA_MOMO_COL_SUB_KEY', ''),
            'disbursement' => env('MA_MOMO_DIS_SUB_KEY', ''),
            'remittance'   => env('MA_MOMO_REM_SUB_KEY', ''),
        ],
    ],
];
