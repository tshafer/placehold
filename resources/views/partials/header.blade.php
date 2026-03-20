
@php
    $currentRoute = request()->path();

    $generators = [
        ['url' => '/image', 'name' => 'Image Placeholder', 'desc' => 'Custom sizes, colors & text', 'icon' => 'photo'],
        ['url' => '/avatar', 'name' => 'Avatar Generator', 'desc' => 'Unique identicons from any seed', 'icon' => 'user-circle'],
        ['url' => '/qrcode', 'name' => 'QR Codes', 'desc' => 'Encode any URL or text', 'icon' => 'qr-code'],
        ['url' => '/favicon-generator', 'name' => 'Favicon Generator', 'desc' => 'Letter & emoji favicons', 'icon' => 'star'],
        ['url' => '/pdf-generator', 'name' => 'PDF Placeholder', 'desc' => 'Dummy PDFs with lorem ipsum', 'icon' => 'document'],
        ['url' => '/video-generator', 'name' => 'Video Placeholder', 'desc' => 'Static-color MP4 files', 'icon' => 'film'],
        ['url' => '/holdicon', 'name' => 'Icon Placeholders', 'desc' => 'Placeholder icons with styling', 'icon' => 'view-columns'],
        ['url' => '/icons', 'name' => 'Icon Library', 'desc' => 'Browse & download icons', 'icon' => 'paint-brush'],
    ];

    $dataApis = [
        ['url' => '/lorem-ipsum', 'name' => 'Lorem Ipsum', 'desc' => 'Dummy text for layouts', 'icon' => 'document-text'],
        ['url' => '/markdown-generator', 'name' => 'Markdown', 'desc' => 'Realistic markdown docs', 'icon' => 'hashtag'],
        ['url' => '/csv-generator', 'name' => 'CSV / Data', 'desc' => 'Fake tabular data (CSV/JSON)', 'icon' => 'table-cells'],
        ['url' => '/json-placeholder', 'name' => 'JSON Placeholder', 'desc' => 'Fake REST API data', 'icon' => 'code-bracket'],
        ['url' => '/colors', 'name' => 'Color Palettes', 'desc' => 'Palettes & hex codes', 'icon' => 'paint-brush'],
        ['url' => '/quotes', 'name' => 'Random Quotes', 'desc' => 'Inspirational quotes', 'icon' => 'chat-bubble-left'],
        ['url' => '/jokes', 'name' => 'Random Jokes', 'desc' => 'Programming & dad jokes', 'icon' => 'face-smile'],
        ['url' => '/weather', 'name' => 'Weather Data', 'desc' => 'Real-time weather info', 'icon' => 'cloud'],
        ['url' => '/recipes', 'name' => 'Random Recipes', 'desc' => 'Discover cooking ideas', 'icon' => 'book-open'],
    ];
@endphp

