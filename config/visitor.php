<?php

use Atldays\Visitor\Fingerprints\IpUserAgent;

return [
    /*
    |--------------------------------------------------------------------------
    | Fingerprint Driver
    |--------------------------------------------------------------------------
    |
    | This class is responsible for generating the visitor fingerprint value.
    | You may replace it with your own implementation of the fingerprint
    | contract to customize how visitor fingerprints are built.
    |
    */
    'fingerprint' => [
        'driver' => IpUserAgent::class,
    ],
];
