<?php

use function Pest\Laravel\get;

it('requires a city parameter', function () {
    get('/w?country=US')
        ->assertStatus(400)
        ->assertJson(['status' => 'error']);
});

it('requires a country parameter', function () {
    get('/w?city=London')
        ->assertStatus(400)
        ->assertJson(['status' => 'error']);
});

it('rejects country longer than 2 characters', function () {
    get('/w?city=London&country=GBR')
        ->assertStatus(400)
        ->assertJson(['status' => 'error']);
});

it('rejects invalid units', function () {
    get('/w?city=London&country=GB&units=kelvin')
        ->assertStatus(400)
        ->assertJson(['status' => 'error']);
});

it('rejects forecast_days above 7', function () {
    get('/w?city=London&country=GB&forecast_days=10')
        ->assertStatus(400)
        ->assertJson(['status' => 'error']);
});
