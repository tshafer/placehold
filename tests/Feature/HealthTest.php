<?php

use function Pest\Laravel\get;

it('returns health check JSON', function () {
    get('/health')
        ->assertOk()
        ->assertJsonStructure([
            'status',
            'version',
            'timestamp',
            'php',
            'laravel',
            'checks' => [
                'app',
                'cache',
                'database',
                'storage',
                'ffmpeg',
            ],
        ]);
});

it('reports healthy status when all checks pass', function () {
    $response = get('/health');

    $response->assertOk()
        ->assertJson(['status' => 'healthy']);
});

it('includes version from changelog', function () {
    $response = get('/health');
    $data = $response->json();

    expect($data['version'])->toMatch('/^\d+\.\d+\.\d+$/');
});
