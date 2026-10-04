<?php

namespace App\Http\Controllers;

use Closure;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

abstract class Controller
{
    /**
     * Cache a response as plain data. The cache store refuses to unserialize
     * objects (cache.serializable_classes), so Response objects can't be cached.
     * Error responses are not cached.
     */
    protected function rememberResponse(string $key, mixed $ttl, Closure $build): Response
    {
        $cached = Cache::get($key);

        if (is_array($cached)) {
            return response($cached['body'], $cached['status'], ['Content-Type' => $cached['type']]);
        }

        $response = $build();

        if ($response->isSuccessful()) {
            Cache::put($key, [
                'body' => $response->getContent(),
                'status' => $response->getStatusCode(),
                'type' => $response->headers->get('Content-Type'),
            ], $ttl);
        }

        return $response;
    }
}
