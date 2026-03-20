<?php

use Illuminate\Support\Facades\Http;

use function Pest\Laravel\get;

it('returns a quote from the API', function () {
    Http::fake([
        'api.quotable.io/*' => Http::response([
            '_id' => 'abc123',
            'content' => 'The only way to do great work is to love what you do.',
            'author' => 'Steve Jobs',
        ]),
    ]);

    $response = get('/q');

    $response->assertOk()
        ->assertJson(['status' => 'success'])
        ->assertJsonStructure(['status', 'data', 'timestamp']);
});

it('returns an error when the API fails', function () {
    Http::fake([
        'api.quotable.io/*' => Http::response(null, 500),
    ]);

    $response = get('/q');

    $response->assertOk();

    expect($response->json('status'))->toBeIn(['success', 'error']);
});
