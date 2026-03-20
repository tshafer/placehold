<?php

use Illuminate\Support\Facades\Cache;

use function Pest\Laravel\get;

beforeEach(function () {
    Cache::flush();
});

it('renders the stats page', function () {
    get('/stats')->assertOk();
});

it('returns JSON from the api-stats endpoint', function () {
    get('/api-stats')
        ->assertOk()
        ->assertJsonStructure([
            'today',
            'endpoints',
            'daily',
            'generated_at',
        ]);
});

it('returns 7 days of daily data', function () {
    $response = get('/api-stats');

    $data = $response->json();
    expect($data['daily'])->toHaveCount(7);
});

it('tracks API calls via middleware', function () {
    get('/avatar/statstest')->assertOk();

    $response = get('/api-stats');
    $data = $response->json();

    $avatarEndpoint = collect($data['endpoints'])
        ->firstWhere('endpoint', 'avatar.show');

    expect($avatarEndpoint)->not->toBeNull()
        ->and($avatarEndpoint['total'])->toBeGreaterThanOrEqual(1);
});
