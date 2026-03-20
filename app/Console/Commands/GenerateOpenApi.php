<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class GenerateOpenApi extends Command
{
    protected $signature = 'openapi:generate {--output=public/openapi.json : Output file path}';
    protected $description = 'Generate an OpenAPI 3.0 spec from registered routes';

    private const API_ROUTES = [
        'placeholder' => [
            'summary' => 'Generate placeholder image',
            'params' => [
                ['name' => 'size', 'in' => 'path', 'description' => 'Dimensions (e.g. 300x200)', 'example' => '300x200'],
                ['name' => 'background_color', 'in' => 'path', 'description' => 'Hex background color', 'example' => 'C8C8C8'],
                ['name' => 'text_color', 'in' => 'path', 'description' => 'Hex text color', 'example' => '323232'],
                ['name' => 'text', 'in' => 'query', 'description' => 'Custom overlay text'],
                ['name' => 'format', 'in' => 'query', 'description' => 'Output format', 'example' => 'png'],
            ],
            'response_type' => 'image/png',
        ],
        'placeholder.short' => [
            'summary' => 'Generate placeholder image (short URL)',
            'params' => [
                ['name' => 'size', 'in' => 'path', 'description' => 'WxH dimensions', 'example' => '640x320'],
                ['name' => 'text', 'in' => 'query', 'description' => 'Custom overlay text'],
                ['name' => 'bg', 'in' => 'query', 'description' => 'Background hex', 'example' => 'efefef'],
                ['name' => 'fg', 'in' => 'query', 'description' => 'Text hex', 'example' => '374151'],
            ],
            'response_type' => 'image/png',
        ],
        'avatar.show' => [
            'summary' => 'Generate identicon avatar',
            'params' => [
                ['name' => 'seed', 'in' => 'path', 'description' => 'Seed string for deterministic avatar', 'example' => 'alice'],
                ['name' => 'size', 'in' => 'query', 'description' => 'Size in pixels (default 200)', 'example' => '200'],
            ],
            'response_type' => 'image/svg+xml',
        ],
        'qr' => [
            'summary' => 'Generate QR code',
            'params' => [
                ['name' => 'data', 'in' => 'query', 'description' => 'Data to encode (required)', 'example' => 'https://example.com'],
                ['name' => 'size', 'in' => 'query', 'description' => 'Size in pixels', 'example' => '200'],
                ['name' => 'format', 'in' => 'query', 'description' => 'svg or png', 'example' => 'svg'],
                ['name' => 'fg', 'in' => 'query', 'description' => 'Foreground hex', 'example' => '000000'],
                ['name' => 'bg', 'in' => 'query', 'description' => 'Background hex', 'example' => 'ffffff'],
            ],
            'response_type' => 'image/svg+xml',
        ],
        'favicon' => [
            'summary' => 'Generate letter/emoji favicon',
            'params' => [
                ['name' => 'text', 'in' => 'query', 'description' => 'Letter or emoji', 'example' => 'A'],
                ['name' => 'bg', 'in' => 'query', 'description' => 'Background hex', 'example' => '6366f1'],
                ['name' => 'fg', 'in' => 'query', 'description' => 'Text hex', 'example' => 'ffffff'],
                ['name' => 'size', 'in' => 'query', 'description' => 'Size in pixels', 'example' => '64'],
            ],
            'response_type' => 'image/svg+xml',
        ],
        'json.placeholder.users' => [
            'summary' => 'Get fake user data',
            'params' => [
                ['name' => 'count', 'in' => 'query', 'description' => 'Number of records (1-100)', 'example' => '10'],
                ['name' => 'seed', 'in' => 'query', 'description' => 'Deterministic seed'],
                ['name' => 'page', 'in' => 'query', 'description' => 'Page number'],
            ],
            'response_type' => 'application/json',
        ],
        'json.placeholder.posts' => [
            'summary' => 'Get fake blog posts',
            'params' => [
                ['name' => 'count', 'in' => 'query', 'description' => 'Number of records (1-100)', 'example' => '10'],
                ['name' => 'seed', 'in' => 'query', 'description' => 'Deterministic seed'],
            ],
            'response_type' => 'application/json',
        ],
        'json.placeholder.comments' => [
            'summary' => 'Get fake comments',
            'params' => [
                ['name' => 'count', 'in' => 'query', 'description' => 'Number of records (1-100)', 'example' => '10'],
            ],
            'response_type' => 'application/json',
        ],
        'json.placeholder.todos' => [
            'summary' => 'Get fake todo items',
            'params' => [
                ['name' => 'count', 'in' => 'query', 'description' => 'Number of records (1-100)', 'example' => '10'],
            ],
            'response_type' => 'application/json',
        ],
        'weather' => [
            'summary' => 'Get weather data',
            'params' => [
                ['name' => 'city', 'in' => 'query', 'description' => 'City name (required)', 'example' => 'London'],
                ['name' => 'country', 'in' => 'query', 'description' => '2-letter country code (required)', 'example' => 'GB'],
                ['name' => 'units', 'in' => 'query', 'description' => 'metric, imperial, or standard'],
            ],
            'response_type' => 'application/json',
        ],
        'quote' => [
            'summary' => 'Get a random quote',
            'params' => [],
            'response_type' => 'application/json',
        ],
        'joke' => [
            'summary' => 'Get a random joke',
            'params' => [
                ['name' => 'category', 'in' => 'query', 'description' => 'programming, dad, or any'],
            ],
            'response_type' => 'application/json',
        ],
        'recipe' => [
            'summary' => 'Get random recipes',
            'params' => [
                ['name' => 'number', 'in' => 'query', 'description' => 'Number of recipes (1-10)', 'example' => '1'],
            ],
            'response_type' => 'application/json',
        ],
        'colors' => [
            'summary' => 'Generate color palettes',
            'params' => [
                ['name' => 'type', 'in' => 'query', 'description' => 'hex, named, or all'],
                ['name' => 'count', 'in' => 'query', 'description' => 'Number of colors (1-10)', 'example' => '5'],
            ],
            'response_type' => 'application/json',
        ],
        'pdf' => [
            'summary' => 'Generate placeholder PDF',
            'params' => [
                ['name' => 'pages', 'in' => 'query', 'description' => 'Number of pages (1-50)', 'example' => '3'],
                ['name' => 'title', 'in' => 'query', 'description' => 'Document title'],
                ['name' => 'size', 'in' => 'query', 'description' => 'a4 or letter'],
                ['name' => 'orientation', 'in' => 'query', 'description' => 'portrait or landscape'],
            ],
            'response_type' => 'application/pdf',
        ],
        'csv' => [
            'summary' => 'Generate fake tabular data',
            'params' => [
                ['name' => 'rows', 'in' => 'query', 'description' => 'Number of rows (1-1000)', 'example' => '50'],
                ['name' => 'preset', 'in' => 'query', 'description' => 'users, products, orders, employees, contacts'],
                ['name' => 'columns', 'in' => 'query', 'description' => 'Comma-separated column types'],
                ['name' => 'format', 'in' => 'query', 'description' => 'csv, tsv, or json'],
            ],
            'response_type' => 'text/csv',
        ],
        'markdown' => [
            'summary' => 'Generate placeholder Markdown',
            'params' => [
                ['name' => 'sections', 'in' => 'query', 'description' => 'Number of sections (1-20)', 'example' => '5'],
                ['name' => 'title', 'in' => 'query', 'description' => 'Document title'],
                ['name' => 'features', 'in' => 'query', 'description' => 'Comma-separated: paragraph,list,code,table,blockquote,toc'],
            ],
            'response_type' => 'text/markdown',
        ],
        'video' => [
            'summary' => 'Generate placeholder MP4 video',
            'params' => [
                ['name' => 'w', 'in' => 'query', 'description' => 'Width (default 640)', 'example' => '640'],
                ['name' => 'h', 'in' => 'query', 'description' => 'Height (default 480)', 'example' => '480'],
                ['name' => 'duration', 'in' => 'query', 'description' => 'Seconds (1-30)', 'example' => '5'],
                ['name' => 'bg', 'in' => 'query', 'description' => 'Background hex', 'example' => '6366f1'],
            ],
            'response_type' => 'video/mp4',
        ],
        'holdicon' => [
            'summary' => 'Generate placeholder icon',
            'params' => [
                ['name' => 'type', 'in' => 'query', 'description' => 'robot, cat, dog, or identicon'],
                ['name' => 'size', 'in' => 'query', 'description' => 'Size in pixels'],
                ['name' => 'bg', 'in' => 'query', 'description' => 'Background hex'],
            ],
            'response_type' => 'image/png',
        ],
        'base64' => [
            'summary' => 'Encode or decode Base64 strings',
            'params' => [
                ['name' => 'encode', 'in' => 'query', 'description' => 'String to encode to Base64'],
                ['name' => 'decode', 'in' => 'query', 'description' => 'Base64 string to decode'],
            ],
            'response_type' => 'application/json',
        ],
        'hash' => [
            'summary' => 'Generate hash digests',
            'params' => [
                ['name' => 'data', 'in' => 'query', 'description' => 'Input string to hash (required)', 'example' => 'hello'],
                ['name' => 'algo', 'in' => 'query', 'description' => 'Hash algorithm (default: sha256)', 'example' => 'sha256'],
                ['name' => 'all', 'in' => 'query', 'description' => 'Return all algorithms (true/false)'],
            ],
            'response_type' => 'application/json',
        ],
        'uuid' => [
            'summary' => 'Generate UUIDs',
            'params' => [
                ['name' => 'count', 'in' => 'query', 'description' => 'Number of UUIDs (1-100)', 'example' => '5'],
                ['name' => 'version', 'in' => 'query', 'description' => 'UUID version: 4 or 7', 'example' => '4'],
                ['name' => 'uppercase', 'in' => 'query', 'description' => 'Uppercase output (true/false)'],
                ['name' => 'nodashes', 'in' => 'query', 'description' => 'Remove dashes (true/false)'],
            ],
            'response_type' => 'application/json',
        ],
        'color.convert' => [
            'summary' => 'Convert hex color to RGB, HSL, HSV with contrast analysis',
            'params' => [
                ['name' => 'hex', 'in' => 'path', 'description' => '3 or 6 character hex color (without #)', 'example' => 'ff5733'],
            ],
            'response_type' => 'application/json',
        ],
    ];

    public function handle(): int
    {
        $routes = Route::getRoutes();
        $paths = [];

        foreach ($routes as $route) {
            $name = $route->getName();
            if (! $name || ! isset(self::API_ROUTES[$name])) {
                continue;
            }
            if (! in_array('GET', $route->methods())) {
                continue;
            }

            $meta = self::API_ROUTES[$name];
            $uri = '/' . ltrim($route->uri(), '/');
            $parameters = [];

            foreach ($meta['params'] as $p) {
                $param = [
                    'name' => $p['name'],
                    'in' => $p['in'],
                    'description' => $p['description'],
                    'required' => $p['in'] === 'path',
                    'schema' => ['type' => 'string'],
                ];
                if (isset($p['example'])) {
                    $param['example'] = $p['example'];
                }
                $parameters[] = $param;
            }

            $paths[$uri] = [
                'get' => [
                    'summary' => $meta['summary'],
                    'operationId' => $name,
                    'tags' => [$this->tagForRoute($name)],
                    'parameters' => $parameters,
                    'responses' => [
                        '200' => [
                            'description' => 'Successful response',
                            'content' => [
                                $meta['response_type'] => [
                                    'schema' => $this->schemaForType($meta['response_type']),
                                ],
                            ],
                        ],
                        '429' => ['description' => 'Rate limit exceeded'],
                    ],
                ],
            ];
        }

        ksort($paths);

        $spec = [
            'openapi' => '3.0.3',
            'info' => [
                'title' => 'placehold.cloud API',
                'description' => 'Free placeholder content API — images, text, data, documents, and more.',
                'version' => $this->getVersion(),
                'contact' => ['url' => 'https://placehold.cloud/contact'],
            ],
            'servers' => [
                ['url' => 'https://placehold.cloud', 'description' => 'Production'],
            ],
            'tags' => [
                ['name' => 'Images', 'description' => 'Image and visual generators'],
                ['name' => 'Data', 'description' => 'Structured data and text APIs'],
                ['name' => 'Documents', 'description' => 'PDF, CSV, Markdown generators'],
                ['name' => 'Utilities', 'description' => 'Encoding, hashing, UUID, and color tools'],
                ['name' => 'Fun', 'description' => 'Quotes, jokes, recipes, weather'],
            ],
            'paths' => $paths,
        ];

        $output = $this->option('output');
        $json = json_encode($spec, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        file_put_contents(base_path($output), $json);

        $this->info("OpenAPI spec written to {$output} (" . count($paths) . " endpoints)");

        return self::SUCCESS;
    }

    private function tagForRoute(string $name): string
    {
        return match (true) {
            str_starts_with($name, 'placeholder'), str_starts_with($name, 'avatar'),
            $name === 'qr', $name === 'favicon', $name === 'holdicon' => 'Images',
            str_starts_with($name, 'json.'), $name === 'colors', $name === 'csv', $name === 'markdown' => 'Data',
            $name === 'pdf', $name === 'video' => 'Documents',
            in_array($name, ['base64', 'hash', 'uuid', 'color.convert']) => 'Utilities',
            default => 'Fun',
        };
    }

    private function schemaForType(string $type): array
    {
        return match ($type) {
            'application/json' => ['type' => 'object'],
            default => ['type' => 'string', 'format' => 'binary'],
        };
    }

    private function getVersion(): string
    {
        $path = storage_path('app/changelog.json');
        if (file_exists($path)) {
            $entries = json_decode(file_get_contents($path), true) ?? [];
            return ! empty($entries) ? $entries[0]['version'] : '1.0.0';
        }
        return '1.0.0';
    }
}
