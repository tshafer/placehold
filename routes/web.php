<?php

use App\Http\Controllers\JokesController;
use App\Http\Controllers\LoremIpsumController;
use App\Http\Controllers\PlaceholderController;
use App\Http\Controllers\QuotesController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::view('image', 'image');
Route::view('lorem-ipsum', 'loreum');
Route::view('jokes', 'jokes');
Route::view('quotes', 'quotes');
Route::view('weather', 'weather');
Route::view('recipes', 'recipes');

Route::get('w', WeatherController::class)
    ->middleware('throttle:120,1')
    ->name('weather');

Route::get('r', RecipeController::class)
    ->middleware('throttle:120,1')
    ->name('recipe');

Route::get('q', QuotesController::class)
    ->middleware('throttle:5,1')
    ->middleware('throttle:3600,60')
    ->name('quote');

Route::get('j', JokesController::class)
    ->middleware('throttle:120,1')
    ->name('joke');

Route::get('l', LoremIpsumController::class)
    ->middleware('throttle:120,1');

Route::get('/p/{size?}/{background_color?}/{text_color?}', PlaceholderController::class)
    ->middleware('throttle:120,1')
    ->name('placeholder');
