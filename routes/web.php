<?php

use App\Http\Controllers\LoremIpsumController;
use App\Http\Controllers\PlaceholderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
if (request()->getHost() === 'lorem.placehold.cloud' || request()->getHost() === 'localhost') {
    Route::get('/', LoremIpsumController::class)
        ->middleware('throttle:60,1');
}

if (request()->getHost() === 'placehold.cloud' || request()->getHost() === 'localhost') {
    Route::get('/placeholder/{size?}/{background_color?}/{text_color?}', PlaceholderController::class)
        ->middleware('throttle:60,1');
}
