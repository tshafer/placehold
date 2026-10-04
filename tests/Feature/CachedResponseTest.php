<?php

use Illuminate\Support\Facades\Cache;

use function Pest\Laravel\get;

// Prod uses a serializing store with serializable_classes=false; cache hits must not 500.
beforeEach(function () {
    config(['cache.default' => 'file', 'cache.stores.file.path' => storage_path('framework/cache/test')]);
    Cache::flush();
});

afterEach(fn () => Cache::flush());

it('serves cached responses on repeat hits', function (string $url) {
    get($url)->assertOk();
    get($url)->assertOk();
})->with(['/c', '/c?type=hex', '/h?seed=tom', '/h?seed=tom&robot=1']);
