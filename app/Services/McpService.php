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
            [
                'name' => 'placehold_weather',
                'description' => 'Fetch weather data from placehold.cloud. Requires city and country code (e.g. London, GB).',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'city' => ['type' => 'string', 'description' => 'City name (required)'],
                        'country' => ['type' => 'string', 'description' => 'Two-letter country code (required)'],
                        'units' => ['type' => 'string', 'enum' => ['metric', 'imperial', 'standard']],
                    ],
                    'required' => ['city', 'country'],
                ],
            ],
            [
                'name' => 'placehold_recipe',
                'description' => 'Fetch random recipe(s) from placehold.cloud. Use for placeholder or demo content.',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'number' => ['type' => 'integer', 'description' => 'Number of recipes (default 1)'],
                    ],
                ],
            ],
            [
                'name' => 'placehold_holdicon',
                'description' => 'Generate a holdicon placeholder icon URL (text, cat, dog, or robot). Returns the image URL.',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'seed' => ['type' => 'string', 'description' => 'Seed for deterministic output'],
                        'width' => ['type' => 'integer', 'description' => 'Width in pixels (default 128)'],
                        'height' => ['type' => 'integer', 'description' => 'Height in pixels'],
                        'text' => ['type' => 'string', 'description' => 'Overlay text'],
                        'robot' => ['type' => 'boolean', 'description' => 'Use robot icon'],
                        'cat' => ['type' => 'boolean', 'description' => 'Use cat icon'],
                        'dog' => ['type' => 'boolean', 'description' => 'Use dog icon'],
                    ],
                ],
            ],
            [
                'name' => 'placehold_avatar',
                'description' => 'Generate a deterministic identicon avatar URL from a seed string.',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'seed' => ['type' => 'string', 'description' => 'Seed (e.g. user id or email)'],
                    ],
                    'required' => ['seed'],
                ],
            ],
            [
                'name' => 'placehold_qr',
                'description' => 'Generate a QR code URL. Returns SVG or PNG image URL.',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'data' => ['type' => 'string', 'description' => 'Data to encode (required)'],
                        'size' => ['type' => 'integer', 'description' => 'Size in pixels (default 300)'],
                        'format' => ['type' => 'string', 'enum' => ['svg', 'png']],
                        'fg' => ['type' => 'string', 'description' => 'Foreground hex without #'],
                        'bg' => ['type' => 'string', 'description' => 'Background hex without #'],
                    ],
                    'required' => ['data'],
                ],
            ],
            [
                'name' => 'placehold_pdf',
                'description' => 'Generate a placeholder PDF document URL (lorem ipsum pages).',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'pages' => ['type' => 'integer', 'description' => 'Number of pages (1-50, default 3)'],
                        'title' => ['type' => 'string', 'description' => 'Document title'],
                        'size' => ['type' => 'string', 'enum' => ['a4', 'letter', 'legal']],
                        'orientation' => ['type' => 'string', 'enum' => ['portrait', 'landscape']],
                    ],
                ],
            ],
            [
                'name' => 'placehold_csv',
                'description' => 'Generate placeholder CSV or JSON data. Presets: users, products, orders, inventory, analytics.',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'preset' => ['type' => 'string', 'description' => 'Preset name: users, products, orders, inventory, analytics'],
                        'rows' => ['type' => 'integer', 'description' => 'Number of rows (default 10)'],
                        'format' => ['type' => 'string', 'enum' => ['csv', 'json']],
                    ],
                ],
            ],
            [
                'name' => 'placehold_markdown',
                'description' => 'Generate placeholder markdown text with headings, lists, code blocks, or tables.',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'sections' => ['type' => 'integer', 'description' => 'Number of sections (default 3)'],
                        'title' => ['type' => 'string', 'description' => 'Document title'],
                        'seed' => ['type' => 'integer', 'description' => 'Random seed for reproducibility'],
                    ],
                ],
            ],
            [
                'name' => 'placehold_video',
                'description' => 'Generate a placeholder MP4 video URL (static color, optional dimensions and duration).',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'w' => ['type' => 'integer', 'description' => 'Width (default 640)'],
                        'h' => ['type' => 'integer', 'description' => 'Height (default 360)'],
                        'duration' => ['type' => 'integer', 'description' => 'Duration in seconds (1-30, default 5)'],
                        'bg' => ['type' => 'string', 'description' => 'Background hex without #'],
                        'text' => ['type' => 'string', 'description' => 'Overlay text'],
                    ],
                ],
            ],
            [
                'name' => 'placehold_base64',
                'description' => 'Encode or decode base64. Use operation "encode" or "decode" and provide data.',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'operation' => ['type' => 'string', 'enum' => ['encode', 'decode'], 'description' => 'encode or decode'],
                        'data' => ['type' => 'string', 'description' => 'String to encode, or base64 string to decode'],
                    ],
                    'required' => ['operation', 'data'],
                ],
            ],
            [
                'name' => 'placehold_hash',
                'description' => 'Compute hash of a string. Algorithms: md5, sha1, sha256, sha384, sha512, etc.',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'data' => ['type' => 'string', 'description' => 'String to hash (required)'],
                        'algo' => ['type' => 'string', 'description' => 'Algorithm (default sha256). Options: md5, sha1, sha256, sha384, sha512'],
                    ],
                    'required' => ['data'],
                ],
            ],
            [
                'name' => 'placehold_color_convert',
                'description' => 'Convert a hex color: get RGB, complement, contrast info. Hex is 3 or 6 digits without #.',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'hex' => ['type' => 'string', 'description' => 'Hex color without # (e.g. F44336 or fff)'],
                    ],
                    'required' => ['hex'],
                ],
            ],
            [
                'name' => 'placehold_json_users',
                'description' => 'Generate fake user list (JSON). Optional count, page, seed.',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'count' => ['type' => 'integer', 'description' => 'Number of users (default 10)'],
                        'page' => ['type' => 'integer', 'description' => 'Page number'],
                        'seed' => ['type' => 'integer', 'description' => 'Random seed'],
                    ],
                ],
            ],
            [
                'name' => 'placehold_json_posts',
                'description' => 'Generate fake posts list (JSON). Optional count, page, seed.',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'count' => ['type' => 'integer', 'description' => 'Number of posts (default 10)'],
                        'page' => ['type' => 'integer'],
                        'seed' => ['type' => 'integer'],
                    ],
                ],
            ],
            [
                'name' => 'placehold_json_comments',
                'description' => 'Generate fake comments list (JSON). Optional count, page, seed.',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'count' => ['type' => 'integer', 'description' => 'Number of comments (default 10)'],
                        'page' => ['type' => 'integer'],
                        'seed' => ['type' => 'integer'],
                    ],
                ],
            ],
            [
                'name' => 'placehold_json_todos',
                'description' => 'Generate fake todos list (JSON). Optional count, page, seed.',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'count' => ['type' => 'integer', 'description' => 'Number of todos (default 10)'],
                        'page' => ['type' => 'integer'],
                        'seed' => ['type' => 'integer'],
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
            'placehold_weather' => $this->placeholdWeather($arguments),
            'placehold_recipe' => $this->placeholdRecipe($arguments),
            'placehold_holdicon' => $this->placeholdHoldicon($arguments),
            'placehold_avatar' => $this->placeholdAvatar($arguments),
            'placehold_qr' => $this->placeholdQr($arguments),
            'placehold_pdf' => $this->placeholdPdf($arguments),
            'placehold_csv' => $this->placeholdCsv($arguments),
            'placehold_markdown' => $this->placeholdMarkdown($arguments),
            'placehold_video' => $this->placeholdVideo($arguments),
            'placehold_base64' => $this->placeholdBase64($arguments),
            'placehold_hash' => $this->placeholdHash($arguments),
            'placehold_color_convert' => $this->placeholdColorConvert($arguments),
            'placehold_json_users' => $this->placeholdJson($arguments, 'users'),
            'placehold_json_posts' => $this->placeholdJson($arguments, 'posts'),
            'placehold_json_comments' => $this->placeholdJson($arguments, 'comments'),
            'placehold_json_todos' => $this->placeholdJson($arguments, 'todos'),
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

    private function placeholdWeather(array $args): array
    {
        $city = $args['city'] ?? '';
        $country = $args['country'] ?? '';
        if ($city === '' || $country === '') {
            return ['content' => [['type' => 'text', 'text' => 'city and country are required']], 'isError' => true];
        }
        $params = array_filter([
            'city' => $city,
            'country' => $country,
            'units' => $args['units'] ?? null,
        ]);
        $response = Http::timeout(15)->get("{$this->baseUrl}/w", $params);
        if (! $response->successful()) {
            return ['content' => [['type' => 'text', 'text' => "API error: {$response->status()}"]], 'isError' => true];
        }
        $text = json_encode($response->json(), JSON_PRETTY_PRINT);
        return ['content' => [['type' => 'text', 'text' => mb_substr($text, 0, 15000)]]];
    }

    private function placeholdRecipe(array $args): array
    {
        $params = isset($args['number']) ? ['number' => $args['number']] : [];
        $response = Http::timeout(10)->get("{$this->baseUrl}/r", $params);
        if (! $response->successful()) {
            return ['content' => [['type' => 'text', 'text' => "API error: {$response->status()}"]], 'isError' => true];
        }
        $text = json_encode($response->json(), JSON_PRETTY_PRINT);
        return ['content' => [['type' => 'text', 'text' => mb_substr($text, 0, 15000)]]];
    }

    private function placeholdHoldicon(array $args): array
    {
        $params = array_filter([
            'seed' => $args['seed'] ?? null,
            'width' => $args['width'] ?? null,
            'height' => $args['height'] ?? null,
            'text' => $args['text'] ?? null,
            'robot' => isset($args['robot']) ? ($args['robot'] ? 'true' : 'false') : null,
            'cat' => isset($args['cat']) ? ($args['cat'] ? 'true' : 'false') : null,
            'dog' => isset($args['dog']) ? ($args['dog'] ? 'true' : 'false') : null,
        ]);
        $url = $this->baseUrl.'/h'.($params ? '?'.http_build_query($params) : '');
        return ['content' => [['type' => 'text', 'text' => "Holdicon: {$url}"]]];
    }

    private function placeholdAvatar(array $args): array
    {
        $seed = $args['seed'] ?? '';
        if ($seed === '') {
            return ['content' => [['type' => 'text', 'text' => 'seed is required']], 'isError' => true];
        }
        $url = $this->baseUrl.'/avatar/'.rawurlencode($seed);
        return ['content' => [['type' => 'text', 'text' => "Avatar: {$url}"]]];
    }

    private function placeholdQr(array $args): array
    {
        $data = $args['data'] ?? '';
        if ($data === '') {
            return ['content' => [['type' => 'text', 'text' => 'data is required']], 'isError' => true];
        }
        $params = array_filter([
            'data' => $data,
            'size' => $args['size'] ?? null,
            'format' => $args['format'] ?? null,
            'fg' => $args['fg'] ?? null,
            'bg' => $args['bg'] ?? null,
        ]);
        $url = $this->baseUrl.'/qr?'.http_build_query($params);
        return ['content' => [['type' => 'text', 'text' => "QR code: {$url}"]]];
    }

    private function placeholdPdf(array $args): array
    {
        $params = array_filter([
            'pages' => $args['pages'] ?? null,
            'title' => $args['title'] ?? null,
            'size' => $args['size'] ?? null,
            'orientation' => $args['orientation'] ?? null,
        ]);
        $url = $this->baseUrl.'/pdf'.($params ? '?'.http_build_query($params) : '');
        return ['content' => [['type' => 'text', 'text' => "PDF: {$url}"]]];
    }

    private function placeholdCsv(array $args): array
    {
        $params = array_filter([
            'preset' => $args['preset'] ?? null,
            'rows' => $args['rows'] ?? null,
            'format' => $args['format'] ?? null,
        ]);
        $response = Http::timeout(15)->get("{$this->baseUrl}/csv", $params);
        if (! $response->successful()) {
            return ['content' => [['type' => 'text', 'text' => "API error: {$response->status()}"]], 'isError' => true];
        }
        $contentType = $response->header('Content-Type') ?? '';
        $text = str_contains($contentType, 'json') ? json_encode($response->json(), JSON_PRETTY_PRINT) : (string) $response->body();
        return ['content' => [['type' => 'text', 'text' => mb_substr($text, 0, 20000)]]];
    }

    private function placeholdMarkdown(array $args): array
    {
        $params = array_filter([
            'sections' => $args['sections'] ?? null,
            'title' => $args['title'] ?? null,
            'seed' => $args['seed'] ?? null,
        ]);
        $response = Http::timeout(10)->get("{$this->baseUrl}/md", $params);
        if (! $response->successful()) {
            return ['content' => [['type' => 'text', 'text' => "API error: {$response->status()}"]], 'isError' => true];
        }
        return ['content' => [['type' => 'text', 'text' => mb_substr((string) $response->body(), 0, 15000)]]];
    }

    private function placeholdVideo(array $args): array
    {
        $params = array_filter([
            'w' => $args['w'] ?? null,
            'h' => $args['h'] ?? null,
            'duration' => $args['duration'] ?? null,
            'bg' => $args['bg'] ?? null,
            'text' => $args['text'] ?? null,
        ]);
        $url = $this->baseUrl.'/video'.($params ? '?'.http_build_query($params) : '');
        return ['content' => [['type' => 'text', 'text' => "Video: {$url}"]]];
    }

    private function placeholdBase64(array $args): array
    {
        $op = $args['operation'] ?? '';
        $data = $args['data'] ?? '';
        if ($op === '' || $data === '') {
            return ['content' => [['type' => 'text', 'text' => 'operation and data are required']], 'isError' => true];
        }
        $key = $op === 'encode' ? 'encode' : 'decode';
        $response = Http::timeout(10)->get("{$this->baseUrl}/base64", [$key => $data]);
        if (! $response->successful()) {
            return ['content' => [['type' => 'text', 'text' => "API error: {$response->status()}"]], 'isError' => true];
        }
        $text = json_encode($response->json(), JSON_PRETTY_PRINT);
        return ['content' => [['type' => 'text', 'text' => $text]]];
    }

    private function placeholdHash(array $args): array
    {
        $data = $args['data'] ?? '';
        if ($data === '') {
            return ['content' => [['type' => 'text', 'text' => 'data is required']], 'isError' => true];
        }
        $params = array_filter(['data' => $data, 'algo' => $args['algo'] ?? null]);
        $response = Http::timeout(10)->get("{$this->baseUrl}/hash", $params);
        if (! $response->successful()) {
            return ['content' => [['type' => 'text', 'text' => "API error: {$response->status()}"]], 'isError' => true];
        }
        $text = json_encode($response->json(), JSON_PRETTY_PRINT);
        return ['content' => [['type' => 'text', 'text' => $text]]];
    }

    private function placeholdColorConvert(array $args): array
    {
        $hex = $args['hex'] ?? '';
        $hex = preg_replace('/^#/', '', $hex);
        if ($hex === '' || ! preg_match('/^[0-9a-fA-F]{3,6}$/', $hex)) {
            return ['content' => [['type' => 'text', 'text' => 'hex is required (3 or 6 digits, no #)']], 'isError' => true];
        }
        $response = Http::timeout(10)->get("{$this->baseUrl}/color/{$hex}");
        if (! $response->successful()) {
            return ['content' => [['type' => 'text', 'text' => "API error: {$response->status()}"]], 'isError' => true];
        }
        $text = json_encode($response->json(), JSON_PRETTY_PRINT);
        return ['content' => [['type' => 'text', 'text' => $text]]];
    }

    private function placeholdJson(array $args, string $resource): array
    {
        $params = array_filter([
            'count' => $args['count'] ?? null,
            'page' => $args['page'] ?? null,
            'seed' => $args['seed'] ?? null,
        ]);
        $response = Http::timeout(10)->get("{$this->baseUrl}/json/{$resource}", $params);
        if (! $response->successful()) {
            return ['content' => [['type' => 'text', 'text' => "API error: {$response->status()}"]], 'isError' => true];
        }
        $text = json_encode($response->json(), JSON_PRETTY_PRINT);
        return ['content' => [['type' => 'text', 'text' => mb_substr($text, 0, 20000)]]];
    }
}
