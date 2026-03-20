<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

class ApiStatsController extends Controller
{
    public function __invoke()
    {
        $endpoints = Cache::get('api_stats:endpoints', []);
        sort($endpoints);

        $today = now()->format('Y-m-d');
        $stats = [];

        foreach ($endpoints as $endpoint) {
            $stats[] = [
                'endpoint' => $endpoint,
                'today' => (int) Cache::get("api_stats:{$today}:{$endpoint}", 0),
                'total' => (int) Cache::get("api_stats:total:{$endpoint}", 0),
            ];
        }

        usort($stats, fn($a, $b) => $b['total'] <=> $a['total']);

        $globalToday = (int) Cache::get("api_stats:global:{$today}", 0);

        // Get last 7 days
        $daily = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $daily[] = [
                'date' => $date,
                'count' => (int) Cache::get("api_stats:global:{$date}", 0),
            ];
        }

        return response()->json([
            'today' => $globalToday,
            'endpoints' => $stats,
            'daily' => $daily,
            'generated_at' => now()->toIso8601String(),
        ]);
    }
}
