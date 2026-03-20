<?php

use function Pest\Laravel\get;

it('generates a single UUID by default', function () {
    $response = get('/uuid');

    $response->assertOk()
        ->assertJson(['count' => 1]);

    expect($response->json('uuid'))->toMatch(
        '/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i'
    );
});

it('generates multiple UUIDs', function () {
    $response = get('/uuid?count=5');

    $response->assertOk();
    expect($response->json('uuids'))->toHaveCount(5);
});

it('supports uppercase', function () {
    $response = get('/uuid?uppercase=true');

    $response->assertOk();
    expect($response->json('uuid'))->toBe(strtoupper($response->json('uuid')));
});

it('supports nodashes', function () {
    $response = get('/uuid?nodashes=true');

    $response->assertOk();
    expect($response->json('uuid'))->toMatch('/^[0-9a-f]{32}$/i');
    expect(str_contains($response->json('uuid'), '-'))->toBeFalse();
});

it('clamps count', function () {
    get('/uuid?count=999')
        ->assertOk()
        ->assertJson(['count' => 100]);
});

it('renders the uuid docs page', function () {
    get('/uuid-tool')->assertOk();
});
