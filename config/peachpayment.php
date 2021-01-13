<?php

return [
    // Peach Payment variables
    'user'                      => env('PEACH_PAYMENTS_USER_ID'),
    'password'                  => env('PEACH_PAYMENTS_PASSWORD'),
    'authorisation_header'      => env('PEACH_PAYMENTS_AUTHORIZATION_HEADER'),
    'entity_id_once_off'        => env('PEACH_PAYMENTS_ENTITY_ID_ONCE_OFF'),
    'entity_id_once_recurring'  => env('PEACH_PAYMENTS_ENTITY_ID_RECURRING'),
    'test_mode'                 => env('PEACH_PAYMENTS_TEST_MODE', true),
    'notification_url'          => env('PEACH_PAYMENTS_NOTIFICATION_URL'),
    'api_uri'                   => env('PEACH_PAYMENTS_API_URI', 'https://test.oppwa.com/v1/'),
    'api_uri_version'           => env('PEACH_PAYMENTS_API_VERSION'),
    'client_version'            => '1.0.0',
    'skip_3ds_for_stored_cards' => true,
    'webhook_url'               => '/peach-webhook',
    'webhook_excluded'          => ['card', 'authentication'],
    'webhook_secret_key'        => env('PEACH_PAYMENTS_WEBHOOK_SECRET_KEY'),
];
