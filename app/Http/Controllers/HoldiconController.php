<?php

namespace App\Http\Controllers;

use App\Services\CatService;
use App\Services\DogService;
use App\Services\DrawText;
use App\Services\RobotService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;

class HoldiconController extends Controller
{
    public function __construct(
        public CatService $catService,
        public DogService $dogService,
        public RobotService $robotService,
        public DrawText $drawText
    ) {}

    public function __invoke(Request $request)
    {
        $seed = $request->input('seed', '');
        $width = $request->input('width', 128);
        $height = $request->input('height', $width);
        $backgroundColor = $request->input('background_color', $this->generateColor($seed));
        $textColor = $request->input('text_color', $this->getContrastColor($backgroundColor));
        $text = strtoupper($request->input('text', $this->generateText($seed)));
        $isRobot = $request->boolean('robot', false);
        $isCat = $request->boolean('cat', false);
        $isDog = $request->boolean('dog', false);
        $noCache = $request->boolean('no_cache', false);

        $cacheKey = "icon_{$seed}_{$width}_{$height}_{$backgroundColor}_{$textColor}_{$text}_{$isRobot}_{$isCat}_{$isDog}";

        if ($noCache) {
            Cache::forget($cacheKey);

            return $this->generateImage($width, $height, $backgroundColor, $textColor, $text, $isRobot, $isCat, $isDog, $seed);
        }

        return Cache::remember($cacheKey, now()->addDays(7), function () use ($width, $height, $backgroundColor, $textColor, $text, $isRobot, $isCat, $isDog, $seed) {
            return $this->generateImage($width, $height, $backgroundColor, $textColor, $text, $isRobot, $isCat, $isDog, $seed);
        });
    }

    private function generateImage($width, $height, $backgroundColor, $textColor, $text, $isRobot, $isCat, $isDog, $seed)
    {
        $image = imagecreatetruecolor($width, $height);
        $bgColor = $this->hexToRgb($backgroundColor);
        $txtColor = $this->hexToRgb($textColor);

        $bg = imagecolorallocate($image, $bgColor['r'], $bgColor['g'], $bgColor['b']);
        $txt = imagecolorallocate($image, $txtColor['r'], $txtColor['g'], $txtColor['b']);

        imagefill($image, 0, 0, $bg);

        $size = min($width, $height);
        if ($isRobot) {
            $this->robotService->drawRobot($image, $size, $txt, $bg, $seed);
        } elseif ($isCat) {
            $this->catService->drawCat($image, $size, $txt, $bg, $seed);
        } elseif ($isDog) {
            $this->dogService->drawDog($image, $size, $txt, $bg, $seed);
        } else {
            $this->drawText->drawText($image, $text, $size, $txt, $bg, [
                'font' => resource_path('fonts/arial.ttf'),
                'fontSize' => $size * 0.5,
                'angle' => 0,
                'alignment' => 'center',
                'padding' => 0,
            ]);
        }

        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();

        imagedestroy($image);

        return Response::make($imageData, 200, ['Content-Type' => 'image/png']);
    }

    private function generateText($seed, $length = 2)
    {
        if (! empty($seed)) {
            $hash = md5($seed);
            $text = strtoupper(substr($hash, 0, $length));
        } else {
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $text = '';
            for ($i = 0; $i < $length; $i++) {
                $text .= $characters[rand(0, strlen($characters) - 1)];
            }
        }

        return $text;
    }

    private function generateColor($seed)
    {
        if (! empty($seed)) {
            $hash = md5($seed);

            return '#'.substr($hash, 0, 6);
        } else {
            return '#'.str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
        }
    }

    private function getContrastColor($hexColor)
    {
        $r = hexdec(substr($hexColor, 1, 2));
        $g = hexdec(substr($hexColor, 3, 2));
        $b = hexdec(substr($hexColor, 5, 2));
        $yiq = (($r * 299) + ($g * 587) + ($b * 114)) / 1000;

        return ($yiq >= 128) ? '#000000' : '#FFFFFF';
    }

    private function hexToRgb($hex)
    {
        $hex = ltrim($hex, '#');

        return [
            'r' => hexdec(substr($hex, 0, 2)),
            'g' => hexdec(substr($hex, 2, 2)),
            'b' => hexdec(substr($hex, 4, 2)),
        ];
    }
}
