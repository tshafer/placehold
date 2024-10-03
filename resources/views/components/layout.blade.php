<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>placehold.cloud</title>

        @vite('resources/css/app.css')
    </head>
    <body class="font-sans antialiased text-white min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500">
        {{ $slot }}
    </body>
</html>
