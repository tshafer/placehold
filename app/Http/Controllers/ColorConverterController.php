<?php

namespace App\Http\Controllers;

class ColorConverterController extends Controller
{
    private const NAMED_COLORS = [
        'ff0000' => 'Red', 'ff4500' => 'OrangeRed', 'ff6347' => 'Tomato',
        'ff7f50' => 'Coral', 'ffa500' => 'Orange', 'ffd700' => 'Gold',
        'ffff00' => 'Yellow', 'adff2f' => 'GreenYellow', '7fff00' => 'Chartreuse',
        '00ff00' => 'Lime', '00fa9a' => 'MediumSpringGreen', '00ffff' => 'Cyan',
        '00bfff' => 'DeepSkyBlue', '1e90ff' => 'DodgerBlue', '0000ff' => 'Blue',
        '8a2be2' => 'BlueViolet', 'ff00ff' => 'Magenta', 'ff1493' => 'DeepPink',
        'ffffff' => 'White', '000000' => 'Black', '808080' => 'Gray',
        'c0c0c0' => 'Silver', 'a52a2a' => 'Brown', '800000' => 'Maroon',
        '800080' => 'Purple', '008000' => 'Green', '000080' => 'Navy',
        '008080' => 'Teal', 'f0f8ff' => 'AliceBlue', 'faebd7' => 'AntiqueWhite',
        'f5f5dc' => 'Beige', 'ffe4c4' => 'Bisque', 'deb887' => 'BurlyWood',
        '5f9ea0' => 'CadetBlue', '7b68ee' => 'MediumSlateBlue',
        '6366f1' => 'Indigo-500', 'dc2626' => 'Red-600', '059669' => 'Emerald-600',
        'd97706' => 'Amber-600', '7c3aed' => 'Violet-600', '0891b2' => 'Cyan-600',
    ];

    public function __invoke(string $hex)
    {
        $hex = ltrim(strtolower($hex), '#');

        if (strlen($hex) === 3) {
            $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
        }

        if (! preg_match('/^[0-9a-f]{6}$/', $hex)) {
            return response()->json([
                'error' => 'Invalid hex color. Use 3 or 6 character hex (e.g. ff5733 or f00)',
            ], 422);
        }

        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));

        [$h, $s, $l] = $this->rgbToHsl($r, $g, $b);
        [$hue, $sat, $val] = $this->rgbToHsv($r, $g, $b);
        $name = $this->closestName($hex, $r, $g, $b);
        $luminance = $this->relativeLuminance($r, $g, $b);
        $contrastOnWhite = $this->contrastRatio($luminance, 1.0);
        $contrastOnBlack = $this->contrastRatio($luminance, 0.0);

        return response()->json([
            'hex' => "#{$hex}",
            'rgb' => ['r' => $r, 'g' => $g, 'b' => $b],
            'rgb_css' => "rgb({$r}, {$g}, {$b})",
            'hsl' => ['h' => $h, 's' => $s, 'l' => $l],
            'hsl_css' => "hsl({$h}, {$s}%, {$l}%)",
            'hsv' => ['h' => $hue, 's' => $sat, 'v' => $val],
            'name' => $name,
            'luminance' => round($luminance, 4),
            'contrast' => [
                'on_white' => round($contrastOnWhite, 2),
                'on_black' => round($contrastOnBlack, 2),
                'best_text' => $contrastOnWhite > $contrastOnBlack ? '#000000' : '#ffffff',
            ],
            'is_light' => $l > 50,
            'complement' => '#' . str_pad(dechex((~hexdec($hex)) & 0xFFFFFF), 6, '0', STR_PAD_LEFT),
        ])->header('Cache-Control', 'public, max-age=31536000');
    }

    private function rgbToHsl(int $r, int $g, int $b): array
    {
        $r /= 255; $g /= 255; $b /= 255;
        $max = max($r, $g, $b);
        $min = min($r, $g, $b);
        $l = ($max + $min) / 2;

        if ($max === $min) {
            return [0, 0, (int) round($l * 100)];
        }

        $d = $max - $min;
        $s = $l > 0.5 ? $d / (2 - $max - $min) : $d / ($max + $min);

        $h = match ($max) {
            $r => (($g - $b) / $d + ($g < $b ? 6 : 0)) / 6,
            $g => (($b - $r) / $d + 2) / 6,
            default => (($r - $g) / $d + 4) / 6,
        };

        return [(int) round($h * 360), (int) round($s * 100), (int) round($l * 100)];
    }

    private function rgbToHsv(int $r, int $g, int $b): array
    {
        $r /= 255; $g /= 255; $b /= 255;
        $max = max($r, $g, $b);
        $min = min($r, $g, $b);
        $d = $max - $min;

        $v = $max;
        $s = $max === 0 ? 0 : $d / $max;

        if ($max === $min) {
            $h = 0;
        } else {
            $h = match ($max) {
                $r => (($g - $b) / $d + ($g < $b ? 6 : 0)) / 6,
                $g => (($b - $r) / $d + 2) / 6,
                default => (($r - $g) / $d + 4) / 6,
            };
        }

        return [(int) round($h * 360), (int) round($s * 100), (int) round($v * 100)];
    }

    private function relativeLuminance(int $r, int $g, int $b): float
    {
        $srgb = array_map(function ($c) {
            $c /= 255;
            return $c <= 0.03928 ? $c / 12.92 : pow(($c + 0.055) / 1.055, 2.4);
        }, [$r, $g, $b]);

        return 0.2126 * $srgb[0] + 0.7152 * $srgb[1] + 0.0722 * $srgb[2];
    }

    private function contrastRatio(float $l1, float $l2): float
    {
        $lighter = max($l1, $l2);
        $darker = min($l1, $l2);

        return ($lighter + 0.05) / ($darker + 0.05);
    }

    private function closestName(string $hex, int $r, int $g, int $b): ?string
    {
        if (isset(self::NAMED_COLORS[$hex])) {
            return self::NAMED_COLORS[$hex];
        }

        $closest = null;
        $minDist = PHP_INT_MAX;

        foreach (self::NAMED_COLORS as $namedHex => $name) {
            $nr = hexdec(substr($namedHex, 0, 2));
            $ng = hexdec(substr($namedHex, 2, 2));
            $nb = hexdec(substr($namedHex, 4, 2));

            $dist = ($r - $nr) ** 2 + ($g - $ng) ** 2 + ($b - $nb) ** 2;

            if ($dist < $minDist) {
                $minDist = $dist;
                $closest = $name;
            }
        }

        return $minDist < 2500 ? "~{$closest}" : null;
    }
}
