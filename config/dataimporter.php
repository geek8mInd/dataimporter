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
        'uri_resource' => env('dataimporter_url'),
        'payload_format' => env('dataimporter_payload_format'),
    ],

    'file' => [
        'file_resource_path' => env('dataimporter_filepath'),
        'payload_format' => env('dataimporter_payload_format'),
    ],

];