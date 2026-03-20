<?php

use function Pest\Laravel\get;

it('renders the changelog page', function () {
    get('/changelog')->assertOk();
});

it('shows release versions', function () {
    $response = get('/changelog');

    expect($response->getContent())
        ->toContain('v1.0.0')
        ->toContain('v1.1.0')
        ->toContain('v1.2.0')
        ->toContain('v1.3.0')
        ->toContain('v1.4.0');
});
