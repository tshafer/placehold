<?php

use function Pest\Laravel\get;

it('generates a sha256 hash by default', function () {
    $response = get('/hash?data=hello');

    $response->assertOk()
        ->assertJson(['algorithm' => 'sha256']);

    expect($response->json('hash'))->toMatch('/^[a-f0-9]{64}$/');
});

it('supports md5', function () {
    get('/hash?data=hello&algo=md5')
        ->assertOk()
        ->assertJson(['algorithm' => 'md5']);
});

it('requires data parameter', function () {
    get('/hash')->assertStatus(422);
});

it('rejects unknown algorithm', function () {
    get('/hash?data=hello&algo=fake')->assertStatus(422);
});

it('returns all hashes', function () {
    get('/hash?data=hello&all=true')
        ->assertOk()
        ->assertJsonStructure([
            'hashes' => [
                'md5',
                'sha256',
            ],
        ]);
});

it('renders the hash docs page', function () {
    get('/hash-tool')->assertOk();
});
