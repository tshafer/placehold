@php
    $currentRoute = request()->path();

    $generators = [
        ['url' => '/image', 'name' => 'Image Gen', 'icon' => 'image', 'match' => 'image'],
        ['url' => '/avatar', 'name' => 'Avatars', 'icon' => 'account_circle', 'match' => 'avatar'],
        ['url' => '/qrcode', 'name' => 'QR Codes', 'icon' => 'qr_code_2', 'match' => 'qrcode'],
        ['url' => '/favicon-generator', 'name' => 'Favicons', 'icon' => 'star', 'match' => 'favicon-generator'],
        ['url' => '/pdf-generator', 'name' => 'PDF Gen', 'icon' => 'picture_as_pdf', 'match' => 'pdf-generator'],
        ['url' => '/video-generator', 'name' => 'Video Gen', 'icon' => 'movie', 'match' => 'video-generator'],
        ['url' => '/holdicon', 'name' => 'Holdicons', 'icon' => 'dashboard', 'match' => 'holdicon'],
        ['url' => '/icons', 'name' => 'Icon Library', 'icon' => 'palette', 'match' => 'icons'],
    ];

    $dataApis = [
        ['url' => '/lorem-ipsum', 'name' => 'Lorem Ipsum', 'icon' => 'notes', 'match' => 'lorem-ipsum'],
        ['url' => '/markdown-generator', 'name' => 'Markdown', 'icon' => 'code', 'match' => 'markdown-generator'],
        ['url' => '/csv-generator', 'name' => 'CSV / Data', 'icon' => 'table_chart', 'match' => 'csv-generator'],
        ['url' => '/json-placeholder', 'name' => 'JSON API', 'icon' => 'data_object', 'match' => 'json-placeholder'],
        ['url' => '/colors', 'name' => 'Colors', 'icon' => 'format_color_fill', 'match' => 'colors'],
        ['url' => '/quotes', 'name' => 'Quotes', 'icon' => 'format_quote', 'match' => 'quotes'],
        ['url' => '/jokes', 'name' => 'Jokes', 'icon' => 'mood', 'match' => 'jokes'],
        ['url' => '/weather', 'name' => 'Weather', 'icon' => 'cloud', 'match' => 'weather'],
        ['url' => '/recipes', 'name' => 'Recipes', 'icon' => 'restaurant', 'match' => 'recipes'],
    ];

    $utilities = [
        ['url' => '/base64-tool', 'name' => 'Base64', 'icon' => 'swap_horiz', 'match' => 'base64-tool'],
        ['url' => '/hash-tool', 'name' => 'Hash Gen', 'icon' => 'fingerprint', 'match' => 'hash-tool'],
        ['url' => '/uuid-tool', 'name' => 'UUID Gen', 'icon' => 'tag', 'match' => 'uuid-tool'],
        ['url' => '/color-converter', 'name' => 'Color Convert', 'icon' => 'colorize', 'match' => 'color-converter'],
    ];

    $meta = [
        ['url' => '/playground', 'name' => 'Playground', 'icon' => 'terminal', 'match' => 'playground'],
        ['url' => '/stats', 'name' => 'Usage Stats', 'icon' => 'monitoring', 'match' => 'stats'],
        ['url' => '/api', 'name' => 'API Docs', 'icon' => 'api', 'match' => 'api'],
        ['url' => '/changelog', 'name' => 'Changelog', 'icon' => 'new_releases', 'match' => 'changelog'],
    ];
@endphp

{{-- Desktop Sidebar --}}
<aside class="fixed left-0 top-0 h-full w-64 bg-surface-container-low border-r border-outline-variant/15 flex-col z-40 hidden lg:flex">
    <div class="p-8">
        <a href="/" class="block">
            <h1 class="text-2xl font-black tracking-tighter text-transparent bg-clip-text bg-gradient-to-br from-primary to-primary-container font-headline">PLACEHOLD</h1>
            <p class="font-headline tracking-tight font-bold uppercase text-[12px] text-primary/60 mt-1">KINETIC TERMINAL</p>
        </a>
    </div>

    <nav class="flex-1 px-4 space-y-1 overflow-y-auto">
        <a href="/" class="nav-link {{ $currentRoute === '/' ? 'nav-link-active' : '' }}">
            <span class="material-symbols-outlined text-[20px]">home</span>
            <span>Home</span>
        </a>

        <p class="meta-label px-4 pt-6 pb-2">Generators</p>
        @foreach($generators as $item)
            <a href="{{ $item['url'] }}" class="nav-link {{ $currentRoute === $item['match'] ? 'nav-link-active' : '' }}">
                <span class="material-symbols-outlined text-[20px]">{{ $item['icon'] }}</span>
                <span>{{ $item['name'] }}</span>
            </a>
        @endforeach

        <p class="meta-label px-4 pt-6 pb-2">Data APIs</p>
        @foreach($dataApis as $item)
            <a href="{{ $item['url'] }}" class="nav-link {{ $currentRoute === $item['match'] ? 'nav-link-active' : '' }}">
                <span class="material-symbols-outlined text-[20px]">{{ $item['icon'] }}</span>
                <span>{{ $item['name'] }}</span>
            </a>
        @endforeach

        <p class="meta-label px-4 pt-6 pb-2">Utilities</p>
        @foreach($utilities as $item)
            <a href="{{ $item['url'] }}" class="nav-link {{ $currentRoute === $item['match'] ? 'nav-link-active' : '' }}">
                <span class="material-symbols-outlined text-[20px]">{{ $item['icon'] }}</span>
                <span>{{ $item['name'] }}</span>
            </a>
        @endforeach

        <p class="meta-label px-4 pt-6 pb-2">System</p>
        @foreach($meta as $item)
            <a href="{{ $item['url'] }}" class="nav-link {{ $currentRoute === $item['match'] ? 'nav-link-active' : '' }}">
                <span class="material-symbols-outlined text-[20px]">{{ $item['icon'] }}</span>
                <span>{{ $item['name'] }}</span>
            </a>
        @endforeach
    </nav>

    <div class="p-6 mt-auto">
        <a href="/contact" class="block w-full liquid-chrome text-on-primary-container font-headline font-bold py-3 px-4 rounded-md shadow-lg hover:shadow-secondary/20 transition-all uppercase tracking-widest text-[11px] text-center">
            Contact Us
        </a>
        <div class="flex items-center gap-3 mt-6">
            <div class="w-8 h-8 rounded-full bg-surface-container-highest flex items-center justify-center">
                <span class="material-symbols-outlined text-primary text-[16px]">bolt</span>
            </div>
            <div class="flex flex-col">
                <span class="meta-label">Built by</span>
                <a href="https://shafer.llc" class="text-[12px] font-headline text-on-surface hover:text-primary transition-colors">SHAFER LLC</a>
            </div>
        </div>
    </div>
