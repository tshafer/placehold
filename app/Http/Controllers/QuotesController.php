<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class QuotesController extends Controller
{
    private const API_BASE_URL = 'http://api.quotable.io/';

    private const DEFAULT_CACHE_TIME = 2; // 1 hour in seconds

    private const DEFAULT_TAGS = '';

    private const DEFAULT_AUTHOR = '';

    private const DEFAULT_LENGTH = null;

    private const DEFAULT_LANGUAGE = 'en';

    private const DEFAULT_INCLUDE_METADATA = true;

    public function __invoke(Request $request)
    {
        $validated = $this->validateRequest($request);

        if ($validated instanceof \Illuminate\Http\JsonResponse) {
            return $validated;
        }

        $cacheKey = $this->generateCacheKey($validated);

        // return Cache::remember($cacheKey, $validated['cache_time'] ?? self::DEFAULT_CACHE_TIME, function () use ($validated) {
        return $this->fetchQuote($validated);
        // });
    }

    private function validateRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tags' => 'nullable|string',
            'author' => 'nullable|string',
            'cache_time' => 'integer|min:0',
            'length' => 'nullable|string|in:short,medium,long',
            'language' => 'nullable|string|size:2',
            'include_metadata' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()], 400);
        }

        return $validator->validated();
    }

    private function generateCacheKey(array $params): string
    {
        return 'quote_'.md5(json_encode($params));
    }

    private function fetchQuote(array $params)
    {
        try {
            $queryParams = [
                'tags' => $params['tags'] ?? self::DEFAULT_TAGS,
                'author' => $params['author'] ?? self::DEFAULT_AUTHOR,
                'maxLength' => $this->getLengthValue($params['length'] ?? self::DEFAULT_LENGTH),
            ];

            $response = Http::withoutVerifying()->get(self::API_BASE_URL.'random', $queryParams);

            if (! $response->successful()) {
                Log::error('Quote API Error', ['response' => $response->body()]);

                return response()->json(['status' => 'error', 'message' => 'Unable to fetch quote'], 500);
            }

            $data = $response->json();

            $quoteData = [
                'content' => $data['content'],
                'author' => $data['author'],
                'tags' => $data['tags'],
            ];

            if ($params['include_metadata'] ?? self::DEFAULT_INCLUDE_METADATA) {
                $quoteData['metadata'] = $this->fetchMetadata($data['authorSlug']);
            }

            if (isset($params['language']) && $params['language'] !== self::DEFAULT_LANGUAGE) {
                $quoteData['translated_content'] = $this->translateQuote($data['content'], $params['language']);
            }

            return response()->json([
                'status' => 'success',
                'data' => $quoteData,
                'timestamp' => now()->toDateTimeString(),
            ]);
        } catch (\Exception $e) {
            Log::error('Quote API Exception', ['error' => $e->getMessage()]);

            return response()->json(['status' => 'error', 'message' => 'An error occurred while fetching the quote'], 500);
        }
    }

    private function getLengthValue(?string $length): ?int
    {
        switch ($length) {
            case 'short':
                return 100;
            case 'medium':
                return 200;
            case 'long':
                return 300;
            default:
                return null;
        }
    }

    private function fetchMetadata(string $authorSlug)
    {
        $response = Http::withoutVerifying()->get(self::API_BASE_URL.'authors/'.$authorSlug);

        if ($response->successful()) {
            $data = $response->json();

            return [
                'bio' => $data['bio'] ?? null,
                'link' => $data['link'] ?? null,
                'born' => $data['born'] ?? null,
                'died' => $data['died'] ?? null,
            ];
        }

        return null;
    }

    private function translateQuote(string $content, string $targetLanguage)
    {
        // Note: This is a placeholder. You would need to implement an actual translation service here.
        // For example, you could use Google Translate API or another translation service.
        // For now, we'll just return the original content.
        Log::info("Translation requested for language: $targetLanguage");

        return $content;
    }
}
