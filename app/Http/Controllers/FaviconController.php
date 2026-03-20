<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FaviconController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $format = strtolower((string) $request->query('format', 'svg'));
        if ($format !== 'svg') {
            abort(400, 'Only SVG format is supported.');
        }

        $text = mb_substr((string) $request->query('text', 'P'), 0, 2, 'UTF-8');
        if ($text === '') {
            $text = 'P';
        }

        $size = (int) $request->query('size', 64);
        $size = max(16, min(512, $size));

        $bg = $this->normalizeHex((string) $request->query('bg', '6366f1'), '6366f1');
        $fg = $this->normalizeHex((string) $request->query('fg', 'ffffff'), 'ffffff');

        $radius = (int) $request->query('radius', 12);
        $radius = max(0, min(50, $radius));

        $font = mb_substr((string) $request->query('font', 'sans-serif'), 0, 200);

        $rx = min($size * $radius / 100, $size / 2);

        $charCount = mb_strlen($text, 'UTF-8');
        $fontSize = $charCount <= 1 ? $size * 0.55 : $size * 0.35;

        $escapedText = htmlspecialchars($text, ENT_XML1 | ENT_QUOTES, 'UTF-8');
        $escapedFont = htmlspecialchars($font, ENT_XML1 | ENT_QUOTES, 'UTF-8');

        $svg = '<?xml version="1.0" encoding="UTF-8"?>'
            .'<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'" viewBox="0 0 '.$size.' '.$size.'">'
            .'<rect width="100%" height="100%" rx="'.$rx.'" ry="'.$rx.'" fill="#'.$bg.'"/>'
            .'<text x="50%" y="50%" dominant-baseline="central" text-anchor="middle" fill="#'.$fg.'" font-family="'.$escapedFont.'" font-size="'.$fontSize.'" font-weight="600">'.$escapedText.'</text>'
            .'</svg>';

        return response($svg, 200, [
            'Content-Type' => 'image/svg+xml',
            'Cache-Control' => 'public, max-age=31536000',
        ]);
    }

    private function normalizeHex(string $hex, string $fallback): string
    {
        $hex = strtolower(ltrim($hex, '#'));
        if (strlen($hex) === 3 && preg_match('/^[0-9a-f]{3}$/', $hex)) {
            $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
        }
        if (preg_match('/^[0-9a-f]{6}$/', $hex)) {
            return $hex;
        }

        return $fallback;
    }
}
