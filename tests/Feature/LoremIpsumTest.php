<?php

use function Pest\Laravel\get;

it('returns lorem ipsum with default parameters', function () {
    $response = get('/l');

    $response->assertOk()
        ->assertJsonStructure([
            'status',
            'data',
            'metadata' => ['paragraphs', 'minWords', 'maxWords', 'totalWords', 'format', 'seed'],
        ])
        ->assertJson(['status' => 'success']);
});

it('returns the requested number of paragraphs', function () {
    $response = get('/l?paragraphs=5');

    $response->assertOk();

    expect($response->json('data'))->toHaveCount(5);
    expect((int) $response->json('metadata.paragraphs'))->toBe(5);
});

it('starts with Lorem ipsum when requested', function () {
    $response = get('/l?paragraphs=1&startWithLoremIpsum=true');

    $response->assertOk();

    $paragraph = $response->json('data.0');
    expect($paragraph)->toStartWith('Lorem');
});

it('returns HTML format', function () {
    $response = get('/l?format=html&paragraphs=2');

    $response->assertOk();

    $data = $response->json('data');
    expect($data)->toContain('<p>')->toContain('</p>');
});

it('returns plain text format', function () {
    $response = get('/l?format=text&paragraphs=2');

    $response->assertOk();

    $data = $response->json('data');
    expect($data)->toContain("\n\n");
});

it('produces deterministic output with a seed', function () {
    $response1 = get('/l?paragraphs=1&seed=42&minWords=10&maxWords=10');
    $response2 = get('/l?paragraphs=1&seed=42&minWords=10&maxWords=10');

    expect($response1->json('data'))->toBe($response2->json('data'));
});

it('adds punctuation when requested', function () {
    $response = get('/l?paragraphs=1&addPunctuation=true&minWords=5&maxWords=5');

    $response->assertOk();

    $paragraph = $response->json('data.0');
    expect($paragraph)->toEndWith('.');
});

it('returns more words with higher maxWords', function () {
    $short = get('/l?paragraphs=1&minWords=3&maxWords=3&seed=1');
    $long = get('/l?paragraphs=1&minWords=20&maxWords=20&seed=1');

    $short->assertOk();
    $long->assertOk();

    expect(strlen($long->json('data.0')))->toBeGreaterThan(strlen($short->json('data.0')));
});
