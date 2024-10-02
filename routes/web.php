<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaceholderController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/placeholder/{size?}/{background_color?}/{text_color?}', PlaceholderController::class);
