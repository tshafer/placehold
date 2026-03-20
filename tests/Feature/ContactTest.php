<?php

use Illuminate\Support\Facades\Mail;

use function Pest\Laravel\post;

it('submits the contact form and redirects with success', function () {
    Mail::fake();

    $response = post('/contact', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'message' => 'Hello, this is a test message.',
    ]);

    $response->assertRedirect(route('home'))
        ->assertSessionHas('success');
});

it('requires a name', function () {
    Mail::fake();

    post('/contact', [
        'email' => 'john@example.com',
        'message' => 'Test',
    ])->assertSessionHasErrors('name');

    Mail::assertNothingSent();
});

it('requires a valid email', function () {
    Mail::fake();

    post('/contact', [
        'name' => 'John',
        'email' => 'not-an-email',
        'message' => 'Test',
    ])->assertSessionHasErrors('email');

    Mail::assertNothingSent();
});

it('requires a message', function () {
    Mail::fake();

    post('/contact', [
        'name' => 'John',
        'email' => 'john@example.com',
    ])->assertSessionHasErrors('message');

    Mail::assertNothingSent();
});

it('rejects an overly long name', function () {
    Mail::fake();

    post('/contact', [
        'name' => str_repeat('a', 256),
        'email' => 'john@example.com',
        'message' => 'Test',
    ])->assertSessionHasErrors('name');
});
