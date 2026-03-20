<?php

use function Pest\Laravel\get;

it('renders the changelog page', function () {
    get('/changelog')->assertOk();
});

it('shows release versions', function () {
    $dir = storage_path('app');
    if (! is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    file_put_contents(storage_path('app/changelog.json'), file_get_contents(base_path('tests/fixtures/changelog.json')));

    $response = get('/changelog');

    expect($response->getContent())
        ->toContain('v1.0.0')
        ->toContain('v1.1.0')
        ->toContain('v1.2.0')
        ->toContain('v1.3.0')
        ->toContain('v1.4.0');
});
