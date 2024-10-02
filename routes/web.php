<?php

use App\Http\Controllers\PlaceholderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/placeholder/{size?}/{background_color?}/{text_color?}', PlaceholderController::class)
    ->middleware('throttle:60,1');
