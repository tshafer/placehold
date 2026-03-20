<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TrackApiUsage
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $endpoint = $request->route()?->getName() ?? $request->path();

        $todayKey = 'api_stats:' . now()->format('Y-m-d') . ':' . $endpoint;
        $totalKey = 'api_stats:total:' . $endpoint;
        $globalKey = 'api_stats:global:' . now()->format('Y-m-d');

        Cache::increment($todayKey);
        Cache::increment($totalKey);
        Cache::increment($globalKey);

        // Track the endpoint in the known endpoints set
        $endpoints = Cache::get('api_stats:endpoints', []);
        if (!in_array($endpoint, $endpoints)) {
            $endpoints[] = $endpoint;
            Cache::put('api_stats:endpoints', $endpoints, now()->addYear());
        }

        return $response;
    }
}
