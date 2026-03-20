<?php

it('generates the OpenAPI spec file', function () {
    $output = 'public/openapi-test.json';

    $this->artisan('openapi:generate', ['--output' => $output])
        ->assertSuccessful();

    $path = base_path($output);
    expect(file_exists($path))->toBeTrue();

    $spec = json_decode(file_get_contents($path), true);
    expect($spec['openapi'])->toBe('3.0.3')
        ->and($spec['info']['title'])->toBe('placehold.cloud API')
        ->and($spec['paths'])->toBeArray()
        ->and(count($spec['paths']))->toBeGreaterThan(10);

    unlink($path);
});

it('serves the OpenAPI spec at /openapi.json', function () {
    $path = public_path('openapi.json');
    expect(file_exists($path))->toBeTrue();

    $spec = json_decode(file_get_contents($path), true);
    expect($spec['openapi'])->toBe('3.0.3');
});
