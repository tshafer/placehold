<?php

use function Pest\Laravel\get;

it('generates an SVG favicon with defaults', function () {
    $response = get('/favicon');

    $response->assertOk()
        ->assertHeader('Content-Type', 'image/svg+xml');

    expect($response->getContent())->toContain('<svg')
        ->toContain('P');
});

it('renders custom text', function () {
    $response = get('/favicon?text=AB');

    $response->assertOk();
    expect($response->getContent())->toContain('AB');
});

it('applies custom colors', function () {
    $response = get('/favicon?bg=ff0000&fg=00ff00');

    $response->assertOk();
    expect($response->getContent())->toContain('#ff0000')
        ->toContain('#00ff00');
});

it('respects custom size', function () {
    $response = get('/favicon?size=128');

    $response->assertOk();
    expect($response->getContent())->toContain('128');
});

it('sets long-lived cache headers', function () {
    get('/favicon')
        ->assertOk()
        ->assertHeader('Cache-Control');
});

it('renders the favicon generator docs page', function () {
    get('/favicon-generator')->assertOk();
});
