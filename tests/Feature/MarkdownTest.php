<?php

use function Pest\Laravel\get;

it('generates markdown with default parameters', function () {
    $response = get('/md');

    $response->assertOk()
        ->assertHeader('Content-Type', 'text/markdown; charset=UTF-8');

    expect($response->getContent())->toContain('# ')
        ->toContain('## ');
});

it('respects custom section count', function () {
    $response = get('/md?sections=3&features=paragraph');

    $response->assertOk();
    $content = $response->getContent();
    preg_match_all('/^## /m', $content, $matches);
    expect(count($matches[0]))->toBe(3);
});

it('uses a custom title', function () {
    $response = get('/md?title=My+Custom+Title');

    $response->assertOk();
    expect($response->getContent())->toContain('# My Custom Title');
});

it('produces deterministic output with seed', function () {
    $first = get('/md?sections=2&seed=42')->getContent();
    $second = get('/md?sections=2&seed=42')->getContent();

    expect($first)->toBe($second);
});

it('includes table of contents when requested', function () {
    $response = get('/md?sections=2&features=toc,paragraph');

    $response->assertOk();
    expect($response->getContent())->toContain('## Table of Contents');
});

it('renders the markdown docs page', function () {
    get('/markdown-generator')->assertOk();
});
