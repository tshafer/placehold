<?php

it('generates a sitemap file', function () {
    $this->artisan('sitemap:generate')
        ->assertSuccessful();

    $path = public_path('sitemap.xml');
    expect(file_exists($path))->toBeTrue();

    $content = file_get_contents($path);
    expect($content)
        ->toContain('<urlset')
        ->toContain('<loc>')
        ->toContain('placehold.cloud');
});

it('includes key pages in the sitemap', function () {
    $content = file_get_contents(public_path('sitemap.xml'));

    expect($content)
        ->toContain('/image')
        ->toContain('/api')
        ->toContain('/changelog');
});

it('excludes parameterized routes', function () {
    $content = file_get_contents(public_path('sitemap.xml'));

    expect($content)
        ->not->toContain('{')
        ->not->toContain('}');
});
