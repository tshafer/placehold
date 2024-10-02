<?php

use App\Http\Controllers\LoremIpsumController;
use App\Http\Controllers\PlaceholderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('lorem', LoremIpsumController::class)
    ->middleware('throttle:60,1');

Route::get('/placeholder/{size?}/{background_color?}/{text_color?}', PlaceholderController::class)
    ->middleware('throttle:60,1');
