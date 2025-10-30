<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ColorsController extends Controller
{
    private const DEFAULT_CACHE_TIME = 86400; // 24 hours in seconds

    public function __invoke(Request $request)
    {
        $type = $request->query('type', 'palette');
        $count = min(max((int) $request->query('count', 5), 1), 10); // Between 1 and 10

        $cacheKey = "colors_{$type}_{$count}_" . now()->format('Y-m-d');

        return Cache::remember($cacheKey, self::DEFAULT_CACHE_TIME, function () use ($type, $count) {
            return $this->generateColors($type, $count);
        });
    }

    private function generateColors(string $type, int $count)
    {
        switch ($type) {
            case 'palette':
                return $this->generateColorPalette($count);
            case 'hex':
                return $this->generateHexColors($count);
            case 'named':
                return $this->generateNamedColors($count);
            default:
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid type. Use: palette, hex, or named'
                ], 400);
        }
    }

    private function generateColorPalette(int $count)
    {
        $palettes = [
            [
                ['name' => 'Ocean Breeze', 'colors' => ['#2E86AB', '#A23B72', '#F18F01', '#C73E1D', '#E8E9EB']],
                ['name' => 'Sunset Vibes', 'colors' => ['#F94144', '#F3722C', '#F8961E', '#F9C74F', '#90BE6D']],
                ['name' => 'Forest Green', 'colors' => ['#264653', '#2A9D8F', '#E9C46A', '#F4A261', '#E76F51']],
                ['name' => 'Purple Dreams', 'colors' => ['#5C4B37', '#8CB369', '#F4E285', '#F4A259', '#5B8E7D']],
                ['name' => 'Blue Horizon', 'colors' => ['#006E90', '#F18F01', '#ADCAD6', '#99C24D', '#41BBD9']],
                ['name' => 'Vintage', 'colors' => ['#D4AF37', '#C19A6B', '#8B7355', '#6B4423', '#2C1810']],
                ['name' => 'Modern Tech', 'colors' => ['#2D3748', '#4A5568', '#718096', '#A0AEC0', '#EDF2F7']],
                ['name' => 'Rainbow', 'colors' => ['#FF0000', '#FF7F00', '#FFFF00', '#00FF00', '#0000FF']],
            ],
        ];

        shuffle($palettes[0]);
        $selectedPalettes = array_slice($palettes[0], 0, min($count, 8));

        return response()->json([
            'status' => 'success',
            'type' => 'palette',
            'count' => count($selectedPalettes),
            'data' => $selectedPalettes,
            'timestamp' => now()->toDateTimeString(),
        ]);
    }

    private function generateHexColors(int $count)
    {
        $colors = [];
        for ($i = 0; $i < $count; $i++) {
            $colors[] = '#' . str_pad(dechex(rand(0, 16777215)), 6, '0', STR_PAD_LEFT);
        }

        return response()->json([
            'status' => 'success',
            'type' => 'hex',
            'count' => count($colors),
            'data' => $colors,
            'timestamp' => now()->toDateTimeString(),
        ]);
    }

    private function generateNamedColors(int $count)
    {
        $namedColors = [
            ['name' => 'Crimson Red', 'hex' => '#DC143C', 'rgb' => [220, 20, 60], 'category' => 'red'],
            ['name' => 'Ocean Blue', 'hex' => '#006994', 'rgb' => [0, 105, 148], 'category' => 'blue'],
            ['name' => 'Emerald Green', 'hex' => '#50C878', 'rgb' => [80, 200, 120], 'category' => 'green'],
            ['name' => 'Golden Yellow', 'hex' => '#FFD700', 'rgb' => [255, 215, 0], 'category' => 'yellow'],
            ['name' => 'Royal Purple', 'hex' => '#7851A9', 'rgb' => [120, 81, 169], 'category' => 'purple'],
            ['name' => 'Tangerine Orange', 'hex' => '#F28500', 'rgb' => [242, 133, 0], 'category' => 'orange'],
            ['name' => 'Rose Pink', 'hex' => '#FF69B4', 'rgb' => [255, 105, 180], 'category' => 'pink'],
            ['name' => 'Charcoal Gray', 'hex' => '#36454F', 'rgb' => [54, 69, 79], 'category' => 'gray'],
            ['name' => 'Turquoise Cyan', 'hex' => '#40E0D0', 'rgb' => [64, 224, 208], 'category' => 'cyan'],
            ['name' => 'Lavender', 'hex' => '#E6E6FA', 'rgb' => [230, 230, 250], 'category' => 'purple'],
        ];

        shuffle($namedColors);
        $selectedColors = array_slice($namedColors, 0, min($count, 10));

        return response()->json([
            'status' => 'success',
            'type' => 'named',
            'count' => count($selectedColors),
            'data' => $selectedColors,
            'timestamp' => now()->toDateTimeString(),
        ]);
    }
}

