<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Process;

class HealthController extends Controller
{
    public function __invoke()
    {
        $checks = [];
        $allHealthy = true;

        $checks['app'] = $this->checkApp();
        $checks['cache'] = $this->checkCache();
        $checks['database'] = $this->checkDatabase();
        $checks['storage'] = $this->checkStorage();
        $checks['ffmpeg'] = $this->checkFfmpeg();

        foreach ($checks as $check) {
            if ($check['status'] !== 'ok') {
                $allHealthy = false;
            }
        }

        return response()->json([
            'status' => $allHealthy ? 'healthy' : 'degraded',
            'version' => $this->getVersion(),
            'timestamp' => now()->toIso8601String(),
            'uptime' => $this->getUptime(),
            'php' => PHP_VERSION,
            'laravel' => app()->version(),
            'checks' => $checks,
        ], $allHealthy ? 200 : 503);
    }

    private function checkApp(): array
    {
        return [
            'status' => 'ok',
            'message' => 'Application is running',
        ];
    }

    private function checkCache(): array
    {
        try {
            $key = 'health_check_' . uniqid();
            Cache::put($key, 'ok', 10);
            $value = Cache::get($key);
            Cache::forget($key);

            return $value === 'ok'
                ? ['status' => 'ok', 'driver' => config('cache.default')]
                : ['status' => 'error', 'message' => 'Cache read/write failed'];
        } catch (\Throwable $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    private function checkDatabase(): array
    {
        try {
            DB::connection()->getPdo();
            return ['status' => 'ok', 'driver' => config('database.default')];
        } catch (\Throwable $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    private function checkStorage(): array
    {
        $path = storage_path('app/.health_check');
        try {
            file_put_contents($path, 'ok');
            $value = file_get_contents($path);
            unlink($path);

            return $value === 'ok'
                ? ['status' => 'ok']
                : ['status' => 'error', 'message' => 'Storage write failed'];
        } catch (\Throwable $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    private function checkFfmpeg(): array
    {
        try {
            $result = Process::timeout(5)->run('ffmpeg -version 2>&1 | head -1');
            return $result->successful()
                ? ['status' => 'ok', 'version' => trim($result->output())]
                : ['status' => 'unavailable', 'message' => 'ffmpeg not found'];
        } catch (\Throwable) {
            return ['status' => 'unavailable', 'message' => 'Could not execute ffmpeg'];
        }
    }

    private function getVersion(): string
    {
        $path = storage_path('app/changelog.json');
        if (file_exists($path)) {
            $entries = json_decode(file_get_contents($path), true) ?? [];
            return ! empty($entries) ? $entries[0]['version'] : '0.0.0';
        }
        return '0.0.0';
    }

    private function getUptime(): string
    {
        if (! defined('LARAVEL_START')) {
            return 'unknown';
        }

        $seconds = (int) (microtime(true) - LARAVEL_START);

        return $seconds . 's (request lifetime)';
    }
}
