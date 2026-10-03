<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full"
    x-data="{ dark: false }"
    x-init="dark = localStorage.getItem('theme') === 'dark'; $nextTick(() => document.documentElement.classList.toggle('dark', dark))"
    x-effect="document.documentElement.classList.toggle('dark', dark); localStorage.setItem('theme', dark ? 'dark' : 'light'); $dispatch('theme-change', { dark })"
    @theme-toggle.window="dark = !dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            html, html body { background-color: #f6f6f3; color: #1a1a1a; color-scheme: light; }
            html.dark, html.dark body { background-color: #1a1a1a; color: #f6f6f3; color-scheme: dark; }
            body { visibility: hidden; }
            body.ready { visibility: visible; }
        </style>
        <script>
            (function() {
                var theme = localStorage.getItem('theme');
                var isDark = theme === 'dark';
                document.documentElement.classList.toggle('dark', isDark);
                document.documentElement.style.colorScheme = isDark ? 'dark' : 'light';
            })();
        </script>
        <meta name="description" content="{{ $description ?? 'Generate custom placeholder images, text, quotes, and more with placehold.cloud. Free, fast, and production-ready API for developers and designers.' }}">
        <meta name="keywords" content="{{ $keywords ?? 'placeholder images, lorem ipsum generator, API, custom images, developer tools, design tools, free API, JSON placeholder, placeholder text' }}">
        <meta name="author" content="placehold.cloud">
        <meta name="theme-color" content="#f6f6f3">
        <title>{{ $title ?? 'PLACEHOLD(1) — placehold.cloud' }}</title>

        @vite('resources/css/app.css')
        @vite('resources/js/app.js')

        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url('/') }}">
        <meta property="og:title" content="PLACEHOLD(1) — placehold.cloud">
        <meta property="og:description" content="Generate custom placeholder images with our powerful API. Create images with specific sizes, colors, text, and effects.">
        <meta property="og:image" content="{{ asset('og-image.png') }}">
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ url('/') }}">
        <meta property="twitter:title" content="PLACEHOLD(1) — placehold.cloud">
        <meta property="twitter:description" content="Generate custom placeholder images with our powerful API.">
        <meta property="twitter:image" content="{{ asset('og-image.png') }}">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;700;800&display=swap" rel="stylesheet">

        <link rel="sitemap" type="application/xml" href="{{ asset('sitemap.xml') }}">

        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7523116315863058"
             crossorigin="anonymous"></script>
    </head>
    <body class="antialiased bg-background text-on-background font-body overflow-x-hidden min-h-screen" id="body-el">
        <script>
            (function() {
                var body = document.getElementById('body-el');
                var show = function() { body.classList.add('ready'); };
                if (document.fonts && document.fonts.ready) {
                    document.fonts.ready.then(show, show);
                    setTimeout(show, 3000);
                } else {
                    requestAnimationFrame(show);
                }
            })();
        </script>
        @include('partials.header')

        <main class="lg:ml-64 min-h-screen flex flex-col">
            @include('partials.topbar')

            <section class="p-6 lg:p-12 flex-1">
                <div class="max-w-7xl mx-auto">
                    {{ $slot }}
                </div>
            </section>

            @include('partials.footer')
        </main>

        {{-- Cookie consent --}}
        <div id="cookie-consent" x-data="{ show: !localStorage.getItem('cookieConsent') }" x-show="show" x-transition
             class="fixed bottom-0 left-0 right-0 lg:left-64 bg-background text-on-surface py-4 px-6 z-50 border-t border-dashed border-on-surface">
            <div class="max-w-5xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-xs text-on-surface-variant">We use cookies to improve your experience. <a href="/cookie-policy" class="text-primary underline">Cookie Policy</a>.</p>
                <button @click="localStorage.setItem('cookieConsent', 'true'); show = false"
                        class="liquid-chrome text-on-primary-container px-6 py-2 font-bold text-xs uppercase hover:opacity-80 transition-opacity whitespace-nowrap">
                    Accept
                </button>
            </div>
        </div>
    </body>
</html>