</aside>

{{-- Mobile Header --}}
<header class="lg:hidden fixed top-0 left-0 right-0 h-14 bg-surface/90 glass-panel flex items-center justify-between px-4 z-50 border-b border-outline-variant/15"
        x-data="{ mobileOpen: false }">
    <a href="/" class="font-headline font-black text-lg tracking-tighter text-transparent bg-clip-text bg-gradient-to-r from-primary to-primary-container">PLACEHOLD</a>

    <button @click="mobileOpen = !mobileOpen" class="text-outline hover:text-primary transition-colors">
        <span x-show="!mobileOpen" class="material-symbols-outlined">menu</span>
        <span x-show="mobileOpen" x-cloak class="material-symbols-outlined">close</span>
    </button>

    {{-- Mobile Drawer --}}
    <div x-show="mobileOpen" x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-[-8px]"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-[-8px]"
         class="absolute top-14 left-0 right-0 bg-surface-container-low/95 glass-panel border-b border-outline-variant/15 max-h-[80vh] overflow-y-auto">
        <nav class="p-4 space-y-1">
            <a href="/" class="nav-link {{ $currentRoute === '/' ? 'nav-link-active' : '' }}">
                <span class="material-symbols-outlined text-[20px]">home</span>
                <span>Home</span>
            </a>

            <p class="meta-label px-4 pt-4 pb-1">Generators</p>
            @foreach($generators as $item)
                <a href="{{ $item['url'] }}" class="nav-link {{ $currentRoute === $item['match'] ? 'nav-link-active' : '' }}">
                    <span class="material-symbols-outlined text-[20px]">{{ $item['icon'] }}</span>
                    <span>{{ $item['name'] }}</span>
                </a>
            @endforeach

            <p class="meta-label px-4 pt-4 pb-1">Data APIs</p>
            @foreach($dataApis as $item)
                <a href="{{ $item['url'] }}" class="nav-link {{ $currentRoute === $item['match'] ? 'nav-link-active' : '' }}">
                    <span class="material-symbols-outlined text-[20px]">{{ $item['icon'] }}</span>
                    <span>{{ $item['name'] }}</span>
                </a>
            @endforeach

            <p class="meta-label px-4 pt-4 pb-1">Utilities</p>
            @foreach($utilities as $item)
                <a href="{{ $item['url'] }}" class="nav-link {{ $currentRoute === $item['match'] ? 'nav-link-active' : '' }}">
                    <span class="material-symbols-outlined text-[20px]">{{ $item['icon'] }}</span>
                    <span>{{ $item['name'] }}</span>
                </a>
            @endforeach

            <p class="meta-label px-4 pt-4 pb-1">System</p>
            @foreach($meta as $item)
                <a href="{{ $item['url'] }}" class="nav-link {{ $currentRoute === $item['match'] ? 'nav-link-active' : '' }}">
                    <span class="material-symbols-outlined text-[20px]">{{ $item['icon'] }}</span>
                    <span>{{ $item['name'] }}</span>
                </a>
            @endforeach

            <div class="pt-4 border-t border-outline-variant/15 mt-4">
                <a href="/about-us" class="nav-link"><span class="material-symbols-outlined text-[20px]">info</span><span>About</span></a>
                <a href="/contact" class="nav-link"><span class="material-symbols-outlined text-[20px]">mail</span><span>Contact</span></a>
            </div>
        </nav>
    </div>
</header>

@if(session('success'))
    <div class="fixed top-4 right-4 bg-tertiary-container text-on-tertiary-container px-6 py-3 shadow-lg z-50 font-headline text-sm uppercase tracking-widest">
        {{ session('success') }}
    </div>
@endif
