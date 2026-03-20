<?php

use Illuminate\Support\Facades\Http;

use function Pest\Laravel\get;

it('returns recipes from the API', function () {
    Http::fake([
        'www.themealdb.com/*' => Http::response([
            'meals' => [[
                'idMeal' => '12345',
                'strMeal' => 'Spaghetti Bolognese',
                'strMealThumb' => 'https://example.com/spaghetti.jpg',
                'strCategory' => 'Pasta',
                'strArea' => 'Italian',
                'strInstructions' => 'Cook the pasta.',
                'strSource' => 'https://example.com',
                'strYoutube' => 'https://youtube.com/watch?v=123',
                'strIngredient1' => 'Spaghetti',
                'strMeasure1' => '200g',
                'strIngredient2' => 'Ground Beef',
                'strMeasure2' => '300g',
                'strIngredient3' => '',
                'strMeasure3' => '',
                ...collect(range(4, 20))->mapWithKeys(fn ($i) => [
                    "strIngredient{$i}" => '',
                    "strMeasure{$i}" => '',
                ])->all(),
            ]],
        ]),
    ]);

    $response = get('/r?number=1');

    $response->assertOk()
        ->assertJson(['status' => 'success'])
        ->assertJsonStructure([
            'status',
            'data' => [['id', 'title', 'image', 'category', 'area', 'instructions', 'ingredients']],
            'timestamp',
        ]);

    $recipe = $response->json('data.0');
    expect($recipe['title'])->toBe('Spaghetti Bolognese');
    expect($recipe['ingredients'])->toHaveCount(2);
});

it('validates number parameter', function () {
    get('/r?number=0')->assertStatus(400);
    get('/r?number=30')->assertStatus(400);
});

it('handles API failure gracefully', function () {
    Http::fake([
        'www.themealdb.com/*' => Http::response(null, 500),
    ]);

    $response = get('/r?number=1');

    $response->assertStatus(500)
        ->assertJson(['status' => 'error']);
});
