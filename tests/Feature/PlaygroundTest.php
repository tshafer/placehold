<?php

use function Pest\Laravel\get;

it('renders the playground page', function () {
    get('/playground')->assertOk();
});

it('contains the editor and preview elements', function () {
    $response = get('/playground');

    expect($response->getContent())
        ->toContain('playground()')
        ->toContain('x-ref="preview"');
});
