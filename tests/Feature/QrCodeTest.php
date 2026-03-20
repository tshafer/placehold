<?php

use function Pest\Laravel\get;

it('generates an SVG QR code', function () {
    $response = get('/qr?data=hello');

    $response->assertOk()
        ->assertHeader('Content-Type', 'image/svg+xml');

    expect($response->getContent())->toContain('<svg');
});

it('requires the data parameter', function () {
    get('/qr')->assertStatus(400);
});

it('respects custom size', function () {
    $response = get('/qr?data=test&size=200');

    $response->assertOk();
    expect($response->getContent())->toContain('200');
});

it('supports custom colors', function () {
    $response = get('/qr?data=test&fg=ff0000&bg=00ff00');

    $response->assertOk();
    expect($response->getContent())->toContain('#ff0000');
});

it('sets cache headers', function () {
    get('/qr?data=test')
        ->assertOk()
        ->assertHeader('Cache-Control');
});

it('renders the QR code docs page', function () {
    get('/qrcode')->assertOk();
});
