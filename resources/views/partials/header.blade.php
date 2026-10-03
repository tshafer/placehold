@php
    $currentRoute = request()->path();

    $sections = [
        'Generators' => [
            '/image', '/avatar', '/qrcode', '/favicon-generator', '/pdf-generator', '/video-generator', '/holdicon', '/icons',
        ],
        'Data' => [
            '/lorem-ipsum', '/markdown-generator', '/csv-generator', '/json-placeholder', '/colors', '/quotes', '/jokes', '/weather', '/recipes',
        ],
        'Utilities' => [
            '/base64-tool', '/hash-tool', '/uuid-tool', '/color-converter',
        ],
        'See also' => [
            '/playground', '/stats', '/api', '/ai-docs', '/changelog', '/about-us', '/contact',
        ],
    ];
@endphp

{{-- Desktop Sidebar --}}
<aside class="fixed left-0 top-0 h-full w-64 bg-background border-r border-dashed border-on-surface/40 flex-col z-40 hidden lg:flex">
    <a href="/" class="block px-6 pt-6 pb-1 font-extrabold text-on-surface">PLACEHOLD(1)</a>
    <p class="px-6 pb-4 text-xs text-outline">placeholder generator</p>

    <nav aria-label="Tools" class="flex-1 overflow-y-auto pb-6">
        <a href="/" class="man-link {{ $currentRoute === '/' ? 'man-link-active' : '' }}">/</a>
        @foreach($sections as $title => $urls)
            <p class="px-6 pt-5 pb-1 text-[13px] font-extrabold uppercase text-on-surface">{{ $title }}</p>
            @foreach($urls as $url)
                <a href="{{ $url }}" class="man-link {{ $currentRoute === ltrim($url, '/') ? 'man-link-active' : '' }}">{{ $url }}</a>
            @endforeach
        @endforeach
    </nav>

    <p class="px-6 py-4 border-t border-dashed border-on-surface/40 text-xs text-outline">
        Built by <a href="https://shafer.llc" class="text-primary underline">Shafer LLC</a>
    </p>
</aside>

{{-- Mobile Header --}}
<header class="lg:hidden fixed top-0 left-0 right-0 h-14 bg-background flex items-center justify-between px-4 z-50 border-b border-dashed border-on-surface/40"
        x-data="{ mobileOpen: false }">
    <a href="/" class="font-extrabold text-on-surface">PLACEHOLD(1)</a>

    <button type="button" @click="mobileOpen = !mobileOpen" :aria-expanded="mobileOpen" aria-controls="mobile-nav"
            class="px-3 py-2 text-sm text-primary hover:underline">
        <span x-show="!mobileOpen">[menu]</span>
        <span x-show="mobileOpen" x-cloak>[close]</span>
    </button>

    <nav id="mobile-nav" aria-label="Tools" x-show="mobileOpen" x-cloak
         class="absolute top-14 left-0 right-0 bg-background border-b border-dashed border-on-surface/40 max-h-[80vh] overflow-y-auto pb-6">
        <a href="/" class="man-link py-2 {{ $currentRoute === '/' ? 'man-link-active' : '' }}">/</a>
        @foreach($sections as $title => $urls)
            <p class="px-6 pt-4 pb-1 text-[13px] font-extrabold uppercase text-on-surface">{{ $title }}</p>
            @foreach($urls as $url)
                <a href="{{ $url }}" class="man-link py-2 {{ $currentRoute === ltrim($url, '/') ? 'man-link-active' : '' }}">{{ $url }}</a>
            @endforeach
        @endforeach
    </nav>
</header>

@if(session('success'))
    <div role="status" class="fixed top-4 right-4 bg-primary-container text-on-primary-container px-6 py-3 z-50 text-sm">
        {{ session('success') }}
    </div>
@endif
