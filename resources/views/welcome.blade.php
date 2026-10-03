<x-layout>
    @php
        $commands = [
            'Generators' => [
                ['/image', 'any size, color, text, effect; svg png jpg gif webp'],
                ['/avatar', 'deterministic identicon from a seed'],
                ['/qrcode', 'encode text or a url as svg or png'],
                ['/favicon-generator', 'letter or emoji favicon, svg'],
                ['/pdf-generator', 'dummy pdf, configurable page count'],
                ['/video-generator', 'solid-color mp4, any resolution'],
                ['/holdicon', 'robot, cat and dog icons'],
                ['/icons', 'curated icon library'],
            ],
            'Data' => [
                ['/lorem-ipsum', 'paragraphs or words; json, html, text'],
                ['/markdown-generator', 'documents with headings, lists, code'],
                ['/csv-generator', '5 presets, 35+ column types'],
                ['/json-placeholder', 'fake rest: users, posts, comments, todos'],
                ['/colors', 'palettes and hex codes'],
                ['/quotes', 'random or by category'],
                ['/jokes', 'programming and dad jokes'],
                ['/weather', 'current conditions for a city'],
                ['/recipes', 'ingredients and instructions'],
            ],
            'Utilities' => [
                ['/base64-tool', 'encode, decode'],
                ['/hash-tool', 'sha-256, md5 and 14 more'],
                ['/uuid-tool', 'v4 and v7, bulk'],
                ['/color-converter', 'hex, rgb, hsl, hsv, contrast'],
            ],
        ];
    @endphp

    <div class="max-w-4xl text-[15px] leading-relaxed">
        <h1 class="sr-only">placehold.cloud — placeholder generator</h1>

        <h2 class="font-extrabold">NAME</h2>
        <p class="ml-6 sm:ml-12">placehold — generate stand-in images, text, data and documents</p>

        <h2 class="mt-8 font-extrabold">SYNOPSIS</h2>
        <div class="code-block ml-6 sm:ml-12 mt-2 p-6">
            <div class="text-2xl sm:text-5xl font-extrabold leading-tight tracking-tight break-all">placehold.cloud/<span class="text-primary">600x400</span></div>
            <div class="mt-3 text-on-surface-variant">[/<u>bg</u>[/<u>fg</u>]] [?text=<u>str</u>] [&amp;format=png|jpg|webp|svg]</div>
        </div>

        <h2 class="mt-8 font-extrabold">DESCRIPTION</h2>
        <p class="ml-6 sm:ml-12 max-w-2xl">Every endpoint is a plain URL. No keys, no accounts. Responses are cached for a week, so the same request returns the same bytes. Free for any use.</p>

        <h2 class="mt-8 font-extrabold">COMMANDS</h2>
        @foreach($commands as $group => $items)
            <div class="ml-6 sm:ml-12 mt-3">
                <h3 class="font-bold text-outline">{{ $group }}</h3>
                @foreach($items as [$url, $desc])
                    <div class="grid sm:grid-cols-[16rem_minmax(0,1fr)] gap-x-6 py-0.5">
                        <a href="{{ $url }}" class="font-bold text-primary hover:underline">{{ $url }}</a>
                        <span class="ml-6 sm:ml-0">{{ $desc }}</span>
                    </div>
                @endforeach
            </div>
        @endforeach

        <h2 class="mt-8 font-extrabold">EXAMPLES</h2>
        <div class="ml-6 sm:ml-12 mt-2 space-y-4 break-all">
            <div>
                <p class="text-outline">A social card with a caption:</p>
                <p class="ml-6"><span class="text-outline">$</span> curl -O placehold.cloud/1200x630?text=Launch</p>
            </div>
            <div>
                <p class="text-outline">Three paragraphs of filler, as JSON:</p>
                <p class="ml-6"><span class="text-outline">$</span> curl placehold.cloud/l?paragraphs=3</p>
            </div>
            <div>
                <p class="text-outline">Ten v7 UUIDs:</p>
                <p class="ml-6"><span class="text-outline">$</span> curl "placehold.cloud/uuid?version=7&amp;count=10"</p>
            </div>
        </div>
    </div>
</x-layout>
