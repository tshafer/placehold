<?php

use App\Models\Joke;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

beforeEach(function () {
    Joke::create([
        'body' => 'Why did the chicken cross the road? To get to the other side.',
        'title' => 'Classic Chicken',
        'category' => 'Puns',
        'rating' => '5',
    ]);

    Joke::create([
        'body' => 'I told my computer a joke. It crashed.',
        'title' => 'Computer Humor',
        'category' => 'Tech',
        'rating' => '4',
    ]);
});

it('returns a random joke', function () {
    $response = get('/j');

    $response->assertOk()
        ->assertJsonStructure(['body', 'title', 'category', 'rating']);
});

it('filters jokes by category', function () {
    $response = get('/j?category=Tech');

    $response->assertOk()
        ->assertJson(['category' => 'Tech']);
});

it('returns any category by default', function () {
    $response = get('/j');

    $response->assertOk();

    expect($response->json('category'))->toBeIn(['Puns', 'Tech']);
});
