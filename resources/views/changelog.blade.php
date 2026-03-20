<x-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">Changelog</h1>
            <p class="text-gray-600 dark:text-gray-400">What's new and improved in placehold.cloud</p>
        </div>

        <div class="space-y-8">
            @foreach([
                [
                    'version' => '1.4.0',
                    'date' => 'March 2026',
                    'tag' => 'New',
                    'tagColor' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                    'title' => 'Usage Dashboard, Playground, Changelog & Rate Limit Headers',
                    'items' => [
                        'Public usage dashboard with live API call stats per endpoint',
                        'Embed playground with live HTML/CSS/JS editor and shareable links',
                        'This changelog page to track what\'s new',
                        'X-RateLimit-* headers on all API responses for consumer self-throttling',
                        'API usage tracking middleware across all endpoints',
                    ],
                ],
                [
                    'version' => '1.3.0',
                    'date' => 'March 2026',
                    'tag' => 'New',
                    'tagColor' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                    'title' => 'PDF, CSV, Markdown & Video Generators',
                    'items' => [
                        'PDF placeholder generator with configurable pages, title, size, and orientation',
                        'CSV / data generator with 5 presets, 35+ column types, CSV & JSON output',
                        'Markdown placeholder with headings, lists, code blocks, tables, and TOC',
                        'Video placeholder generating static-color MP4 files via FFmpeg',
                    ],
                ],
                [
                    'version' => '1.2.0',
                    'date' => 'March 2026',
                    'tag' => 'New',
                    'tagColor' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                    'title' => 'Avatar, QR Code, Favicon & JSON Placeholder',
                    'items' => [
                        'Deterministic identicon avatar generator from any seed string',
                        'QR code generator with SVG & PNG output, custom colors, and error correction levels',
                        'Favicon generator producing letter/emoji SVG favicons',
                        'JSON placeholder API with users, posts, comments, and todos',
                        'Categorized dropdown navigation menus',
                    ],
                ],
                [
                    'version' => '1.1.0',
                    'date' => 'March 2026',
                    'tag' => 'Improved',
                    'tagColor' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
                    'title' => 'Design Fixes & Infrastructure',
                    'items' => [
                        'Replaced all inline SVGs with blade-heroicons components',
                        'Bundled Alpine.js via Vite instead of CDN (Cloudflare compatibility)',
                        'Fixed cookie consent banner not closing on accept',
                        'Added custom 403, 404, 429, and 500 error pages',
                        'Added OG/Twitter social share images',
                        'Converted 100% of tests to Pest PHP',
                    ],
                ],
                [
                    'version' => '1.0.0',
                    'date' => 'March 2026',
                    'tag' => 'Launch',
                    'tagColor' => 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400',
                    'title' => 'Initial Release',
                    'items' => [
                        'Placeholder image generator with custom sizes, colors, text, and formats',
                        'Lorem Ipsum text generator with paragraphs, word count, and seed support',
                        'Random quotes, jokes, weather, and recipe APIs',
                        'Color palette and hex code generator',
                        'Holdicon placeholder icons with robots, cats, and dogs',
                        'SVG icon library with search and download',
                        'Dark mode toggle',
                        'Contact form',
                    ],
                ],
            ] as $release)
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between flex-wrap gap-3">
                        <div class="flex items-center gap-3">
                            <span class="font-mono text-lg font-bold text-gray-900 dark:text-white">v{{ $release['version'] }}</span>
                            <span class="text-xs font-medium px-2 py-0.5 rounded-full {{ $release['tagColor'] }}">{{ $release['tag'] }}</span>
                        </div>
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $release['date'] }}</span>
                    </div>
                    <div class="px-6 py-5">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">{{ $release['title'] }}</h3>
                        <ul class="space-y-2">
                            @foreach($release['items'] as $item)
                                <li class="flex items-start gap-2 text-sm text-gray-600 dark:text-gray-400">
                                    <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 shrink-0 mt-0.5" />
                                    {{ $item }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
