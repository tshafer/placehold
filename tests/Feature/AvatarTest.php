<?php

use function Pest\Laravel\get;

it('generates an SVG avatar for a seed', function () {
    $response = get('/avatar/alice');

    $response->assertOk()
        ->assertHeader('Content-Type', 'image/svg+xml; charset=UTF-8');

    expect($response->getContent())->toContain('<svg')
        ->toContain('</svg>');
});

it('produces deterministic output for the same seed', function () {
    $first = get('/avatar/testuser')->getContent();
    $second = get('/avatar/testuser')->getContent();

    expect($first)->toBe($second);
});

it('produces different output for different seeds', function () {
    $alice = get('/avatar/alice')->getContent();
    $bob = get('/avatar/bob')->getContent();

    expect($alice)->not->toBe($bob);
});

it('respects custom size parameter', function () {
    $response = get('/avatar/test?size=100');

    $response->assertOk();
    expect($response->getContent())->toContain('width="100"')
        ->toContain('height="100"');
});

it('sets long-lived cache headers', function () {
    get('/avatar/test')
        ->assertOk()
        ->assertHeader('Cache-Control');
});

it('renders the avatar docs page', function () {
    get('/avatar')->assertOk();
});
