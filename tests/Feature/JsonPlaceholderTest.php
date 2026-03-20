<?php

use function Pest\Laravel\get;

it('returns fake users', function () {
    $response = get('/json/users?count=3');

    $response->assertOk()
        ->assertJson(['status' => 'success', 'count' => 3]);

    expect($response->json('data'))->toHaveCount(3);
    expect($response->json('data.0'))->toHaveKeys(['id', 'name', 'email', 'username']);
});

it('returns fake posts', function () {
    $response = get('/json/posts?count=5');

    $response->assertOk()
        ->assertJson(['status' => 'success', 'count' => 5]);

    expect($response->json('data'))->toHaveCount(5);
    expect($response->json('data.0'))->toHaveKeys(['id', 'title', 'body', 'userId']);
});

it('returns fake comments', function () {
    $response = get('/json/comments?count=2');

    $response->assertOk()
        ->assertJson(['status' => 'success', 'count' => 2]);

    expect($response->json('data'))->toHaveCount(2);
    expect($response->json('data.0'))->toHaveKeys(['id', 'postId', 'name', 'email', 'body']);
});

it('returns fake todos', function () {
    $response = get('/json/todos?count=4');

    $response->assertOk()
        ->assertJson(['status' => 'success', 'count' => 4]);

    expect($response->json('data'))->toHaveCount(4);
    expect($response->json('data.0'))->toHaveKeys(['id', 'userId', 'title', 'completed']);
});

it('produces deterministic output with seed', function () {
    $first = get('/json/users?count=2&seed=42')->json('data');
    $second = get('/json/users?count=2&seed=42')->json('data');

    expect($first)->toBe($second);
});

it('clamps count between 1 and 100', function () {
    $response = get('/json/users?count=200');

    $response->assertOk();
    expect($response->json('data'))->toHaveCount(100);
});

it('includes pagination meta', function () {
    $response = get('/json/posts?count=2&page=3&seed=1');

    $response->assertOk();
    expect($response->json('meta.page'))->toBe(3);
    expect($response->json('meta.seed'))->toBe(1);
    expect($response->json('data.0.id'))->toBe(5);
});

it('renders the JSON placeholder docs page', function () {
    get('/json-placeholder')->assertOk();
});
