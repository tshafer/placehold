<?php

use function Pest\Laravel\get;

it('converts a 6-digit hex', function () {
    get('/color/ff5733')
        ->assertOk()
        ->assertJsonStructure([
            'hex',
            'rgb',
            'hsl',
            'contrast',
        ]);
});

it('converts a 3-digit hex', function () {
    $response = get('/color/f00');

    $response->assertOk();
    expect($response->json('rgb.r'))->toBe(255);
});

it('returns complement color', function () {
    get('/color/ff0000')
        ->assertOk()
        ->assertJsonStructure(['complement']);
});

it('returns contrast info', function () {
    $response = get('/color/000000');

    $response->assertOk();
    expect($response->json('contrast.on_white'))->toBeNumeric();
});

it('does not match routes with invalid hex characters', function () {
    get('/color/gggggg')->assertNotFound();
});

it('caches with long TTL', function () {
    $response = get('/color/ff5733');

    $response->assertOk();
    expect($response->headers->get('Cache-Control'))->toContain('max-age=31536000');
});

it('renders the color converter docs page', function () {
    get('/color-converter')->assertOk();
});
