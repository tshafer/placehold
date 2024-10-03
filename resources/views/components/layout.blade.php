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
    <body class="font-sans antialiased text-white min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500">
        {{ $slot }}
    </body>
</html>
