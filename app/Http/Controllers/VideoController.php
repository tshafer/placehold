<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Process;

class VideoController extends Controller
{
    public function __invoke(Request $request)
    {
        $width = min(max((int) $request->query('w', 640), 16), 1920);
        $height = min(max((int) $request->query('h', 360), 16), 1080);
        $duration = min(max((int) $request->query('duration', 5), 1), 30);
        $bg = $this->sanitizeHex($request->query('bg', '374151'));
        $fg = $this->sanitizeHex($request->query('fg', 'ffffff'));
        $fps = min(max((int) $request->query('fps', 24), 1), 60);
        $text = substr($request->query('text', "{$width}x{$height}"), 0, 100);

        // Ensure even dimensions for H.264
        $width = $width % 2 === 0 ? $width : $width + 1;
        $height = $height % 2 === 0 ? $height : $height + 1;

        $outputPath = tempnam(sys_get_temp_dir(), 'phvid_') . '.mp4';

        $cmd = [
            'ffmpeg', '-y',
            '-f', 'lavfi',
            '-i', "color=c=0x{$bg}:s={$width}x{$height}:d={$duration}:r={$fps}",
        ];

        if ($this->hasDrawtextFilter()) {
            $escapedText = str_replace(["'", ":", "\\"], ["'\\\''", "\\:", "\\\\"], $text);
            $fontSize = (int) (min($width, $height) / 6);
            $cmd = array_merge($cmd, [
                '-vf', "drawtext=text='{$escapedText}':fontsize={$fontSize}:fontcolor=0x{$fg}:x=(w-text_w)/2:y=(h-text_h)/2",
            ]);
        }

        $cmd = array_merge($cmd, [
            '-c:v', 'libx264',
            '-preset', 'ultrafast',
            '-tune', 'stillimage',
            '-pix_fmt', 'yuv420p',
            '-movflags', '+faststart',
            $outputPath,
        ]);

        $result = Process::timeout(30)->run($cmd);

        if (!$result->successful() || !file_exists($outputPath)) {
            @unlink($outputPath);
            return response()->json([
                'status' => 'error',
                'message' => 'Video generation failed. FFmpeg may not be available.',
            ], 500);
        }

        return response()->download($outputPath, 'placeholder.mp4', [
            'Content-Type' => 'video/mp4',
            'Cache-Control' => 'public, max-age=86400',
        ])->deleteFileAfterSend(true);
    }

    private function hasDrawtextFilter(): bool
    {
        static $has = null;
        if ($has === null) {
            $result = Process::timeout(5)->run(['ffmpeg', '-filters']);
            $has = $result->successful() && str_contains($result->output(), 'drawtext');
        }
        return $has;
    }

    private function sanitizeHex(string $hex): string
    {
        $hex = ltrim($hex, '#');
        if (preg_match('/^[0-9a-fA-F]{3}$/', $hex)) {
            $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
        }
        return preg_match('/^[0-9a-fA-F]{6}$/', $hex) ? $hex : '374151';
    }
}
