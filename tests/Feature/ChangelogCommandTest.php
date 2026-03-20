<?php

it('runs the changelog command in dry-run mode', function () {
    $this->artisan('changelog:generate', [
        'version' => '99.0.0',
        '--dry-run' => true,
        '--since' => 'HEAD',
    ])->assertSuccessful();
});

it('reads changelog from JSON file', function () {
    $dir = storage_path('app');
    if (! is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    $fixture = file_get_contents(base_path('tests/fixtures/changelog.json'));
    $path = storage_path('app/changelog.json');
    file_put_contents($path, $fixture);

    expect(file_exists($path))->toBeTrue();
    $data = json_decode(file_get_contents($path), true);
    expect($data)->toBeArray()
        ->and($data[0])->toHaveKeys(['version', 'date', 'tag', 'title', 'items']);
});

it('renders changelog page from JSON data', function () {
    $dir = storage_path('app');
    if (! is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    file_put_contents(storage_path('app/changelog.json'), file_get_contents(base_path('tests/fixtures/changelog.json')));

    $this->get('/changelog')
        ->assertOk()
        ->assertSee('v1.0.0');
});
