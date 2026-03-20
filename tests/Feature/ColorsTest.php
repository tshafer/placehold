<?php

use function Pest\Laravel\get;

it('returns a color palette by default', function () {
    $response = get('/c');

    $response->assertOk()
        ->assertJsonStructure([
            'status',
            'type',
            'count',
            'data',
            'timestamp',
        ])
        ->assertJson(['status' => 'success', 'type' => 'palette']);
});

it('returns hex colors', function () {
    $response = get('/c?type=hex&count=3');

    $response->assertOk()
        ->assertJson(['status' => 'success', 'type' => 'hex', 'count' => 3]);

    $data = $response->json('data');
    expect($data)->toHaveCount(3);

    foreach ($data as $color) {
        expect($color)->toMatch('/^#[0-9a-f]{6}$/i');
    }
});

it('returns named colors', function () {
    $response = get('/c?type=named&count=2');

    $response->assertOk()
        ->assertJson(['status' => 'success', 'type' => 'named', 'count' => 2]);

    $data = $response->json('data');
    expect($data)->toHaveCount(2);
    expect($data[0])->toHaveKeys(['name', 'hex', 'rgb', 'category']);
});

it('clamps count between 1 and 10', function () {
    get('/c?type=hex&count=0')
        ->assertOk()
        ->assertJson(['count' => 1]);

    get('/c?type=hex&count=50')
        ->assertOk()
        ->assertJsonPath('count', fn ($count) => $count <= 10);
});

it('returns error for invalid type', function () {
    get('/c?type=invalid')->assertStatus(400);
});
