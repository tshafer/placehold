<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TrackApiUsage
{
    private const MAX_RESPONSE_SAMPLES = 1000;

    public function handle(Request $request, Closure $next)
    {
        $start = microtime(true);

        $response = $next($request);

        $endpoint = $request->route()?->getName() ?? $request->path();
        $durationMs = (int) round((microtime(true) - $start) * 1000);

        $todayKey = 'api_stats:' . now()->format('Y-m-d') . ':' . $endpoint;
        $totalKey = 'api_stats:total:' . $endpoint;
        $globalKey = 'api_stats:global:' . now()->format('Y-m-d');

        Cache::increment($todayKey);
        Cache::increment($totalKey);
        Cache::increment($globalKey);

        $this->recordResponseTime($endpoint, $durationMs);

        $endpoints = Cache::get('api_stats:endpoints', []);
        if (! in_array($endpoint, $endpoints)) {
            $endpoints[] = $endpoint;
            Cache::put('api_stats:endpoints', $endpoints, now()->addYear());
        }

        return $response;
    }

    private function recordResponseTime(string $endpoint, int $durationMs): void
    {
        $avgKey = 'api_stats:avg_ms:' . $endpoint;
        $countKey = 'api_stats:response_n:' . $endpoint;

        $avg = (float) Cache::get($avgKey, 0);
        $n = (int) Cache::get($countKey, 0);

        $n = min($n + 1, self::MAX_RESPONSE_SAMPLES);
        $avg = $n === 1 ? (float) $durationMs : ($avg * ($n - 1) + $durationMs) / $n;

        Cache::put($avgKey, $avg, now()->addDays(7));
        Cache::put($countKey, $n, now()->addDays(7));
    }
}
