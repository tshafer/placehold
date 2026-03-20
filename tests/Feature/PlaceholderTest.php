<?php

use function Pest\Laravel\get;

it('generates an SVG placeholder with default parameters', function () {
    $response = get('/p/200x100?format=svg');

    $response->assertOk()
        ->assertHeader('Content-Type', 'image/svg+xml');

    expect($response->getContent())
        ->toContain('<svg')
        ->toContain('width="200"')
        ->toContain('height="100"');
});

it('generates an SVG placeholder via the short route', function () {
    $response = get('/200x100?format=svg');

    $response->assertOk()
        ->assertHeader('Content-Type', 'image/svg+xml');
});

it('renders custom text in SVG', function () {
    $response = get('/p/300x200?format=svg&text=Hello');

    $response->assertOk();

    expect($response->getContent())->toContain('Hello');
});

it('applies custom background and text colors in SVG', function () {
    $response = get('/p/100x100/FF0000/00FF00?format=svg');

    $response->assertOk();

    $content = $response->getContent();
    expect($content)
        ->toContain('#ff0000')
        ->toContain('#00ff00');
});

it('supports bg and fg query parameters in SVG', function () {
    $response = get('/p/100x100?format=svg&bg=0000FF&fg=FFFFFF');

    $response->assertOk();

    $content = $response->getContent();
    expect($content)
        ->toContain('#0000ff')
        ->toContain('#ffffff');
});

it('includes watermark in SVG', function () {
    $response = get('/p/400x200?format=svg&watermark=TestMark');

    $response->assertOk();

    expect($response->getContent())->toContain('TestMark');
});

it('includes dimensions text in SVG', function () {
    $response = get('/p/640x480?format=svg');

    $response->assertOk();

    expect($response->getContent())->toContain('640x480');
});

it('rejects width exceeding max', function () {
    get('/p/3000x100?format=svg')->assertStatus(400);
});

it('rejects height exceeding max', function () {
    get('/p/100x3000?format=svg')->assertStatus(400);
});

it('rejects invalid background color', function () {
    get('/p/100x100/ZZZZZZ?format=svg')->assertStatus(400);
});

it('rejects invalid format', function () {
    get('/p/100x100?format=tiff')->assertStatus(400);
});

it('rejects text exceeding max length', function () {
    $longText = str_repeat('a', 101);
    get("/p/100x100?format=svg&text={$longText}")->assertStatus(400);
});

it('sets proper cache headers', function () {
    $response = get('/p/100x100?format=svg');

    $response->assertOk()
        ->assertHeader('Cache-Control', 'max-age=604800, public')
        ->assertHeader('X-Content-Type-Options', 'nosniff')
        ->assertHeader('X-Frame-Options', 'DENY');
});

it('uses square dimensions for single-number size', function () {
    $response = get('/p/150?format=svg');

    $response->assertOk();

    $content = $response->getContent();
    expect($content)
        ->toContain('width="150"')
        ->toContain('height="150"');
});
