<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class DrawText
{
    public function drawText($image, $text, $size, $txt, $bg, $options = [])
    {
        // Ensure there's always some text to display
        $text = ! empty($text) ? $text : 'Hello World';

        // Generate a unique cache key based on input parameters
        $cacheKey = md5(json_encode([$text, $size, $txt, $bg, $options]));

        // Try to retrieve the image parameters from cache
        if (Cache::has($cacheKey)) {
            $cachedParams = Cache::get($cacheKey);
            $this->applyImageParams($image, $cachedParams);

            return $image;
        }

        $font = $options['font'] ?? resource_path('fonts/arial.ttf');
        $fontSize = $options['fontSize'] ?? $size * 0.5;
        $angle = $options['angle'] ?? 0;
        $alignment = $options['alignment'] ?? 'center';
        $padding = $options['padding'] ?? 0;
        $seed = $options['seed'] ?? null;

        // Use seed to generate consistent random choices
        $random = $seed ? (new \Random\Randomizer(new \Random\Engine\Mt19937(crc32($seed)))) : new \Random\Randomizer;

        // Get text dimensions
        $textBox = imagettfbbox($fontSize, $angle, $font, $text);
        $textWidth = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);

        // Calculate position based on alignment
        switch ($alignment) {
            case 'left':
                $x = $padding;
                break;
            case 'right':
                $x = $size - $textWidth - $padding;
                break;
            case 'center':
            default:
                $x = ($size - $textWidth) / 2;
                break;
        }

        $y = ($size + $textHeight) / 2;

        // Store drawing instructions instead of directly modifying the image
        $drawingInstructions = [];

        // Add gradient background if specified
        if ($random->getInt(0, 1)) {
            $startColor = [$random->getInt(0, 255), $random->getInt(0, 255), $random->getInt(0, 255)];
            $endColor = [$random->getInt(0, 255), $random->getInt(0, 255), $random->getInt(0, 255)];
            for ($i = 0; $i < $size; $i++) {
                $color = $this->interpolateColor($startColor, $endColor, $i / $size);
                $drawingInstructions[] = ['type' => 'line', 'x1' => 0, 'y1' => $i, 'x2' => $size, 'y2' => $i, 'color' => $color];
            }
        }

        // Apply shadow if specified
        if (isset($options['shadow'])) {
            $shadowColor = $options['shadow']['color'] ?? $bg;
            $shadowOffsetX = $options['shadow']['offsetX'] ?? 2;
            $shadowOffsetY = $options['shadow']['offsetY'] ?? 2;
            $drawingInstructions[] = ['type' => 'text', 'fontSize' => $fontSize, 'angle' => $angle, 'x' => $x + $shadowOffsetX, 'y' => $y + $shadowOffsetY, 'color' => $shadowColor, 'font' => $font, 'text' => $text];
        }

        // Draw the main text
        $drawingInstructions[] = ['type' => 'text', 'fontSize' => $fontSize, 'angle' => $angle, 'x' => $x, 'y' => $y, 'color' => $txt, 'font' => $font, 'text' => $text];

        // Apply outline if specified
        if (isset($options['outline'])) {
            $outlineColor = $options['outline']['color'] ?? $bg;
            $outlineWidth = $options['outline']['width'] ?? 1;
            for ($i = 0; $i < 360; $i += 45) {
                $radians = $i * M_PI / 180;
                $ox = $x + $outlineWidth * cos($radians);
                $oy = $y + $outlineWidth * sin($radians);
                $drawingInstructions[] = ['type' => 'text', 'fontSize' => $fontSize, 'angle' => $angle, 'x' => $ox, 'y' => $oy, 'color' => $outlineColor, 'font' => $font, 'text' => $text];
            }
            $drawingInstructions[] = ['type' => 'text', 'fontSize' => $fontSize, 'angle' => $angle, 'x' => $x, 'y' => $y, 'color' => $txt, 'font' => $font, 'text' => $text];
        }

        // Add random features
        $this->addRandomFeatures($drawingInstructions, $size, $txt, $bg, $options, $random);

        // Cache the drawing instructions
        Cache::put($cacheKey, $drawingInstructions, now()->addMinutes(60));

        // Apply the drawing instructions to the image
        $this->applyImageParams($image, $drawingInstructions);

        return $image;
    }

    private function addRandomFeatures(&$drawingInstructions, $size, $txt, $bg, $options, $random)
    {
        // Add sparkles
        if ($random->getInt(0, 1)) {
            $sparkleCount = $random->getInt(3, 10);
            for ($i = 0; $i < $sparkleCount; $i++) {
                $sparkleX = $random->getInt(0, $size);
                $sparkleY = $random->getInt(0, $size);
                $sparkleSize = $random->getInt($size * 0.01, $size * 0.03);
                $drawingInstructions[] = ['type' => 'ellipse', 'x' => $sparkleX, 'y' => $sparkleY, 'width' => $sparkleSize, 'height' => $sparkleSize, 'color' => $txt];
            }
        }

        // Add wavy underline
        if ($random->getInt(0, 1)) {
            $waveAmplitude = $size * 0.02;
            $waveFrequency = $size * 0.1;
            $lineY = $size * 0.9;
            for ($x = 0; $x < $size; $x++) {
                $y = $lineY + sin($x / $waveFrequency) * $waveAmplitude;
                $drawingInstructions[] = ['type' => 'pixel', 'x' => $x, 'y' => $y, 'color' => $txt];
            }
        }

        // Add decorative border
        if ($random->getInt(0, 1)) {
            $borderWidth = $size * 0.02;
            $drawingInstructions[] = ['type' => 'rectangle', 'x1' => $borderWidth, 'y1' => $borderWidth, 'x2' => $size - $borderWidth, 'y2' => $size - $borderWidth, 'color' => $txt];
        }
    }

    private function interpolateColor($color1, $color2, $factor)
    {
        $r = $color1[0] + ($color2[0] - $color1[0]) * $factor;
        $g = $color1[1] + ($color2[1] - $color1[1]) * $factor;
        $b = $color1[2] + ($color2[2] - $color1[2]) * $factor;

        return [$r, $g, $b];
    }

    private function applyImageParams($image, $params)
    {
        foreach ($params as $instruction) {
            switch ($instruction['type']) {
                case 'text':
                    $color = is_array($instruction['color']) ? imagecolorallocate($image, ...$instruction['color']) : $instruction['color'];
                    imagettftext($image, $instruction['fontSize'], $instruction['angle'], $instruction['x'], $instruction['y'], $color, $instruction['font'], $instruction['text']);
                    break;
                case 'ellipse':
                    $color = is_array($instruction['color']) ? imagecolorallocate($image, ...$instruction['color']) : $instruction['color'];
                    imagefilledellipse($image, $instruction['x'], $instruction['y'], $instruction['width'], $instruction['height'], $color);
                    break;
                case 'pixel':
                    $color = is_array($instruction['color']) ? imagecolorallocate($image, ...$instruction['color']) : $instruction['color'];
                    imagesetpixel($image, $instruction['x'], $instruction['y'], $color);
                    break;
                case 'rectangle':
                    $color = is_array($instruction['color']) ? imagecolorallocate($image, ...$instruction['color']) : $instruction['color'];
                    imagerectangle($image, $instruction['x1'], $instruction['y1'], $instruction['x2'], $instruction['y2'], $color);
                    break;
                case 'line':
                    $color = is_array($instruction['color']) ? imagecolorallocate($image, ...$instruction['color']) : $instruction['color'];
                    imageline($image, $instruction['x1'], $instruction['y1'], $instruction['x2'], $instruction['y2'], $color);
                    break;
            }
        }
    }
}
