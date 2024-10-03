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

        <title>placehold.cloud</title>

        @vite('resources/css/app.css')
    </head>
    <body class="font-sans antialiased text-white min-h-screen flex flex-col bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500">
        <header class="w-full bg-white/10 backdrop-blur-md border-b border-white/20 py-4">
            <div class="container mx-auto px-4 flex justify-between items-center">
                <a href="/" class="text-2xl font-bold text-white">placehold.cloud</a>
                <nav>
                    <ul class="flex space-x-6">
                        <li><a href="/image" class="text-white hover:text-white/80">Image</a></li>
                        <li><a href="/lorem-ipsum" class="text-white hover:text-white/80">Lorem Ipsum</a></li>
                        <li><a href="/quotes" class="text-white hover:text-white/80">Quotes</a></li>
                        <li><a href="/jokes" class="text-white hover:text-white/80">Jokes</a></li>
                        <li><a href="/weather" class="text-white hover:text-white/80">Weather</a></li>
                        <li><a href="/quotes" class="text-white hover:text-white/80">Quotes</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        <main class="flex-grow flex items-center justify-center">
            {{ $slot }}
        </main>
        <footer class="w-full bg-white/10 backdrop-blur-md border-t border-white/20 py-4">
            <div class="container mx-auto px-4 text-center">
                <p class="text-white/80">&copy; {{ date('Y') }} placehold.cloud. All rights reserved.</p>
            </div>
        </footer>
    </body>
</html>
