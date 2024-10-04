<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
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

        <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url('/') }}">
        <meta property="og:title" content="placehold.cloud - Custom Placeholder Image Generator">
        <meta property="og:description" content="Generate custom placeholder images with our powerful API. Create images with specific sizes, colors, text, and effects.">
        <meta property="og:image" content="{{ asset('og-image.jpg') }}">

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
                0% { transform: translateY(0); }
                50% { transform: translateY(-5px); }
                100% { transform: translateY(0); }
            }
            .menu-item:hover {
                animation: menuHover 0.3s ease-in-out;
            }
        </style>
    </head>
    <body class="font-jersey-25 antialiased text-white min-h-screen flex flex-col bg-gradient-to-l from-indigo-600 via-purple-600 to-pink-500">
        <header class="w-full bg-white bg-opacity-10 backdrop-blur-md border-b border-white border-opacity-20 py-4 sticky top-0 z-10">
            <div class="container mx-auto px-4 flex justify-between items-center">
                <a href="/" class="text-2xl font-bold text-white flex items-center">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2 hover:animate-[logoSpinTakeoff_0.5s_linear_infinite]">
                        <rect width="40" height="40" rx="8" fill="url(#gradient)"/>
                        <path d="M20 8L28 16H12L20 8Z" fill="white"/>
                        <path d="M8 20L16 28V12L8 20Z" fill="white"/>
                        <path d="M32 20L24 28V12L32 20Z" fill="white"/>
                        <path d="M20 32L28 24H12L20 32Z" fill="white"/>
                        <defs>
                            <linearGradient id="gradient" x1="0" y1="0" x2="40" y2="40" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#4F46E5"/>
                                <stop offset="0.5" stop-color="#9333EA"/>
                                <stop offset="1" stop-color="#EC4899"/>
                            </linearGradient>
                        </defs>
                    </svg>
                    <span class="text-2xl tracking-wide font-vt323 font-bold">placehold.cloud</span>
                </a>
                <nav>
                    <ul class="flex space-x-6">
                        @php
                            $currentRoute = request()->path();
                            $pages = [
                                'image' => '/image',
                                'lorem-ipsum' => '/lorem-ipsum',
                                'quotes' => '/quotes',
                                'jokes' => '/jokes',
                                'weather' => '/weather',
                                'recipes' => '/recipes',
                                'holdicon' => '/holdicon',
                            ];
                        @endphp
                        @foreach ($pages as $name => $url)
                            <li>
                                <a href="{{ $url }}" class="menu-item flex items-center transition-all duration-300 hover:text-yellow-300 {{ $currentRoute === $name ? 'text-yellow-300 font-bold scale-120' : '' }}">
                                    @switch($name)
                                        @case('image')
                                            <svg class="w-6 h-6 mr-2 transition-transform duration-300 group-hover:animate-bounce" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                            @break
                                        @case('lorem-ipsum')
                                            <svg class="w-6 h-6 mr-2 transition-transform duration-300 group-hover:animate-bounce" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                                            @break
                                        @case('quotes')
                                            <svg class="w-6 h-6 mr-2 transition-transform duration-300 group-hover:animate-bounce" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                                            @break
                                        @case('jokes')
                                            <svg class="w-6 h-6 mr-2 transition-transform duration-300 group-hover:animate-bounce" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>
                                            @break
                                        @case('weather')
                                            <svg class="w-6 h-6 mr-2 transition-transform duration-300 group-hover:animate-bounce" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 12a11.05 11.05 0 0 0-22 0zm-5 7a3 3 0 0 1-6 0v-7"/></svg>
                                            @break
                                        @case('recipes')
                                            <svg class="w-6 h-6 mr-2 transition-transform duration-300 group-hover:animate-bounce" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>
                                            @break
                                        @case('holdicon')
                                            <svg class="w-6 h-6 mr-2 transition-transform duration-300 group-hover:animate-bounce" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="12" cy="12" r="3"/><path d="M12 5v1.5M12 17.5V19M5 12h1.5M17.5 12H19"/></svg>
                                            @break
                                    @endswitch
                                    <span>{{ ucfirst($name) }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
        </header>
        <main class="flex-grow flex items-center justify-center py-12">
            {{ $slot }}
        </main>
        <footer class="w-full bg-white bg-opacity-10 backdrop-blur-md border-t border-white border-opacity-20 py-8">
            <div class="container mx-auto px-4">
                <div class="flex flex-wrap justify-between items-center">
                    <div class="w-full md:w-1/2 mb-6 md:mb-0">
                        <h3 class="text-xl font-bold mb-2 font-vt323">placehold.cloud</h3>
                        <p class="text-green-400 animate-[pulse_1s_ease-in-out_infinite] transition-colors duration-300">Your go-to solution for placeholder content and APIs.</p>
                    </div>
                    <div class="w-full md:w-1/2">
                        <h4 class="text-lg font-semibold mb-2">Quick Links</h4>
                        <ul class="space-y-2">
                            <li><a href="/about-us" class="text-white text-opacity-80 hover:text-white transition duration-300">About Us</a></li>
                            <li><a href="/privacy-policy" class="text-white text-opacity-80 hover:text-white transition duration-300">Privacy Policy</a></li>
                            <li><a href="/terms-of-service" class="text-white text-opacity-80 hover:text-white transition duration-300">Terms of Service</a></li>
                            <li><a href="/cookie-policy" class="text-white text-opacity-80 hover:text-white transition duration-300">Cookie Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="mt-8 pt-8 border-t border-white border-opacity-20 text-center">
                    <p class="text-white text-opacity-80">&copy; {{ date('Y') }} placehold.cloud. All rights reserved.</p>
                </div>
            </div>
        </footer>

        <!-- Cookie Consent -->
        <div id="cookie-consent" class="fixed bottom-0 left-0 w-full bg-gray-900 text-white py-4 px-6 flex justify-between items-center">
            <p>We use cookies to improve your experience. By using our site, you agree to our use of cookies. For more information, please see our <a href="/cookie-policy" class="underline">Cookie Policy</a>.</p>
            <button id="accept-cookies" class="bg-white text-gray-900 px-4 py-2 rounded hover:bg-gray-200 transition duration-300 animate-[bounce_1s_infinite]">Accept</button>
        </div>

        <!-- Scripts -->
        <script>
            // Cookie Consent
            document.getElementById('accept-cookies').addEventListener('click', function() {
                document.getElementById('cookie-consent').style.display = 'none';
                // Set a cookie to remember user's choice
                document.cookie = "cookie_consent=accepted; max-age=" + 60*60*24*365 + "; path=/";
            });

            // Check if user has already accepted cookies
            if (document.cookie.indexOf('cookie_consent=accepted') > -1) {
                document.getElementById('cookie-consent').style.display = 'none';
            }
        </script>
    </body>
</html>
