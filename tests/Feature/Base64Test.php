<?php

use function Pest\Laravel\get;

it('encodes a string', function () {
    get('/base64?encode=hello')
        ->assertOk()
        ->assertJson([
            'output' => 'aGVsbG8=',
            'operation' => 'encode',
        ]);
});

it('decodes a string', function () {
    get('/base64?decode=aGVsbG8=')
        ->assertOk()
        ->assertJson([
            'output' => 'hello',
            'operation' => 'decode',
        ]);
});

it('requires encode or decode parameter', function () {
    get('/base64')->assertStatus(422);
});

it('rejects invalid base64 on decode', function () {
    get('/base64?decode=!!!')->assertStatus(422);
});

it('renders the base64 docs page', function () {
    get('/base64-tool')->assertOk();
});
