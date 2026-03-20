<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class McpService
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('app.url', 'https://placehold.cloud'), '/');
    }

    public function tools(): array
    {
        return [
            [
                'name' => 'placehold_image',
                'description' => 'Generate a placeholder image URL from placehold.cloud. Use for mockups, wireframes, or temporary images. Returns the URL; the AI or user can embed it. Do not use for user-uploaded or real content.',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'size' => ['type' => 'string', 'description' => 'Dimensions: WxH or square N (e.g. 640x320 or 300)'],
                        'text' => ['type' => 'string', 'description' => 'Text overlay on the image'],
                        'bg' => ['type' => 'string', 'description' => 'Background hex color without #'],
                        'fg' => ['type' => 'string', 'description' => 'Foreground hex color without #'],
                        'format' => ['type' => 'string', 'enum' => ['png', 'jpg', 'jpeg', 'gif', 'webp', 'avif', 'bmp', 'ico', 'svg']],
                    ],
                    'required' => ['size'],
                ],
            ],
            [
                'name' => 'placehold_quote',
                'description' => 'Fetch a random inspirational quote from placehold.cloud. Use for placeholder content, demos, or inspiration. Returns a single quote object.',
                'inputSchema' => ['type' => 'object', 'properties' => []],
            ],
            [
                'name' => 'placehold_joke',
                'description' => 'Fetch a random joke from placehold.cloud. Use for placeholder or demo content.',
                'inputSchema' => ['type' => 'object', 'properties' => []],
            ],
            [
                'name' => 'placehold_lorem',
                'description' => 'Generate lorem ipsum placeholder text from placehold.cloud. Use for mock content, wireframes, or design placeholders.',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'paragraphs' => ['type' => 'integer', 'description' => 'Number of paragraphs (default 3)'],
                        'format' => ['type' => 'string', 'enum' => ['json', 'html', 'text'], 'description' => 'Response format'],
                    ],
                ],
            ],
            [
                'name' => 'placehold_uuid',
                'description' => 'Generate UUIDs from placehold.cloud. Use when you need random unique identifiers.',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'count' => ['type' => 'integer', 'description' => 'Number of UUIDs (default 1)', 'minimum' => 1, 'maximum' => 10],
                    ],
                ],
            ],
            [
                'name' => 'placehold_colors',
                'description' => 'Fetch color palettes, hex codes, or named colors from placehold.cloud. Use for design placeholders or theme ideas.',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'type' => ['type' => 'string', 'enum' => ['palette', 'hex', 'named'], 'description' => 'Type of color data (default: palette)'],
                        'count' => ['type' => 'integer', 'description' => 'Number of items (default 5)', 'minimum' => 1, 'maximum' => 10],
                    ],
                ],
            ],
        ];
    }

    public function call(string $name, array $arguments): array
    {
        return match ($name) {
            'placehold_image' => $this->placeholdImage($arguments),
            'placehold_quote' => $this->placeholdQuote(),
            'placehold_joke' => $this->placeholdJoke(),
            'placehold_lorem' => $this->placeholdLorem($arguments),
            'placehold_uuid' => $this->placeholdUuid($arguments),
            'placehold_colors' => $this->placeholdColors($arguments),
            default => ['content' => [['type' => 'text', 'text' => "Unknown tool: {$name}"]], 'isError' => true],
        };
    }

    private function placeholdImage(array $args): array
    {
        $size = $args['size'] ?? '';
        $sizePath = preg_match('/^\d+$/', $size) ? "{$size}x{$size}" : $size;
        $params = array_filter([
            'text' => $args['text'] ?? null,
            'bg' => $args['bg'] ?? null,
            'fg' => $args['fg'] ?? null,
            'format' => $args['format'] ?? null,
        ]);
        $url = $this->baseUrl.'/'.$sizePath.($params ? '?'.http_build_query($params) : '');

        return [
            'content' => [['type' => 'text', 'text' => "Placeholder image: {$url}"]],
        ];
    }

    private function placeholdQuote(): array
    {
        $response = Http::timeout(10)->get("{$this->baseUrl}/q");
        if (! $response->successful()) {
            return ['content' => [['type' => 'text', 'text' => "API error: {$response->status()}"]], 'isError' => true];
        }
        $data = $response->json();
        $text = is_array($data) && isset($data['quote']) ? $data['quote'] : json_encode($data);

        return ['content' => [['type' => 'text', 'text' => $text]]];
    }

    private function placeholdJoke(): array
    {
        $response = Http::timeout(10)->get("{$this->baseUrl}/j");
        if (! $response->successful()) {
            return ['content' => [['type' => 'text', 'text' => "API error: {$response->status()}"]], 'isError' => true];
        }
        $data = $response->json();
        $text = is_array($data) && (isset($data['joke']) || isset($data['setup']))
            ? ($data['joke'] ?? $data['setup'].' '.($data['delivery'] ?? ''))
            : json_encode($data);

        return ['content' => [['type' => 'text', 'text' => $text]]];
    }

    private function placeholdLorem(array $args): array
    {
        $params = array_filter([
            'paragraphs' => $args['paragraphs'] ?? null,
            'format' => $args['format'] ?? null,
        ]);
        $response = Http::timeout(10)->get("{$this->baseUrl}/l", $params);
        if (! $response->successful()) {
            return ['content' => [['type' => 'text', 'text' => "API error: {$response->status()}"]], 'isError' => true];
        }
        $contentType = $response->header('Content-Type') ?? '';
        $text = str_contains($contentType, 'json')
            ? json_encode($response->json())
            : (string) $response->body();

        return ['content' => [['type' => 'text', 'text' => mb_substr($text, 0, 15000)]]];
    }

    private function placeholdUuid(array $args): array
    {
        $params = isset($args['count']) ? ['count' => $args['count']] : [];
        $response = Http::timeout(10)->get("{$this->baseUrl}/uuid", $params);
        if (! $response->successful()) {
            return ['content' => [['type' => 'text', 'text' => "API error: {$response->status()}"]], 'isError' => true];
        }
        $data = $response->json();
        $uuids = is_array($data) ? $data : ($data['uuids'] ?? ($data['uuid'] ?? [$data]));
        $text = is_array($uuids) ? implode("\n", $uuids) : json_encode($data);

        return ['content' => [['type' => 'text', 'text' => $text]]];
    }

    private function placeholdColors(array $args): array
    {
        $params = array_filter([
            'type' => $args['type'] ?? null,
            'count' => $args['count'] ?? null,
        ]);
        $response = Http::timeout(10)->get("{$this->baseUrl}/c", $params);
        if (! $response->successful()) {
            return ['content' => [['type' => 'text', 'text' => "API error: {$response->status()}"]], 'isError' => true];
        }
        $data = $response->json();
        $text = json_encode($data, JSON_PRETTY_PRINT);
        $text = mb_substr($text, 0, 15000);

        return ['content' => [['type' => 'text', 'text' => $text]]];
    }
}
