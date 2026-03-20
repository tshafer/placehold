<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Str;

class GenerateVideoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $timeout = 120;

    public function __construct(
        public int $width,
        public int $height,
        public int $duration,
        public string $bg,
        public string $fg,
        public string $text,
        public int $fps,
        public string $callbackUrl,
        public ?string $jobId = null,
    ) {}

    public function handle(): void
    {
        $jobId = $this->jobId ?? (string) Str::uuid();
        $uuid = (string) Str::uuid();
        $dir = storage_path('app/generated');
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $outputPath = $dir . '/' . $uuid . '.mp4';

        $cmd = [
            'ffmpeg', '-y',
            '-f', 'lavfi',
            '-i', "color=c=0x{$this->bg}:s={$this->width}x{$this->height}:d={$this->duration}:r={$this->fps}",
        ];

        if ($this->hasDrawtextFilter()) {
            $escapedText = str_replace(["'", ":", "\\"], ["'\\\''", "\\:", "\\\\"], $this->text);
            $fontSize = (int) (min($this->width, $this->height) / 6);
            $cmd = array_merge($cmd, [
                '-vf', "drawtext=text='{$escapedText}':fontsize={$fontSize}:fontcolor=0x{$this->fg}:x=(w-text_w)/2:y=(h-text_h)/2",
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

        $result = Process::timeout(90)->run($cmd);

        if (! $result->successful() || ! file_exists($outputPath)) {
            @unlink($outputPath);
            $this->notifyCallback($jobId, 'failed', null, 'Video generation failed.');
            return;
        }

        $url = url('/generated/video/' . $uuid);
        $this->notifyCallback($jobId, 'completed', $url, null);
    }

    private function notifyCallback(string $jobId, string $status, ?string $url, ?string $message): void
    {
        $payload = [
            'job_id' => $jobId,
            'status' => $status,
            'expires_in' => 3600,
        ];
        if ($url) {
            $payload['url'] = $url;
        }
        if ($message) {
            $payload['message'] = $message;
        }

        try {
            Http::timeout(10)->post($this->callbackUrl, $payload);
        } catch (\Throwable) {
            // Log and continue; callback is best-effort
        }
    }

    private function hasDrawtextFilter(): bool
    {
        $result = Process::timeout(5)->run(['ffmpeg', '-filters']);
        return $result->successful() && str_contains($result->output(), 'drawtext');
    }
}
