<?php

use function Pest\Laravel\get;

it('renders the home page', function () {
    get('/')->assertOk();
});

it('renders the image page', function () {
    get('/image')->assertOk();
});

it('renders the lorem ipsum page', function () {
    get('/lorem-ipsum')->assertOk();
});

it('renders the jokes page', function () {
    get('/jokes')->assertOk();
});

it('renders the quotes page', function () {
    get('/quotes')->assertOk();
});

it('renders the weather page', function () {
    get('/weather')->assertOk();
});

it('renders the recipes page', function () {
    get('/recipes')->assertOk();
});

it('renders the colors page', function () {
    get('/colors')->assertOk();
});

it('renders the holdicon page', function () {
    get('/holdicon')->assertOk();
});

it('renders the cookie policy page', function () {
    get('/cookie-policy')->assertOk();
});

it('renders the terms of service page', function () {
    get('/terms-of-service')->assertOk();
});

it('renders the privacy policy page', function () {
    get('/privacy-policy')->assertOk();
});

it('renders the about us page', function () {
    get('/about-us')->assertOk();
});

it('renders the api page', function () {
    get('/api')->assertOk();
});

it('renders the icons page', function () {
    get('/icons')->assertOk();
});

it('renders the contact page', function () {
    get('/contact')->assertOk();
});

it('renders the error reporter page', function () {
    get('/error-reporter')->assertOk();
});