<header class="w-full bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <a href="/" class="flex items-center space-x-3 group shrink-0">
                <svg width="32" height="32" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" class="group-hover:scale-110 transition-transform">
                    <rect width="40" height="40" rx="8" class="fill-gray-900 dark:fill-white"/>
                    <path d="M20 8L28 16H12L20 8Z" class="fill-white dark:fill-gray-900"/>
                    <path d="M8 20L16 28V12L8 20Z" class="fill-white dark:fill-gray-900"/>
                    <path d="M32 20L24 28V12L32 20Z" class="fill-white dark:fill-gray-900"/>
                    <path d="M20 32L28 24H12L20 32Z" class="fill-white dark:fill-gray-900"/>
                </svg>
                <span class="text-2xl font-bold text-gray-900 dark:text-white">placehold.cloud</span>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center space-x-1">
                {{-- Generators Dropdown --}}
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button @click="open = !open"
                            class="inline-flex items-center gap-1.5 px-3 py-2 text-sm font-medium rounded-lg transition-colors text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-800">
                        <x-heroicon-o-squares-2x2 class="w-4 h-4" />
                        Generators
                        <x-heroicon-o-chevron-down class="w-3.5 h-3.5 transition-transform" ::class="open && 'rotate-180'" />
                    </button>

                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute left-0 top-full pt-2 w-72"
                         x-cloak>
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl border border-gray-200 dark:border-gray-700 p-2 ring-1 ring-black/5 dark:ring-white/5">
                            @foreach($generators as $item)
                                <a href="{{ $item['url'] }}"
                                   class="flex items-start gap-3 px-3 py-2.5 rounded-lg transition-colors {{ $currentRoute === ltrim($item['url'], '/') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-600 dark:text-primary-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50' }}">
                                    <span class="mt-0.5 shrink-0">
                                        @switch($item['icon'])
                                            @case('photo') <x-heroicon-o-photo class="w-5 h-5" /> @break
                                            @case('user-circle') <x-heroicon-o-user-circle class="w-5 h-5" /> @break
                                            @case('qr-code') <x-heroicon-o-qr-code class="w-5 h-5" /> @break
                                            @case('star') <x-heroicon-o-star class="w-5 h-5" /> @break
                                            @case('document') <x-heroicon-o-document class="w-5 h-5" /> @break
                                            @case('film') <x-heroicon-o-film class="w-5 h-5" /> @break
                                            @case('view-columns') <x-heroicon-o-view-columns class="w-5 h-5" /> @break
                                            @case('paint-brush') <x-heroicon-o-paint-brush class="w-5 h-5" /> @break
                                        @endswitch
                                    </span>
                                    <span>
                                        <span class="block text-sm font-medium">{{ $item['name'] }}</span>
                                        <span class="block text-xs text-gray-500 dark:text-gray-400">{{ $item['desc'] }}</span>
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Data APIs Dropdown --}}
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button @click="open = !open"
                            class="inline-flex items-center gap-1.5 px-3 py-2 text-sm font-medium rounded-lg transition-colors text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-800">
                        <x-heroicon-o-circle-stack class="w-4 h-4" />
                        Data APIs
                        <x-heroicon-o-chevron-down class="w-3.5 h-3.5 transition-transform" ::class="open && 'rotate-180'" />
                    </button>

                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute left-0 top-full pt-2 w-72"
                         x-cloak>
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl border border-gray-200 dark:border-gray-700 p-2 ring-1 ring-black/5 dark:ring-white/5">
                            @foreach($dataApis as $item)
                                <a href="{{ $item['url'] }}"
                                   class="flex items-start gap-3 px-3 py-2.5 rounded-lg transition-colors {{ $currentRoute === ltrim($item['url'], '/') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-600 dark:text-primary-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50' }}">
                                    <span class="mt-0.5 shrink-0">
                                        @switch($item['icon'])
                                            @case('document-text') <x-heroicon-o-document-text class="w-5 h-5" /> @break
                                            @case('hashtag') <x-heroicon-o-hashtag class="w-5 h-5" /> @break
                                            @case('table-cells') <x-heroicon-o-table-cells class="w-5 h-5" /> @break
                                            @case('code-bracket') <x-heroicon-o-code-bracket class="w-5 h-5" /> @break
                                            @case('paint-brush') <x-heroicon-o-paint-brush class="w-5 h-5" /> @break
                                            @case('chat-bubble-left') <x-heroicon-o-chat-bubble-left class="w-5 h-5" /> @break
                                            @case('face-smile') <x-heroicon-o-face-smile class="w-5 h-5" /> @break
                                            @case('cloud') <x-heroicon-o-cloud class="w-5 h-5" /> @break
                                            @case('book-open') <x-heroicon-o-book-open class="w-5 h-5" /> @break
                                        @endswitch
                                    </span>
                                    <span>
                                        <span class="block text-sm font-medium">{{ $item['name'] }}</span>
                                        <span class="block text-xs text-gray-500 dark:text-gray-400">{{ $item['desc'] }}</span>
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- API Docs (direct link) --}}
                <a href="/api"
                   class="inline-flex items-center gap-1.5 px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ $currentRoute === 'api' ? 'text-primary-600 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20' : 'text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                    <x-heroicon-o-command-line class="w-4 h-4" />
                    API Docs
                </a>

                {{-- About --}}
                <a href="/about-us"
                   class="inline-flex items-center gap-1.5 px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ $currentRoute === 'about-us' ? 'text-primary-600 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20' : 'text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                    <x-heroicon-o-information-circle class="w-4 h-4" />
                    About
                </a>
            </nav>

            <!-- Right side actions -->
            <div class="flex items-center space-x-2">
                <form action="{{ route('toggle-dark-mode') }}" method="POST" class="hidden md:block">
                    @csrf
                    <button type="submit" class="p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                        @if(Cookie::get('darkMode', 'false') === 'false')
                            <x-heroicon-o-moon class="w-5 h-5" />
                        @else
                            <x-heroicon-o-sun class="w-5 h-5" />
                        @endif
                    </button>
                </form>

                <!-- Mobile menu button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="md:hidden p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                    <template x-if="!mobileMenuOpen"><x-heroicon-o-bars-3 class="w-6 h-6" /></template>
                    <template x-if="mobileMenuOpen"><x-heroicon-o-x-mark class="w-6 h-6" /></template>
                </button>
            </div>
        </div>

        <!-- Mobile menu -->
        <div x-show="mobileMenuOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="md:hidden border-t border-gray-200 dark:border-gray-800 py-4 max-h-[calc(100vh-4rem)] overflow-y-auto"
             x-cloak>
            <nav class="space-y-6">
                <a href="/"
                   class="flex items-center gap-3 px-4 py-2 text-sm font-medium rounded-lg {{ $currentRoute === '/' ? 'text-primary-600 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                    <x-heroicon-o-home class="w-5 h-5" />
                    Home
                </a>

                {{-- Generators group --}}
                <div>
                    <p class="px-4 text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-2">Generators</p>
                    <div class="space-y-0.5">
                        @foreach($generators as $item)
                            <a href="{{ $item['url'] }}"
                               class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium rounded-lg {{ $currentRoute === ltrim($item['url'], '/') ? 'text-primary-600 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                                <span class="shrink-0">
                                    @switch($item['icon'])
                                        @case('photo') <x-heroicon-o-photo class="w-5 h-5" /> @break
                                        @case('user-circle') <x-heroicon-o-user-circle class="w-5 h-5" /> @break
                                        @case('qr-code') <x-heroicon-o-qr-code class="w-5 h-5" /> @break
                                        @case('star') <x-heroicon-o-star class="w-5 h-5" /> @break
                                        @case('document') <x-heroicon-o-document class="w-5 h-5" /> @break
                                        @case('film') <x-heroicon-o-film class="w-5 h-5" /> @break
                                        @case('view-columns') <x-heroicon-o-view-columns class="w-5 h-5" /> @break
                                        @case('paint-brush') <x-heroicon-o-paint-brush class="w-5 h-5" /> @break
                                    @endswitch
                                </span>
                                {{ $item['name'] }}
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Data APIs group --}}
                <div>
                    <p class="px-4 text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-2">Data APIs</p>
                    <div class="space-y-0.5">
                        @foreach($dataApis as $item)
                            <a href="{{ $item['url'] }}"
                               class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium rounded-lg {{ $currentRoute === ltrim($item['url'], '/') ? 'text-primary-600 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                                <span class="shrink-0">
                                    @switch($item['icon'])
                                        @case('document-text') <x-heroicon-o-document-text class="w-5 h-5" /> @break
                                        @case('hashtag') <x-heroicon-o-hashtag class="w-5 h-5" /> @break
                                        @case('table-cells') <x-heroicon-o-table-cells class="w-5 h-5" /> @break
                                        @case('code-bracket') <x-heroicon-o-code-bracket class="w-5 h-5" /> @break
                                        @case('paint-brush') <x-heroicon-o-paint-brush class="w-5 h-5" /> @break
                                        @case('chat-bubble-left') <x-heroicon-o-chat-bubble-left class="w-5 h-5" /> @break
                                        @case('face-smile') <x-heroicon-o-face-smile class="w-5 h-5" /> @break
                                        @case('cloud') <x-heroicon-o-cloud class="w-5 h-5" /> @break
                                        @case('book-open') <x-heroicon-o-book-open class="w-5 h-5" /> @break
                                    @endswitch
                                </span>
                                {{ $item['name'] }}
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Bottom links --}}
                <div class="border-t border-gray-200 dark:border-gray-700 pt-4 space-y-0.5">
                    <a href="/api"
                       class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium rounded-lg {{ $currentRoute === 'api' ? 'text-primary-600 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                        <x-heroicon-o-command-line class="w-5 h-5" />
                        API Docs
                    </a>
                    <a href="/about-us"
                       class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium rounded-lg {{ $currentRoute === 'about-us' ? 'text-primary-600 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                        <x-heroicon-o-information-circle class="w-5 h-5" />
                        About
                    </a>
                    <a href="/contact"
                       class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium rounded-lg {{ $currentRoute === 'contact' ? 'text-primary-600 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                        <x-heroicon-o-envelope class="w-5 h-5" />
                        Contact
                    </a>

                    <form action="{{ route('toggle-dark-mode') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg">
                            @if(Cookie::get('darkMode', 'false') === 'false')
                                <x-heroicon-o-moon class="w-5 h-5" />
                                Dark Mode
                            @else
                                <x-heroicon-o-sun class="w-5 h-5" />
                                Light Mode
                            @endif
                        </button>
                    </form>
                </div>
            </nav>
        </div>
    </div>
</header>

@if(session('success'))
    <div class="fixed top-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50">
        {{ session('success') }}
    </div>
@endif
