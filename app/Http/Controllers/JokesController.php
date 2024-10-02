<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class JokesController extends Controller
{
    private const API_BASE_URL = 'https://v2.jokeapi.dev/';

    private const DEFAULT_CACHE_TIME = 3600; // 1 hour in seconds

    public function __invoke(Request $request)
    {

        // return Cache::remember($cacheKey, self::DEFAULT_CACHE_TIME, function () {
        return $this->fetchJoke();
        // });
    }

    private function generateCacheKey(array $params): string
    {
        return 'joke_'.md5(json_encode($params));
    }

    private function fetchJoke()
    {
        try {

            $response = Http::get(self::API_BASE_URL.'joke/Any');

            if (! $response->successful()) {
                Log::error('Joke API Error', ['response' => $response->body()]);

                return response()->json(['status' => 'error', 'message' => 'Unable to fetch joke'], 500);
            }

            $data = $response->json();

            $jokeData = [
                'category' => $data['category'],
                'type' => $data['type'],
                'joke' => $data['type'] === 'single' ? $data['joke'] : null,
                'setup' => $data['type'] === 'twopart' ? $data['setup'] : null,
                'delivery' => $data['type'] === 'twopart' ? $data['delivery'] : null,
            ];

            return response()->json([
                'status' => 'success',
                'data' => $jokeData,
                'timestamp' => now()->toDateTimeString(),
            ]);
        } catch (\Exception $e) {
            Log::error('Joke API Exception', ['error' => $e->getMessage()]);

            return response()->json(['status' => 'error', 'message' => 'An error occurred while fetching the joke'], 500);
        }
    }
}
