<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: ['mcp']);
        $middleware->alias([
            'track.api' => \App\Http\Middleware\TrackApiUsage::class,
            'ratelimit.headers' => \App\Http\Middleware\RateLimitHeaders::class,
            'cache.headers' => \App\Http\Middleware\AddCacheHeaders::class,
        ]);
        $middleware->appendToGroup('web', \App\Http\Middleware\AddCacheHeaders::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {})->create();
