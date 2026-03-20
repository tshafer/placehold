<?php

use function Pest\Laravel\get;

it('generates a PDF with default parameters', function () {
    $response = get('/pdf');

    $response->assertOk()
        ->assertHeader('Content-Type', 'application/pdf');
});

it('generates a PDF with custom page count', function () {
    get('/pdf?pages=2')->assertOk();
});

it('generates a PDF with custom title', function () {
    get('/pdf?title=Test+Document')->assertOk();
});

it('supports landscape orientation', function () {
    get('/pdf?orientation=landscape')->assertOk();
});

it('supports letter page size', function () {
    get('/pdf?size=letter')->assertOk();
});

it('clamps pages to valid range', function () {
    get('/pdf?pages=100')->assertOk();
    get('/pdf?pages=0')->assertOk();
});

it('renders the PDF docs page', function () {
    get('/pdf-generator')->assertOk();
});
