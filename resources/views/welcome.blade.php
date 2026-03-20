<x-layout>
    {{-- Hero --}}
    <div class="mb-20 flex flex-col lg:flex-row justify-between items-end gap-8">
        <div>
            <span class="text-tertiary font-headline font-bold text-xs tracking-[0.3em] uppercase mb-4 block">Engine :: v1.4.0</span>
            <h2 class="text-5xl md:text-7xl lg:text-8xl font-headline font-extrabold tracking-tighter text-on-surface leading-none">
                PLACEHOLDER<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-tertiary">GENERATOR</span>
            </h2>
            <p class="text-on-surface-variant mt-6 max-w-lg text-sm leading-relaxed">
                Generate images, text, data, documents, and more. Free, fast, production-ready APIs with zero sign-up.
            </p>
        </div>
        <div class="flex gap-4 shrink-0">
            <div class="flex items-center gap-2 bg-surface-container px-4 py-2 border-l-2 border-secondary">
                <span class="w-2 h-2 rounded-full bg-secondary animate-beacon-pulse"></span>
                <span class="meta-label text-secondary">All Systems Active</span>
            </div>
        </div>
    </div>

    {{-- Quick Stats --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-20">
        @foreach([
            ['label' => 'Generators', 'value' => '8', 'icon' => 'image'],
            ['label' => 'Data APIs', 'value' => '9', 'icon' => 'data_object'],
            ['label' => 'Rate Limit', 'value' => '120/min', 'icon' => 'speed'],
            ['label' => 'Cost', 'value' => '$0', 'icon' => 'payments'],
        ] as $stat)
            <div class="bg-surface-container-low p-6 border-l-2 border-primary/30 hover:border-primary transition-colors group">
                <span class="material-symbols-outlined text-outline group-hover:text-primary transition-colors text-[20px] mb-3 block">{{ $stat['icon'] }}</span>
                <span class="text-2xl font-headline font-extrabold text-on-surface block">{{ $stat['value'] }}</span>
                <span class="meta-label mt-1 block">{{ $stat['label'] }}</span>
            </div>
        @endforeach
    </div>

    {{-- Generators Section --}}
    <div class="mb-20">
        <h3 class="section-title mb-10">Generators</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach([
                ['url' => '/image', 'name' => 'Image Placeholder', 'desc' => 'Custom sizes, colors, text, and effects. SVG, PNG, WebP, and more.', 'icon' => 'image'],
                ['url' => '/avatar', 'name' => 'Avatar Generator', 'desc' => 'Deterministic identicon avatars from any seed string.', 'icon' => 'account_circle'],
                ['url' => '/qrcode', 'name' => 'QR Code Generator', 'desc' => 'Encode any URL or text into SVG or PNG QR codes.', 'icon' => 'qr_code_2'],
                ['url' => '/favicon-generator', 'name' => 'Favicon Generator', 'desc' => 'Letter and emoji favicons in SVG format.', 'icon' => 'star'],
                ['url' => '/pdf-generator', 'name' => 'PDF Placeholder', 'desc' => 'Dummy PDF documents with configurable pages and lorem ipsum.', 'icon' => 'picture_as_pdf'],
                ['url' => '/video-generator', 'name' => 'Video Placeholder', 'desc' => 'Static-color MP4 files at any resolution and duration.', 'icon' => 'movie'],
                ['url' => '/holdicon', 'name' => 'Icon Placeholders', 'desc' => 'Placeholder icons with robots, cats, dogs, and more.', 'icon' => 'dashboard'],
                ['url' => '/icons', 'name' => 'Icon Library', 'desc' => 'Browse and download a curated collection of icons.', 'icon' => 'palette'],
            ] as $tool)
                <a href="{{ $tool['url'] }}" class="card-panel p-6 group">
                    <div class="flex items-start gap-4">
                        <span class="material-symbols-outlined text-outline group-hover:text-primary transition-colors text-[28px] mt-1 shrink-0">{{ $tool['icon'] }}</span>
                        <div>
                            <h4 class="font-headline font-bold text-on-surface text-sm uppercase tracking-wider group-hover:text-primary transition-colors">{{ $tool['name'] }}</h4>
                            <p class="text-outline text-xs mt-2 leading-relaxed">{{ $tool['desc'] }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    {{-- Data APIs Section --}}
    <div class="mb-20">
        <h3 class="section-title mb-10">Data APIs</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach([
                ['url' => '/lorem-ipsum', 'name' => 'Lorem Ipsum', 'desc' => 'Dummy text for layouts with configurable paragraphs.', 'icon' => 'notes'],
                ['url' => '/markdown-generator', 'name' => 'Markdown', 'desc' => 'Realistic markdown documents with headings, lists, and code blocks.', 'icon' => 'code'],
                ['url' => '/csv-generator', 'name' => 'CSV / Data', 'desc' => 'Fake tabular data with 5 presets and 35+ column types.', 'icon' => 'table_chart'],
                ['url' => '/json-placeholder', 'name' => 'JSON Placeholder', 'desc' => 'Fake REST API for users, posts, comments, and todos.', 'icon' => 'data_object'],
                ['url' => '/colors', 'name' => 'Color Palettes', 'desc' => 'Generate color palettes and hex codes on demand.', 'icon' => 'format_color_fill'],
                ['url' => '/quotes', 'name' => 'Random Quotes', 'desc' => 'Inspirational and motivational quotes API.', 'icon' => 'format_quote'],
                ['url' => '/jokes', 'name' => 'Random Jokes', 'desc' => 'Programming and dad jokes to brighten your day.', 'icon' => 'mood'],
                ['url' => '/weather', 'name' => 'Weather Data', 'desc' => 'Real-time weather information for any city.', 'icon' => 'cloud'],
                ['url' => '/recipes', 'name' => 'Random Recipes', 'desc' => 'Discover cooking ideas with ingredients and instructions.', 'icon' => 'restaurant'],
            ] as $tool)
                <a href="{{ $tool['url'] }}" class="card-panel p-6 group">
                    <div class="flex items-start gap-4">
                        <span class="material-symbols-outlined text-outline group-hover:text-tertiary transition-colors text-[28px] mt-1 shrink-0">{{ $tool['icon'] }}</span>
                        <div>
                            <h4 class="font-headline font-bold text-on-surface text-sm uppercase tracking-wider group-hover:text-tertiary transition-colors">{{ $tool['name'] }}</h4>
                            <p class="text-outline text-xs mt-2 leading-relaxed">{{ $tool['desc'] }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    {{-- System Section --}}
    <div class="mb-20">
        <h3 class="section-title mb-10">System</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="/playground" class="card-panel p-6 group">
                <span class="material-symbols-outlined text-outline group-hover:text-secondary transition-colors text-[28px] mb-4 block">terminal</span>
                <h4 class="font-headline font-bold text-on-surface text-sm uppercase tracking-wider group-hover:text-secondary transition-colors">Playground</h4>
                <p class="text-outline text-xs mt-2">Live HTML/CSS/JS editor with shareable links.</p>
            </a>
            <a href="/stats" class="card-panel p-6 group">
                <span class="material-symbols-outlined text-outline group-hover:text-secondary transition-colors text-[28px] mb-4 block">monitoring</span>
                <h4 class="font-headline font-bold text-on-surface text-sm uppercase tracking-wider group-hover:text-secondary transition-colors">Usage Dashboard</h4>
                <p class="text-outline text-xs mt-2">Live API usage statistics per endpoint.</p>
            </a>
            <a href="/changelog" class="card-panel p-6 group">
                <span class="material-symbols-outlined text-outline group-hover:text-secondary transition-colors text-[28px] mb-4 block">new_releases</span>
                <h4 class="font-headline font-bold text-on-surface text-sm uppercase tracking-wider group-hover:text-secondary transition-colors">Changelog</h4>
                <p class="text-outline text-xs mt-2">Full release history and what's new.</p>
            </a>
        </div>
    </div>

    {{-- CTA --}}
    <div class="liquid-chrome p-12 text-center">
        <h2 class="text-3xl font-headline font-extrabold text-on-primary-container tracking-tight mb-4">Ready to generate?</h2>
        <p class="text-on-primary-container/70 mb-8 text-sm">Start creating placeholders in seconds. No sign-up required.</p>
        <a href="/image" class="inline-flex items-center gap-2 bg-surface-container-lowest text-on-surface font-headline font-bold px-8 py-4 uppercase tracking-widest text-sm hover:bg-surface-container transition-colors">
            <span class="material-symbols-outlined">bolt</span>
            Launch Generator
        </a>
    </div>
</x-layout>
