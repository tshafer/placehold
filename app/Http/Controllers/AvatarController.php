<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AvatarController extends Controller
{
    private const DEFAULT_SIZE = 200;

    private const MIN_SIZE = 16;

    private const MAX_SIZE = 1024;

    private const DEFAULT_BG = 'f0f0f0';

    public function __invoke(Request $request, string $seed): Response
    {
        $size = (int) $request->query('size', self::DEFAULT_SIZE);
        $size = min(max($size, self::MIN_SIZE), self::MAX_SIZE);

        $format = strtolower((string) $request->query('format', 'svg'));
        if ($format !== 'svg') {
            return response()->json([
                'status' => 'error',
                'message' => 'Only format=svg is supported.',
            ], 400);
        }

        $bg = $this->normalizeHexColor((string) $request->query('bg', self::DEFAULT_BG));
        if ($bg === null) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid bg. Use 3 or 6 hex digits, with or without #.',
            ], 400);
        }

        $svg = $this->buildIdenticonSvg($seed, $size, $bg);

        return response($svg, 200, [
            'Content-Type' => 'image/svg+xml; charset=UTF-8',
            'Cache-Control' => 'public, max-age=31536000',
        ]);
    }

    private function normalizeHexColor(string $value): ?string
    {
        $value = ltrim(trim($value), '#');
        if ($value === '') {
            return null;
        }

        if (preg_match('/^[0-9a-fA-F]{3}$/', $value)) {
            return strtolower(
                $value[0].$value[0].$value[1].$value[1].$value[2].$value[2]
            );
        }

        if (preg_match('/^[0-9a-fA-F]{6}$/', $value)) {
            return strtolower($value);
        }

        return null;
    }

    private function buildIdenticonSvg(string $seed, int $size, string $bgHex): string
    {
        $hash = md5($seed, false);
        $fgHex = substr($hash, 0, 6);

        $bits = hexdec(substr($hash, 6, 4)) & 0x7FFF;

        $cellSize = $size / 5;
        $rects = [];

        for ($row = 0; $row < 5; $row++) {
            for ($col = 0; $col < 5; $col++) {
                $sourceCol = $col <= 2 ? $col : 4 - $col;
                $bitIndex = $row * 3 + $sourceCol;
                $filled = (($bits >> $bitIndex) & 1) === 1;

                if (! $filled) {
                    continue;
                }

                $x = $col * $cellSize;
                $y = $row * $cellSize;
                $rects[] = sprintf(
                    '<rect x="%s" y="%s" width="%s" height="%s" fill="#%s"/>',
                    $this->svgNumber($x),
                    $this->svgNumber($y),
                    $this->svgNumber($cellSize),
                    $this->svgNumber($cellSize),
                    htmlspecialchars($fgHex, ENT_XML1 | ENT_QUOTES, 'UTF-8')
                );
            }
        }

        $bgSafe = htmlspecialchars($bgHex, ENT_XML1 | ENT_QUOTES, 'UTF-8');
        $sizeAttr = htmlspecialchars((string) $size, ENT_XML1 | ENT_QUOTES, 'UTF-8');

        $body = implode('', $rects);

        return '<?xml version="1.0" encoding="UTF-8"?>'
            .'<svg xmlns="http://www.w3.org/2000/svg" width="'.$sizeAttr.'" height="'.$sizeAttr.'" viewBox="0 0 '.$sizeAttr.' '.$sizeAttr.'">'
            .'<rect width="100%" height="100%" fill="#'.$bgSafe.'"/>'
            .$body
            .'</svg>';
    }

    private function svgNumber(float $value): string
    {
        $formatted = number_format($value, 4, '.', '');

        return rtrim(rtrim($formatted, '0'), '.') ?: '0';
    }
}
