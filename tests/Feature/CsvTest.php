<?php

use function Pest\Laravel\get;

it('generates CSV with default parameters', function () {
    $response = get('/csv');

    $response->assertOk()
        ->assertHeader('Content-Type', 'text/csv; charset=UTF-8');

    $lines = explode("\n", trim($response->getContent()));
    expect($lines[0])->toContain('name');
    expect(count($lines))->toBeGreaterThan(1);
});

it('uses a preset', function () {
    $response = get('/csv?preset=users&rows=3');

    $response->assertOk();
    $lines = explode("\n", trim($response->getContent()));
    expect($lines[0])->toContain('name,email,phone,city,country');
    expect(count($lines))->toBe(4);
});

it('supports custom columns', function () {
    $response = get('/csv?columns=first_name,last_name,email&rows=2');

    $response->assertOk();
    $lines = explode("\n", trim($response->getContent()));
    expect($lines[0])->toContain('first_name');
});

it('returns JSON format', function () {
    $response = get('/csv?preset=products&format=json&rows=2');

    $response->assertOk()
        ->assertJson(['status' => 'success', 'count' => 2]);

    expect($response->json('data'))->toHaveCount(2);
    expect($response->json('data.0'))->toHaveKey('product_name');
});

it('produces deterministic output with seed', function () {
    $first = get('/csv?preset=users&rows=3&seed=42')->getContent();
    $second = get('/csv?preset=users&rows=3&seed=42')->getContent();

    expect($first)->toBe($second);
});

it('clamps rows to valid range', function () {
    $response = get('/csv?rows=2000&preset=contacts');
    $response->assertOk();
    $lines = explode("\n", trim($response->getContent()));
    expect(count($lines))->toBe(1001);
});

it('renders the CSV docs page', function () {
    get('/csv-generator')->assertOk();
});
