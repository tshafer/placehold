<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate {--base-url=https://placehold.cloud : Base URL}';
    protected $description = 'Generate sitemap.xml from registered view routes';

    private const EXCLUDED = [
        'toggle-dark-mode',
        'sanctum/csrf-cookie',
    ];

    private const PRIORITIES = [
        '/' => '1.0',
        'image' => '0.9',
        'api' => '0.9',
        'playground' => '0.8',
    ];

    public function handle(): int
    {
        $baseUrl = rtrim($this->option('base-url'), '/');
        $routes = Route::getRoutes();
        $urls = [];

        foreach ($routes as $route) {
            if (! in_array('GET', $route->methods())) {
                continue;
            }

            $uri = $route->uri();

            if ($uri === 'up' || $uri === 'sanctum/csrf-cookie') {
                continue;
            }

            if (str_contains($uri, '{')) {
                continue;
            }

            $name = $route->getName();
            if ($name && in_array($name, self::EXCLUDED)) {
                continue;
            }

            $action = $route->getAction();
            $uses = $action['uses'] ?? null;

            $isViewRoute = is_string($uses) && str_contains($uses, 'Illuminate\Routing\ViewController');
            $isController = is_string($uses) && ! $isViewRoute;
            $isClosure = $uses instanceof \Closure || $uses === null;

            if ($isClosure && $uri !== '/') {
                continue;
            }

            $path = $uri === '/' ? '/' : '/' . ltrim($uri, '/');
            $priority = self::PRIORITIES[$uri] ?? '0.5';

            $urls[] = [
                'loc' => $baseUrl . $path,
                'changefreq' => $this->changeFreq($uri),
                'priority' => $priority,
            ];
        }

        usort($urls, fn($a, $b) => $b['priority'] <=> $a['priority']);

        $xml = $this->buildXml($urls);
        $path = public_path('sitemap.xml');
        file_put_contents($path, $xml);

        $this->info("Sitemap written to public/sitemap.xml (" . count($urls) . " URLs)");

        return self::SUCCESS;
    }

    private function changeFreq(string $uri): string
    {
        return match (true) {
            $uri === '/' => 'daily',
            in_array($uri, ['changelog', 'stats']) => 'daily',
            in_array($uri, ['api', 'playground']) => 'weekly',
            default => 'monthly',
        };
    }

    private function buildXml(array $urls): string
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($urls as $url) {
            $xml .= "  <url>\n";
            $xml .= "    <loc>{$url['loc']}</loc>\n";
            $xml .= "    <changefreq>{$url['changefreq']}</changefreq>\n";
            $xml .= "    <priority>{$url['priority']}</priority>\n";
            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';

        return $xml;
    }
}
