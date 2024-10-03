<?php

use App\Http\Controllers\JokesController;
use App\Http\Controllers\LoremIpsumController;
use App\Http\Controllers\PlaceholderController;
use App\Http\Controllers\QuotesController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::view('/image', 'image');

Route::get('weather', WeatherController::class);

Route::get('recipes', RecipeController::class);

Route::get('quotes', QuotesController::class);

Route::get('jokes', JokesController::class);

Route::get('lorem', LoremIpsumController::class)
    ->middleware('throttle:60,1');

Route::get('/p/{size?}/{background_color?}/{text_color?}', PlaceholderController::class)
    ->middleware('throttle:120,1')
    ->name('placeholder');
