<?php

use App\Http\Controllers\ApiStatsController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\GeneratedFileController;
use App\Http\Controllers\Base64Controller;
use App\Http\Controllers\ColorConverterController;
use App\Http\Controllers\ColorsController;
use App\Http\Controllers\HashController;
use App\Http\Controllers\HealthController;
use App\Http\Controllers\UuidController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CsvController;
use App\Http\Controllers\FaviconController;
use App\Http\Controllers\HoldiconController;
use App\Http\Controllers\IconsController;
use App\Http\Controllers\JokesController;
use App\Http\Controllers\JsonPlaceholderController;
use App\Http\Controllers\LoremIpsumController;
use App\Http\Controllers\MarkdownController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PlaceholderController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\QuotesController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\McpController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::view('stats', 'stats')->name('stats');
Route::view('playground', 'playground')->name('playground');
Route::view('changelog', 'changelog')->name('changelog');
Route::get('api-stats', ApiStatsController::class)->name('api-stats');
Route::get('health', HealthController::class)->name('health');

Route::match(['get', 'post'], 'mcp', McpController::class)->name('mcp');

// Short format: /640x320?text=...&bg=...&fg=...
// This must come before other routes to avoid conflicts
Route::get('/{size}', PlaceholderController::class)
    ->where('size', '^\d+x\d+$')
    ->middleware(['throttle:120,1', 'track.api', 'ratelimit.headers'])
    ->name('placeholder.short');

Route::view('image', 'image');
Route::view('lorem-ipsum', 'loreum');
Route::view('jokes', 'jokes');
Route::view('quotes', 'quotes');
Route::view('weather', 'weather');
Route::view('recipes', 'recipes');
Route::view('colors', 'colors');
Route::view('avatar', 'avatar');
Route::view('holdicon', 'holdicon');
Route::view('favicon-generator', 'favicon');
Route::get('favicon', FaviconController::class)
    ->middleware(['throttle:120,1', 'track.api', 'ratelimit.headers'])
    ->name('favicon');
Route::view('cookie-policy', 'cookie-policy');
Route::view('terms-of-service', 'terms-of-service');
Route::view('privacy-policy', 'privacy-policy');
Route::view('about-us', 'about-us');
Route::view('api', 'api');
Route::view('ai-docs', 'ai-docs')->name('ai-docs');
Route::view('qrcode', 'qrcode');
Route::view('json-placeholder', 'json-placeholder')->name('json-placeholder');
Route::get('json/users', [JsonPlaceholderController::class, 'users'])
    ->middleware(['throttle:120,1', 'track.api', 'ratelimit.headers'])
    ->name('json.placeholder.users');
Route::get('json/posts', [JsonPlaceholderController::class, 'posts'])
    ->middleware(['throttle:120,1', 'track.api', 'ratelimit.headers'])
    ->name('json.placeholder.posts');
Route::get('json/comments', [JsonPlaceholderController::class, 'comments'])
    ->middleware(['throttle:120,1', 'track.api', 'ratelimit.headers'])
    ->name('json.placeholder.comments');
Route::get('json/todos', [JsonPlaceholderController::class, 'todos'])
    ->middleware(['throttle:120,1', 'track.api', 'ratelimit.headers'])
    ->name('json.placeholder.todos');
Route::view('icons', 'icons');
Route::view('contact', 'contact');
Route::post('contact', action: [ContactController::class, 'store'])->name('contact.submit');

Route::view('error-reporter', 'error-reporter');

Route::post('toggle-dark-mode', function () {
    $currentMode = Cookie::get('darkMode', 'false');
    $newMode = $currentMode === 'true' ? 'false' : 'true';
    Cookie::queue(Cookie::make('darkMode', $newMode, 1000));

    return redirect()->back();
})->name('toggle-dark-mode');

Route::get('/download-all-icons', [IconsController::class, 'downloadAllIcons'])
    ->middleware('throttle:10,1')
    ->name('download.all.icons');

Route::get('w', WeatherController::class)
    ->middleware(['throttle:120,1', 'track.api', 'ratelimit.headers'])
    ->name('weather');

Route::get('r', RecipeController::class)
    ->middleware(['throttle:120,1', 'track.api', 'ratelimit.headers'])
    ->name('recipe');

Route::get('q', QuotesController::class)
    ->middleware(['throttle:5,1', 'throttle:3600,60', 'track.api', 'ratelimit.headers'])
    ->name('quote');

Route::get('j', JokesController::class)
    ->middleware(['throttle:120,1', 'track.api', 'ratelimit.headers'])
    ->name('joke');

Route::get('l', LoremIpsumController::class)
    ->middleware(['throttle:120,1', 'track.api', 'ratelimit.headers']);

Route::get('/p/{size?}/{background_color?}/{text_color?}', PlaceholderController::class)
    ->middleware(['throttle:120,1', 'track.api', 'ratelimit.headers'])
    ->name('placeholder');

Route::get('avatar/{seed}', AvatarController::class)
    ->middleware(['throttle:120,1', 'track.api', 'ratelimit.headers'])
    ->name('avatar.show');

Route::get('h', HoldiconController::class)
    ->middleware(['throttle:120,1', 'track.api', 'ratelimit.headers'])
    ->name('holdicon');

Route::get('c', ColorsController::class)
    ->middleware(['throttle:120,1', 'track.api', 'ratelimit.headers'])
    ->name('colors');

Route::get('qr', QrCodeController::class)
    ->middleware(['throttle:120,1', 'track.api', 'ratelimit.headers'])
    ->name('qr');

Route::view('pdf-generator', 'pdf');
Route::get('pdf', PdfController::class)
    ->middleware(['throttle:30,1', 'track.api', 'ratelimit.headers'])
    ->name('pdf');

Route::view('csv-generator', 'csv');
Route::get('csv', CsvController::class)
    ->middleware(['throttle:120,1', 'track.api', 'ratelimit.headers'])
    ->name('csv');

Route::view('markdown-generator', 'markdown');
Route::get('md', MarkdownController::class)
    ->middleware(['throttle:120,1', 'track.api', 'ratelimit.headers'])
    ->name('markdown');

Route::view('video-generator', 'video');
Route::get('video', VideoController::class)
    ->middleware(['throttle:10,1', 'track.api', 'ratelimit.headers'])
    ->name('video');

Route::view('base64-tool', 'base64');
Route::get('base64', Base64Controller::class)
    ->middleware(['throttle:120,1', 'track.api', 'ratelimit.headers'])
    ->name('base64');

Route::view('hash-tool', 'hash');
Route::get('hash', HashController::class)
    ->middleware(['throttle:120,1', 'track.api', 'ratelimit.headers'])
    ->name('hash');

Route::view('uuid-tool', 'uuid');
Route::get('uuid', UuidController::class)
    ->middleware(['throttle:120,1', 'track.api', 'ratelimit.headers'])
    ->name('uuid');

Route::view('color-converter', 'color-converter');
Route::get('color/{hex}', ColorConverterController::class)
    ->where('hex', '[0-9a-fA-F]{3,6}')
    ->middleware(['throttle:120,1', 'track.api', 'ratelimit.headers'])
    ->name('color.convert');
