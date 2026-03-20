<x-layout>
    <section class="mb-16">
        <span class="text-tertiary font-headline font-bold text-xs tracking-[0.3em] uppercase mb-4 block">Updates</span>
        <h1 class="text-5xl md:text-7xl font-headline font-extrabold tracking-tighter text-on-surface leading-none mb-4">
            Change<span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-tertiary">log</span>
        </h1>
        <p class="text-on-surface-variant text-sm max-w-xl">What's new and improved in placehold.cloud</p>
    </section>

    <div class="space-y-px bg-outline-variant/10">
        @foreach([
            [
                'version' => '1.4.0',
                'date' => 'March 2026',
                'tag' => 'New',
                'tagColor' => 'bg-[#2fd9f4]/20 text-[#2fd9f4]',
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
                'tagColor' => 'bg-[#2fd9f4]/20 text-[#2fd9f4]',
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
                'tagColor' => 'bg-[#2fd9f4]/20 text-[#2fd9f4]',
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
                'tagColor' => 'bg-[#abc7ff]/20 text-[#abc7ff]',
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
                'tagColor' => 'bg-[#ddb7ff]/20 text-[#ddb7ff]',
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
            <div class="bg-surface-container-low">
                <div class="px-6 lg:px-8 py-4 border-b border-outline-variant/20 flex items-center justify-between flex-wrap gap-3">
                    <div class="flex items-center gap-3">
                        <span class="font-mono text-sm font-bold text-on-surface">v{{ $release['version'] }}</span>
                        <span class="text-[10px] font-bold uppercase tracking-[0.2em] px-2 py-0.5 {{ $release['tagColor'] }}">{{ $release['tag'] }}</span>
                    </div>
                    <span class="text-outline text-xs">{{ $release['date'] }}</span>
                </div>
                <div class="px-6 lg:px-8 py-6">
                    <h3 class="text-sm font-headline font-bold text-on-surface mb-4">{{ $release['title'] }}</h3>
                    <ul class="space-y-2">
                        @foreach($release['items'] as $item)
                            <li class="flex items-start gap-3 text-on-surface-variant text-sm">
                                <span class="material-symbols-outlined text-tertiary text-base mt-0.5 shrink-0">check_circle</span>
                                {{ $item }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
</x-layout>
