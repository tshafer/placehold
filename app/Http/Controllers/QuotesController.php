<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class QuotesController extends Controller
{
    private const API_BASE_URL = 'http://api.quotable.io/';

    private const DEFAULT_CACHE_TIME = 3600; // 1 hour in seconds

    public function __invoke(Request $request)
    {
        $cacheKey = $this->generateCacheKey();

        return Cache::remember($cacheKey, self::DEFAULT_CACHE_TIME, function () {
            return $this->fetchQuote();
        });
    }

    private function generateCacheKey(): string
    {
        $id = Arr::random(range(1, 200000));

        return 'quote_'.$id;
    }

    private function fetchQuote()
    {
        try {
            $response = Http::withoutVerifying()->get(self::API_BASE_URL.'quotes/random');

            $data = $response->json();

            return response()->json([
                'status' => 'success',
                'data' => $data,
                'timestamp' => now()->toDateTimeString(),
            ]);
        } catch (\Exception $e) {
            Log::error('Quote API Exception', ['error' => $e->getMessage()]);

            return response()->json(['status' => 'error', 'message' => 'An error occurred while fetching the quote'], 500);
        }
    }
}
