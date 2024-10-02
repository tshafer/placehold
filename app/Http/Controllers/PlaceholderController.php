<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PlaceholderController extends Controller
{
    public function __invoke(
        Request $request,
        $size = '100x100',
        $background_color = 'C8C8C8',
        $text_color = '323232',
    ) {
        $dimensions = $this->parseSizeParameter($size);
        $width = $dimensions['width'];
        $height = $dimensions['height'];

        $this->validateInput($request, $width, $height, $background_color);

        $params = $this->extractParams($request, $width, $height, $background_color, $text_color);

        $cacheKey = $this->generateCacheKey($request, $params);

        if (in_array($params, [
            'aiCat',
            'aiRobot',
            'aiDog',
        ])) {
            return $this->generateImage($params);
        } else {
            return Cache::rememberForever($cacheKey, function () use ($params) {
                return $this->generateImage($params);
            });
        }
    }

    private function parseSizeParameter($size)
    {
        $dimensions = explode('x', $size);

        if (count($dimensions) === 1) {
            $width = $height = (int) $dimensions[0];
        } elseif (count($dimensions) === 2) {
            $width = (int) $dimensions[0];
            $height = (int) $dimensions[1];
        } else {
            throw new \InvalidArgumentException('Invalid size parameter');
        }

        return ['width' => max(1, $width), 'height' => max(1, $height)];
    }

    private function validateInput(Request $request, $width, $height, $background_color)
    {
        $validator = Validator::make(array_merge($request->all(), [
            'width' => $width,
            'height' => $height,
            'background_color' => $background_color,
        ]), [
            'width' => ['required', 'integer', 'min:1', 'max:2000'],
            'height' => ['required', 'integer', 'min:1', 'max:2000'],
            'text' => ['nullable', 'string', 'max:100', 'regex:/^[\w\s\-.,!?]*$/'],
            'background_color' => ['nullable', 'regex:/^[0-9A-Fa-f]{6}$/'],
            'text_color' => ['nullable', 'regex:/^[0-9A-Fa-f]{6}$/'],
            'border_color' => ['nullable', 'regex:/^[0-9A-Fa-f]{6}$/'],
            'format' => ['nullable', Rule::in(['png', 'jpg', 'gif', 'webp', 'svg'])],
            'quality' => ['nullable', 'integer', 'min:0', 'max:100'],
            'font' => ['nullable', 'string', Rule::in(['arial', 'couri', 'times', 'tron'])],
            'text_size' => ['nullable', 'integer', 'min:1', 'max:500'],
            'watermark' => ['nullable', 'string', 'max:100', 'regex:/^[\w\s\-.,!?]*$/'],
            'watermark_size' => ['nullable', 'integer', 'min:1', 'max:100'],
            'watermark_opacity' => ['nullable', 'integer', 'min:0', 'max:100'],
            'blur' => ['nullable', 'integer', 'min:0', 'max:100'],
            'grayscale' => ['nullable', 'boolean'],
            'invert' => ['nullable', 'boolean'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    }

    private function extractParams(Request $request, $width, $height, $background_color, $text_color)
    {
        return [
            'width' => $width,
            'height' => $height,
            'text' => $request->query('text', 'Placeholder'),
            'backgroundColor' => $this->hexToRgb($background_color),
            'textColorArray' => $this->hexToRgb($text_color),
            'borderColor' => $this->hexToRgb($request->query('border_color', '969696')),
            'format' => $request->query('format', 'png'),
            'quality' => $request->query('quality', 90),
            'font' => $request->query('font', 'arial'),
            'textSize' => $request->query('text_size'),
            'watermark' => $request->query('watermark', 'placehold.cloud'),
            'watermarkSize' => $request->query('watermark_size', 10),
            'watermarkOpacity' => $request->query('watermark_opacity', 10),
            'blur' => $request->query('blur', 0),
            'grayscale' => $request->query('grayscale', false),
            'invert' => $request->query('invert', false),
            'aiCat' => $request->query('ai_cat', false),
            'aiRobot' => $request->query('ai_robot', false),
            'aiDog' => $request->query('ai_dog', false),
        ];
    }

    private function generateCacheKey(Request $request, $params)
    {
        return hash('sha256', json_encode(array_merge($request->all(), $params)));
    }

    private function generateImage($params)
    {
        if ($params['aiCat']) {
            return $this->fetchAIImage('https://api.thecatapi.com/v1/images/search', 'cat');
        }

        if ($params['aiRobot']) {
            return $this->fetchAIImage('https://robohash.org/'.uniqid(), 'robot');
        }

        if ($params['aiDog']) {
            return $this->fetchAIImage('https://dog.ceo/api/breeds/image/random', 'dog');
        }

        if ($params['format'] === 'svg') {
            $imageContent = $this->generateSvg($params);
            $contentType = 'image/svg+xml';
        } else {
            $imageContent = $this->generateRasterImage($params);
            $contentType = $this->getContentType($params['format']);
        }

        return new Response($imageContent, 200, [
            'Content-Type' => $contentType,
            'Content-Length' => strlen(isset($imageContent) ? $imageContent : 0),
            'Cache-Control' => 'public, max-age=604800',
            'X-Content-Type-Options' => 'nosniff',
            'X-Frame-Options' => 'DENY',
            'X-XSS-Protection' => '1; mode=block',
        ]);
    }

    private function fetchAIImage($url, $type)
    {
        $response = Http::get($url);
        if ($response->successful()) {
            $content = $type === 'robot' ? $response->body() : file_get_contents($response->json()[0]['url'] ?? $response->json()['message']);
            $contentType = $type === 'robot' ? 'image/png' : 'image/jpeg';

            return new Response($content, 200, [
                'Content-Type' => $contentType,
                'Content-Length' => strlen($content),
                'Cache-Control' => 'public, max-age=604800',
                'X-Content-Type-Options' => 'nosniff',
                'X-Frame-Options' => 'DENY',
                'X-XSS-Protection' => '1; mode=block',
            ]);
        } else {
            throw new \RuntimeException("Failed to fetch AI $type image");
        }
    }

    private function hexToRgb($hex)
    {
        $hex = ltrim($hex, '#');

        return [
            hexdec(substr($hex, 0, 2)),
            hexdec(substr($hex, 2, 2)),
            hexdec(substr($hex, 4, 2)),
        ];
    }

    private function generateRasterImage($params)
    {
        // Implementation remains the same
    }

    private function generateSvg($params)
    {
        // Implementation remains the same
    }

    private function getContentType($format)
    {
        // Implementation remains the same
    }
}
