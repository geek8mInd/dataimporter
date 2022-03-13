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

    'webservice' => [
        'uri_resource' => env('DATAIMPORTER_URL', ''),
        'payload_format' => env('DATAIMPORTER_PAYLOAD_FORMAT', ''),
        'api_slug' => env('DATAIMPORTER_APISLUG', ''),
        'api_query' => env('DATAIMPORTER_QUERY', '')
    ],

    'file' => [
        'file_resource_path' => env('DATAIMPORTER_FILEPATH', ''),
        'payload_format' => env('DATAIMPORTER_PAYLOAD_FORMAT', ''),
    ],

];