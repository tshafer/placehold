<?php

namespace App\Http\Controllers;

use chillerlan\QRCode\Common\EccLevel;
use chillerlan\QRCode\Common\Mode;
use chillerlan\QRCode\Output\QRGdImagePNG;
use chillerlan\QRCode\Output\QRMarkupSVG;
use chillerlan\QRCode\Output\QROutputInterface;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QrCodeController extends Controller
{
    public function __invoke(Request $request)
    {
        $validator = Validator::make([
            'data' => $request->query('data'),
            'size' => $request->query('size', 300),
            'format' => strtolower((string) $request->query('format', 'svg')),
            'fg' => $this->normalizeHex($request->query('fg', '000000')),
            'bg' => $this->normalizeHex($request->query('bg', 'ffffff')),
            'margin' => $request->query('margin', 2),
            'ecc' => strtoupper((string) $request->query('ecc', 'M')),
        ], [
            'data' => 'required|string|max:2048',
            'size' => 'integer|min:50|max:1024',
            'format' => 'in:svg,png',
            'fg' => ['required', 'regex:/^[0-9A-Fa-f]{6}$/'],
            'bg' => ['required', 'regex:/^[0-9A-Fa-f]{6}$/'],
            'margin' => 'integer|min:0|max:10',
            'ecc' => 'in:L,M,Q,H',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }

        /** @var array{data: string, size: int, format: string, fg: string, bg: string, margin: int, ecc: string} $validated */
        $validated = $validator->validated();

        $eccLevel = match ($validated['ecc']) {
            'L' => EccLevel::L,
            'M' => EccLevel::M,
            'Q' => EccLevel::Q,
            'H' => EccLevel::H,
            default => EccLevel::M,
        };

        if ($validated['format'] === 'png' && ! extension_loaded('gd')) {
            return response()->json([
                'status' => 'error',
                'message' => 'PNG output requires the GD extension.',
            ], 500);
        }

        if ($validated['format'] === 'svg') {
            $body = $this->renderSvg($validated['data'], $validated['size'], $validated['fg'], $validated['bg'], $validated['margin'], $eccLevel);

            return response($body, 200, [
                'Content-Type' => 'image/svg+xml',
                'Cache-Control' => 'public, max-age=86400',
            ]);
        }

        $body = $this->renderPng($validated['data'], $validated['size'], $validated['fg'], $validated['bg'], $validated['margin'], $eccLevel);

        return response($body, 200, [
            'Content-Type' => 'image/png',
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }

    private function renderSvg(string $data, int $size, string $fg, string $bg, int $margin, int $eccLevel): string
    {
        $options = new QROptions([
            'outputInterface' => QRMarkupSVG::class,
            'eccLevel' => $eccLevel,
            'quietzoneSize' => $margin,
            'outputBase64' => false,
            'svgAddXmlHeader' => true,
        ]);

        $this->applyModuleColors($options, $fg, $bg, 'svg');

        $qr = new QRCode($options);
        $this->addDataSegment($qr, $data);
        $matrix = $qr->getQRMatrix();
        $svg = $qr->renderMatrix($matrix);

        return preg_replace('/<svg\s/', '<svg width="'.$size.'" height="'.$size.'" ', $svg, 1) ?? $svg;
    }

    private function renderPng(string $data, int $size, string $fg, string $bg, int $margin, int $eccLevel): string
    {
        $options = new QROptions([
            'outputInterface' => QRGdImagePNG::class,
            'eccLevel' => $eccLevel,
            'quietzoneSize' => $margin,
            'outputBase64' => false,
            'scale' => 1,
        ]);

        $this->applyModuleColors($options, $fg, $bg, 'png');
        $options->bgColor = $this->hexToRgb($bg);

        $qr = new QRCode($options);
        $this->addDataSegment($qr, $data);
        $matrix = $qr->getQRMatrix();
        $moduleCount = $matrix->getSize();
        $scale = max(1, (int) round($size / $moduleCount));
        $options->scale = $scale;
        $qr->setOptions($options);

        /** @var string */
        return $qr->renderMatrix($matrix);
    }

    /**
     * @param  'svg'|'png'  $format
     */
    private function applyModuleColors(QROptions $options, string $fg, string $bg, string $format): void
    {
        $moduleValues = [];

        foreach (QROutputInterface::DEFAULT_MODULE_VALUES as $mType => $isDark) {
            if ($format === 'svg') {
                $moduleValues[$mType] = $isDark ? '#'.$fg : '#'.$bg;
            } else {
                $moduleValues[$mType] = $isDark ? $this->hexToRgb($fg) : $this->hexToRgb($bg);
            }
        }

        $options->moduleValues = $moduleValues;
    }

    private function addDataSegment(QRCode $qr, string $data): void
    {
        foreach (Mode::INTERFACES as $dataInterface) {
            if ($dataInterface::validateString($data)) {
                $qr->addSegment(new $dataInterface($data));

                return;
            }
        }
    }

    private function normalizeHex(?string $hex): string
    {
        $hex = ltrim((string) $hex, '#');

        if (strlen($hex) === 3) {
            $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
        }

        return strtolower($hex);
    }

    /**
     * @return array{0: int, 1: int, 2: int}
     */
    private function hexToRgb(string $hex): array
    {
        return [
            hexdec(substr($hex, 0, 2)),
            hexdec(substr($hex, 2, 2)),
            hexdec(substr($hex, 4, 2)),
        ];
    }
}
