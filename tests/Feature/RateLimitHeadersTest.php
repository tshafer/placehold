<?php

use function Pest\Laravel\get;

it('returns X-RateLimit headers on API endpoints', function () {
    $response = get('/avatar/ratelimit-test');

    $response->assertOk()
        ->assertHeader('X-RateLimit-Limit')
        ->assertHeader('X-RateLimit-Remaining');
});

it('includes rate limit headers on JSON endpoints', function () {
    $response = get('/json/users?count=1');

    $response->assertOk()
        ->assertHeader('X-RateLimit-Limit')
        ->assertHeader('X-RateLimit-Remaining');
});
