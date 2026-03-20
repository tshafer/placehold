<?php

it('runs the changelog command in dry-run mode', function () {
    $this->artisan('changelog:generate', [
        'version' => '99.0.0',
        '--dry-run' => true,
        '--since' => 'HEAD~1',
    ])->assertSuccessful();
});

it('reads changelog from JSON file', function () {
    $path = storage_path('app/changelog.json');
    expect(file_exists($path))->toBeTrue();

    $data = json_decode(file_get_contents($path), true);
    expect($data)->toBeArray()
        ->and($data[0])->toHaveKeys(['version', 'date', 'tag', 'title', 'items']);
});

it('renders changelog page from JSON data', function () {
    $this->get('/changelog')
        ->assertOk()
        ->assertSee('v1.0.0');
});
