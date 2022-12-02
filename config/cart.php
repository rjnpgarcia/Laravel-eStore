<?php

return [
    'cookie' => [
        'name' => env('CART_COOKIE_NAME', 'cookie_name'),
        'expiration' => 7 * 24 * 60 //one week
    ]
];
