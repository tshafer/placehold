<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full"
    x-data="{ dark: true }"
    x-init="dark = localStorage.getItem('theme') !== 'light'; $nextTick(() => document.documentElement.classList.toggle('dark', dark))"
    x-effect="document.documentElement.classList.toggle('dark', dark); localStorage.setItem('theme', dark ? 'dark' : 'light'); $dispatch('theme-change', { dark })"
    @theme-toggle.window="dark = !dark">
    <head>
        <script>
            (function() {
                var theme = localStorage.getItem('theme');
                document.documentElement.classList.toggle('dark', theme !== 'light');
            })();
        </script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{ $description ?? 'Generate custom placeholder images, text, quotes, and more with placehold.cloud. Free, fast, and production-ready API for developers and designers.' }}">
        <meta name="keywords" content="{{ $keywords ?? 'placeholder images, lorem ipsum generator, API, custom images, developer tools, design tools, free API, JSON placeholder, placeholder text' }}">
        <meta name="author" content="placehold.cloud">
        <meta name="theme-color" content="#0c1322">
        <title>{{ $title ?? 'PLACEHOLD.CLOUD // Kinetic Terminal' }}</title>

        @vite('resources/css/app.css')
        @vite('resources/js/app.js')

        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url('/') }}">
        <meta property="og:title" content="PLACEHOLD.CLOUD // The Ultimate Placeholder Generator">
        <meta property="og:description" content="Generate custom placeholder images with our powerful API. Create images with specific sizes, colors, text, and effects.">
        <meta property="og:image" content="{{ asset('og-image.svg') }}">
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ url('/') }}">
        <meta property="twitter:title" content="PLACEHOLD.CLOUD // The Ultimate Placeholder Generator">
        <meta property="twitter:description" content="Generate custom placeholder images with our powerful API.">
        <meta property="twitter:image" content="{{ asset('og-image.svg') }}">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

        <link rel="sitemap" type="application/xml" href="{{ asset('sitemap.xml') }}">
    </head>
    <body class="antialiased bg-background text-on-background font-body overflow-x-hidden min-h-screen">
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
             class="fixed bottom-0 left-0 right-0 lg:left-64 bg-surface-container-highest/90 glass-panel text-on-surface py-4 px-6 z-50 border-t border-outline-variant/15">
            <div class="max-w-5xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-xs uppercase tracking-widest text-outline">We use cookies to improve your experience. <a href="/cookie-policy" class="text-tertiary hover:underline">Cookie Policy</a>.</p>
                <button @click="localStorage.setItem('cookieConsent', 'true'); show = false"
                        class="liquid-chrome text-on-primary-container px-6 py-2 font-headline font-bold text-[11px] uppercase tracking-widest hover:shadow-[0_0_16px_rgba(171,199,255,0.3)] transition-all whitespace-nowrap">
                    Accept
                </button>
            </div>
        </div>
    </body>
</html>
