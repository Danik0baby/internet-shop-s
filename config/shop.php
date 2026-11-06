<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Storefront details
    |--------------------------------------------------------------------------
    |
    | Contact details shown across the storefront. Keep them in the
    | environment so real values are provided by the backend deployment.
    |
    */

    'name' => env('SHOP_NAME', 'NOVA'),

    'phone' => env('SHOP_PHONE'),

    'email' => env('SHOP_EMAIL'),

    'address' => env('SHOP_ADDRESS'),

    'schedule' => env('SHOP_SCHEDULE'),

];
