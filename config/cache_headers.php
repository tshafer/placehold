<?php

return [

    /*
    |--------------------------------------------------------------------------
    | CDN / Cache-Control headers per API endpoint
    |--------------------------------------------------------------------------
    |
    | Keys are route names. Values are used for Cache-Control and optionally
    | CDN-Cache-Control (e.g. CloudFront). Omit or null = no header set.
    |
    */

    'headers' => [
        // Image placeholders: long cache, CDN can cache
        'placeholder.short' => 'public, max-age=86400, s-maxage=86400, stale-while-revalidate=3600',
        'placeholder' => 'public, max-age=86400, s-maxage=86400, stale-while-revalidate=3600',

        // Favicon / small assets
        'favicon' => 'public, max-age=86400, s-maxage=86400',

        // JSON / data APIs: short cache
        'json.placeholder.users' => 'public, max-age=300, s-maxage=300',
        'json.placeholder.posts' => 'public, max-age=300, s-maxage=300',
        'json.placeholder.comments' => 'public, max-age=300, s-maxage=300',
        'json.placeholder.todos' => 'public, max-age=300, s-maxage=300',

        // Text / lightweight
        'weather' => 'public, max-age=60, s-maxage=60',
        'recipe' => 'public, max-age=300, s-maxage=300',
        'quote' => 'public, max-age=3600, s-maxage=3600',
        'joke' => 'public, max-age=300, s-maxage=300',
        'avatar.show' => 'public, max-age=86400, s-maxage=86400',
        'holdicon' => 'public, max-age=86400, s-maxage=86400',
        'qr' => 'public, max-age=3600, s-maxage=3600',
        'colors' => 'public, max-age=3600, s-maxage=3600',
        'pdf' => 'public, max-age=3600, s-maxage=3600',
        'csv' => 'public, max-age=300, s-maxage=300',
        'markdown' => 'public, max-age=300, s-maxage=300',

        // Long-running / heavy: shorter CDN cache
        'video' => 'public, max-age=86400, s-maxage=86400',

        // Utilities
        'base64' => 'public, max-age=60, s-maxage=60',
        'hash' => 'no-store',
        'uuid' => 'no-store',
        'color.convert' => 'public, max-age=86400, s-maxage=86400',
    ],

];
