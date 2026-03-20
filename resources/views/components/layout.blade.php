<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full {{ Cookie::get('darkMode', 'false') === 'true' ? 'dark' : '' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{ $description ?? 'Generate custom placeholder images, text, quotes, and more with placehold.cloud. Free, fast, and production-ready API for developers and designers.' }}">
        <meta name="keywords" content="{{ $keywords ?? 'placeholder images, lorem ipsum generator, API, custom images, developer tools, design tools, free API, JSON placeholder, placeholder text' }}">
        <meta name="author" content="placehold.cloud">
        <meta name="theme-color" content="#6366f1">
        <title>{{ $title ?? 'placehold.cloud - The Ultimate Placeholder Generator' }}</title>

        @vite('resources/css/app.css')
        @vite('resources/js/app.js')

        <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url('/') }}">
        <meta property="og:title" content="placehold.cloud - Custom Placeholder Image Generator">
        <meta property="og:description" content="Generate custom placeholder images with our powerful API. Create images with specific sizes, colors, text, and effects.">
        <meta property="og:image" content="{{ asset('og-image.svg') }}">
        <!-- Alpine.js -->
        <script defer src="https://cdn.jsdelivr.net/npm/[email protected]/dist/cdn.min.js"></script>

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ url('/') }}">
        <meta property="twitter:title" content="placehold.cloud - Custom Placeholder Image Generator">
        <meta property="twitter:description" content="Generate custom placeholder images with our powerful API. Create images with specific sizes, colors, text, and effects.">
        <meta property="twitter:image" content="{{ asset('og-image.svg') }}">

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Jersey+25&family=VT323&display=swap" rel="stylesheet">

        <!-- Sitemap -->
        <link rel="sitemap" type="application/xml" href="{{ asset('sitemap.xml') }}">

        <style>
            @keyframes secretAnimation {
                0% { transform: scale(1) rotate(0deg); }
                50% { transform: scale(1.5) rotate(180deg); }
                100% { transform: scale(1) rotate(360deg); }
            }
            .secret-animation {
                animation: secretAnimation 2s ease-in-out;
            }
        </style>
    </head>
    <body class="antialiased bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 min-h-screen flex flex-col">
        @include('partials.header')
        <main class="flex-grow py-8">
            {{ $slot }}
        </main>
         @include('partials.footer')

    </body>
</html>
