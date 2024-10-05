<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HoldiconController;
use App\Http\Controllers\IconsController;
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
Route::view('holdicon', 'holdicon');
Route::view('cookie-policy', 'cookie-policy');
Route::view('terms-of-service', 'terms-of-service');
Route::view('privacy-policy', 'privacy-policy');
Route::view('imprint', 'imprint');
Route::view('about-us', 'about-us');
Route::view('api', 'api');
Route::view('icons', 'icons');
Route::view('contact', 'contact');
Route::post('contact', action: [ContactController::class, 'store'])->name('contact.submit');
Route::get('/download-all-icons', [IconsController::class, 'downloadAllIcons'])

    ->middleware('throttle:10,1')
    ->name('download.all.icons');

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

Route::get('h', HoldiconController::class)
    ->middleware('throttle:120,1')
    ->name('holdicon');
