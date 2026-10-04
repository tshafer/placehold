<?php

use Illuminate\Support\Facades\Http;

use function Pest\Laravel\get;

it('returns a quote from the API', function () {
    Http::fake([
        'dummyjson.com/*' => Http::response([
            'id' => 1,
            'quote' => 'The only way to do great work is to love what you do.',
            'author' => 'Steve Jobs',
        ]),
    ]);

    $response = get('/q');

    $response->assertOk()
        ->assertJson(['status' => 'success'])
        ->assertJsonPath('data.content', 'The only way to do great work is to love what you do.')
        ->assertJsonPath('data.author', 'Steve Jobs');
});

it('returns an error when the API fails', function () {
    Http::fake([
        'dummyjson.com/*' => Http::response(null, 500),
    ]);

    $response = get('/q');

    $response->assertStatus(502)->assertJson(['status' => 'error']);
});
