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
        // Parse size parameter
        $dimensions = explode('x', $size);

        if (count($dimensions) === 1) {
            $width = $height = (int) $dimensions[0];
        } elseif (count($dimensions) === 2) {
            $width = (int) $dimensions[0];
            $height = (int) $dimensions[1];
        } else {
            throw new \InvalidArgumentException('Invalid size parameter');
        }

        // Validate input
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

        // Ensure width and height are at least 1
        $width = max(1, $width);
        $height = max(1, $height);

        $text = $request->query('text', 'Placeholder');
        $backgroundColor = $this->hexToRgb($background_color);
        $textColorArray = $this->hexToRgb($text_color);

        $borderColor = $this->hexToRgb($request->query('border_color', '969696'));
        $format = $request->query('format', 'png');
        $quality = $request->query('quality', 90);
        $font = $request->query('font', 'arial');
        $textSize = $request->query('text_size', null);
        $watermark = $request->query('watermark', 'placehold.cloud');
        $watermarkSize = $request->query('watermark_size', 10);
        $watermarkOpacity = $request->query('watermark_opacity', 10);
        $blur = $request->query('blur', 0);
        $grayscale = $request->query('grayscale', false);
        $invert = $request->query('invert', false);
        $aiCat = $request->query('ai_cat', false);
        $aiRobot = $request->query('ai_robot', false);
        $aiDog = $request->query('ai_dog', false);

        // Generate a unique cache key based on the request parameters
        $cacheKey = hash('sha256', json_encode(array_merge($request->all(), [
            'size' => $size,
            'format' => $format,
            'background_color' => $background_color,
            'text_color' => $text_color,
            'border_color' => $request->query('border_color', '969696'),
            'quality' => $quality,
            'font' => $font,
            'text_size' => $textSize,
            'watermark' => $watermark,
            'watermark_size' => $watermarkSize,
            'watermark_opacity' => $watermarkOpacity,
            'blur' => $blur,
            'grayscale' => $grayscale,
            'invert' => $invert,
            'aiCat' => $aiCat,
            'aiDog' => $aiDog,
        ])));

        // Try to retrieve the image from cache
        $cachedImage = Cache::remember($cacheKey, 0, function () use (
            $format,
            $width,
            $height,
            $text,
            $backgroundColor,
            $textColorArray,
            $borderColor,
            $quality,
            $font,
            $textSize,
            $watermark,
            $watermarkSize,
            $watermarkOpacity,
            $blur,
            $grayscale,
            $invert,
            $aiCat,
            $aiRobot,
            $aiDog) {
            if ($aiCat) {
                $response = Http::get('https://api.thecatapi.com/v1/images/search');
                if ($response->successful()) {
                    $catImageUrl = $response->json()[0]['url'];
                    $catImageContent = file_get_contents($catImageUrl);
                    $contentType = 'image/jpeg'; // Assuming the cat image is in JPEG format

                    return [
                        'content' => $catImageContent,
                        'contentType' => $contentType,
                    ];
                } else {
                    throw new \RuntimeException('Failed to fetch AI cat image');
                }
            }
            if ($aiDog) {
                $response = Http::get('https://api.thedogapi.com/v1/images/search');
                if ($response->successful()) {
                    $dogImageUrl = $response->json()[0]['url'];
                    $dogImageContent = file_get_contents($dogImageUrl);
                    $contentType = 'image/jpeg'; // Assuming the dog image is in JPEG format

                    return [
                        'content' => $dogImageContent,
                        'contentType' => $contentType,
                    ];
                } else {
                    throw new \RuntimeException('Failed to fetch AI dog image');
                }
            }
            if ($aiRobot) {
                $response = Http::get('https://robohash.org/'.uniqid());
                if ($response->successful()) {
                    $robotImageContent = $response->body();

                    return [
                        'content' => $robotImageContent,
                        'contentType' => 'image/png',
                    ];
                } else {
                    throw new \RuntimeException('Failed to fetch AI robot image');
                }
            }
            if ($format === 'svg') {
                $imageContent = $this->generateSvg($width, $height, $text, $backgroundColor, $textColorArray, $borderColor, $textSize, $watermark, $watermarkSize, $watermarkOpacity);
                $contentType = 'image/svg+xml';
            } else {
                $imageContent = $this->generateRasterImage($width, $height, $text, $backgroundColor, $textColorArray, $borderColor, $format, $quality, $font, $textSize, $watermark, $watermarkSize, $watermarkOpacity, $blur, $grayscale, $invert);
                $contentType = $this->getContentType($format);
            }

            return [
                'content' => $imageContent,
                'contentType' => $contentType,
            ];
        });

        // Return as an image response
        return new Response($cachedImage['content'], 200, [
            'Content-Type' => $cachedImage['contentType'],
            'Content-Length' => strlen($cachedImage['content']),
            'Cache-Control' => 'public, max-age=604800', // Cache for one week
            'X-Content-Type-Options' => 'nosniff',
            'X-Frame-Options' => 'DENY',
            'X-XSS-Protection' => '1; mode=block',
        ]);
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

    private function generateRasterImage($width, $height, $text, $backgroundColor, $textColorArray, $borderColor, $format, $quality, $font, $textSize, $watermark, $watermarkSize, $watermarkOpacity, $blur, $grayscale, $invert)
    {
        // Create image
        $image = imagecreatetruecolor($width, $height);

        // Set background color
        $bgColor = imagecolorallocate($image, $backgroundColor[0], $backgroundColor[1], $backgroundColor[2]);
        imagefill($image, 0, 0, $bgColor);

        // Set text color
        $textColor = imagecolorallocate($image, $textColorArray[0], $textColorArray[1], $textColorArray[2]);

        // Calculate font size (adjust as needed)
        $fontSize = $textSize ?? min($width, $height) / 10;

        // Get text dimensions
        $fontPath = resource_path("fonts/{$font}.ttf");
        if (! file_exists($fontPath)) {
            throw new \RuntimeException('Font file not found');
        }
        $textBox = imagettfbbox(size: $fontSize, angle: 0, font_filename: $fontPath, string: $text);

        // Calculate text position
        $textWidth = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX = ($width - $textWidth) / 2;
        $textY = ($height + $textHeight) / 2;

        // Add text to image
        imagettftext(
            image: $image,
            size: $fontSize,
            angle: 0,
            x: $textX,
            y: $textY,
            color: $textColor,
            font_filename: $fontPath,
            text: $text
        );

        // Add border
        $borderColorAllocated = imagecolorallocate($image, $borderColor[0], $borderColor[1], $borderColor[2]);
        imagerectangle($image, 0, 0, $width - 1, $height - 1, $borderColorAllocated);

        // Add dimensions text
        $dimensionsText = "{$width}x{$height}";
        $dimensionsFontSize = $fontSize * 0.5;
        $dimensionsBox = imagettfbbox(size: $dimensionsFontSize, angle: 0, font_filename: $fontPath, string: $dimensionsText);
        $dimensionsWidth = abs($dimensionsBox[4] - $dimensionsBox[0]);
        $dimensionsHeight = abs($dimensionsBox[5] - $dimensionsBox[1]);
        $dimensionsX = $width - $dimensionsWidth - 10;
        $dimensionsY = $height - 10;

        imagettftext(
            image: $image,
            size: $dimensionsFontSize,
            angle: 0,
            x: $dimensionsX,
            y: $dimensionsY,
            color: $textColor,
            font_filename: $fontPath,
            text: $dimensionsText
        );

        // Add watermark
        if (! empty($watermark)) {
            $watermarkFontSize = $watermarkSize;
            $watermarkBox = imagettfbbox(size: $watermarkFontSize, angle: 0, font_filename: $fontPath, string: $watermark);
            $watermarkWidth = abs($watermarkBox[4] - $watermarkBox[0]);
            $watermarkHeight = abs($watermarkBox[5] - $watermarkBox[1]);
            $watermarkX = 10;
            $watermarkY = $height - 10;

            $watermarkColor = imagecolorallocatealpha(
                $image,
                $textColorArray[0],
                $textColorArray[1],
                $textColorArray[2],
                127 - ($watermarkOpacity * 1.27)
            );

            imagettftext(
                image: $image,
                size: $watermarkFontSize,
                angle: 0,
                x: $watermarkX,
                y: $watermarkY,
                color: $watermarkColor,
                font_filename: $fontPath,
                text: $watermark
            );
        }

        // Apply blur effect
        if ($blur > 0) {
            for ($i = 0; $i < $blur; $i++) {
                imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR);
            }
        }

        // Apply grayscale effect
        if ($grayscale) {
            imagefilter($image, IMG_FILTER_GRAYSCALE);
        }

        // Apply invert effect
        if ($invert) {
            imagefilter($image, IMG_FILTER_NEGATE);
        }

        // Capture the image output
        ob_start();
        switch ($format) {
            case 'jpg':
                imagejpeg($image, null, $quality);
                break;
            case 'gif':
                imagegif($image);
                break;
            case 'webp':
                imagewebp($image, null, $quality);
                break;
            default:
                imagepng($image, null, 9 - round($quality / 10));
        }
        $imageContent = ob_get_clean();

        // Clean up
        imagedestroy($image);

        return $imageContent;
    }

    private function generateSvg($width, $height, $text, $backgroundColor, $textColor, $borderColor, $textSize = null, $watermark = '', $watermarkSize = 20, $watermarkOpacity = 50)
    {
        $bgColor = sprintf('#%02x%02x%02x', $backgroundColor[0], $backgroundColor[1], $backgroundColor[2]);
        $txtColor = sprintf('#%02x%02x%02x', $textColor[0], $textColor[1], $textColor[2]);
        $brdColor = sprintf('#%02x%02x%02x', $borderColor[0], $borderColor[1], $borderColor[2]);

        $fontSize = $textSize ?? min($width, $height) / 5;

        $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
        $watermark = htmlspecialchars($watermark, ENT_QUOTES, 'UTF-8');

        $svg = <<<SVG
        <svg width="{$width}" height="{$height}" xmlns="http://www.w3.org/2000/svg">
            <rect width="100%" height="100%" fill="{$bgColor}" />
            <rect width="calc(100% - 2px)" height="calc(100% - 2px)" x="1" y="1" fill="none" stroke="{$brdColor}" stroke-width="2" />
            <text x="50%" y="50%" font-family="Arial, sans-serif" font-size="{$fontSize}" fill="{$txtColor}" text-anchor="middle" dominant-baseline="middle">{$text}</text>
            <text x="calc(100% - 10px)" y="calc(100% - 10px)" font-family="Arial, sans-serif" font-size="12" fill="{$txtColor}" text-anchor="end" dominant-baseline="baseline">{$width}x{$height}</text>
        SVG;

        if (! empty($watermark)) {
            $watermarkColor = sprintf('rgba(%d,%d,%d,%f)', $textColor[0], $textColor[1], $textColor[2], $watermarkOpacity / 100);
            $svg .= <<<SVG
            <text x="10" y="calc(100% - 10px)" font-family="Arial, sans-serif" font-size="{$watermarkSize}" fill="{$watermarkColor}" text-anchor="start" dominant-baseline="baseline">{$watermark}</text>
            SVG;
        }

        $svg .= '</svg>';

        return $svg;
    }

    private function getContentType($format)
    {
        switch ($format) {
            case 'jpg':
                return 'image/jpeg';
            case 'gif':
                return 'image/gif';
            case 'webp':
                return 'image/webp';
            default:
                return 'image/png';
        }
    }
}
