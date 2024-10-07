<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full {{ Cookie::get('darkMode', 'false') === 'true' ? 'dark' : '' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Generate custom placeholder images with our powerful API. Create images with specific sizes, colors, text, and effects.">
        <meta name="keywords" content="placeholder images, image generator, API, custom images">
        <meta name="author" content="placehold.cloud">
        <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">

        <title>placehold.cloud - Custom Placeholder Image Generator</title>

        @vite('resources/css/app.css')
        @vite('resources/js/app.js')

        <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url('/') }}">
        <meta property="og:title" content="placehold.cloud - Custom Placeholder Image Generator">
        <meta property="og:description" content="Generate custom placeholder images with our powerful API. Create images with specific sizes, colors, text, and effects.">
        <meta property="og:image" content="{{ asset('og-image.jpg') }}">
        <!-- Alpine.js -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ url('/') }}">
        <meta property="twitter:title" content="placehold.cloud - Custom Placeholder Image Generator">
        <meta property="twitter:description" content="Generate custom placeholder images with our powerful API. Create images with specific sizes, colors, text, and effects.">
        <meta property="twitter:image" content="{{ asset('twitter-image.jpg') }}">

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="preload" href="https://fonts.googleapis.com/css2?family=VT323&display=swap" as="style">
        <link rel="preload" href="https://fonts.googleapis.com/css2?family=Jersey+25&display=swap" as="style">
        <link href="https://fonts.googleapis.com/css2?family=VT323&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Jersey+25&display=swap" rel="stylesheet">

        <!-- Sitemap -->
        <link rel="sitemap" type="application/xml" href="{{ asset('sitemap.xml') }}">

        <style>
            @keyframes menuHover {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-5px); }
            }
            .menu-item:hover {
                animation: menuHover 0.5s ease-in-out infinite;
            }
            @keyframes neonFlicker {
                0%, 19%, 21%, 23%, 25%, 54%, 56%, 100% {
                    text-shadow:
                        -0.2rem -0.2rem 1rem #fff,
                        0.2rem 0.2rem 1rem #fff,
                        0 0 2rem #f40,
                        0 0 4rem #f40,
                        0 0 6rem #f40,
                        0 0 8rem #f40,
                        0 0 10rem #f40;
                }
                20%, 24%, 55% {
                    text-shadow: none;
                }
            }
            .neon-text {
                animation: neonFlicker 1.5s infinite alternate;
            }
            @keyframes iconSpin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
            @keyframes iconPulse {
                0%, 100% { transform: scale(1); }
                50% { transform: scale(1.1); }
            }
            .menu-icon {
                transition: all 0.3s ease;
            }
            .menu-item:hover .menu-icon {
                animation: iconSpin 1s linear infinite, iconPulse 1s ease-in-out infinite;
            }
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
    <body class="font-jersey-25 antialiased text-white dark:text-gray-200 min-h-screen flex flex-col bg-gradient-to-l from-indigo-600 via-purple-600 to-pink-500 dark:from-gray-900 dark:via-gray-800 dark:to-gray-700">
        @include('partials.header')
        <main class="flex-grow flex items-center justify-center py-12">
            {{ $slot }}
        </main>
         @include('partials.footer')

    </body>
</html>
