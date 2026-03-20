
<header class="w-full bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <a href="/" class="flex items-center space-x-3 group">
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
            <nav class="hidden md:flex items-center space-x-8">
                @php
                    $currentRoute = request()->path();
                    $pages = [
                        'image' => [
                            'url' => '/image',
                            'name' => 'Images',
                            'icon' => svg('heroicon-o-photo', 'w-4 h-4')->toHtml(),
                        ],
                        'lorem-ipsum' => [
                            'url' => '/lorem-ipsum',
                            'name' => 'Text',
                            'icon' => svg('heroicon-o-document-text', 'w-4 h-4')->toHtml(),
                        ],
                        'quotes' => [
                            'url' => '/quotes',
                            'name' => 'Quotes',
                            'icon' => svg('heroicon-o-chat-bubble-left', 'w-4 h-4')->toHtml(),
                        ],
                        'jokes' => [
                            'url' => '/jokes',
                            'name' => 'Jokes',
                            'icon' => svg('heroicon-o-face-smile', 'w-4 h-4')->toHtml(),
                        ],
                        'weather' => [
                            'url' => '/weather',
                            'name' => 'Weather',
                            'icon' => svg('heroicon-o-cloud', 'w-4 h-4')->toHtml(),
                        ],
                        'recipes' => [
                            'url' => '/recipes',
                            'name' => 'Recipes',
                            'icon' => svg('heroicon-o-book-open', 'w-4 h-4')->toHtml(),
                        ],
                        'colors' => [
                            'url' => '/colors',
                            'name' => 'Colors',
                            'icon' => svg('heroicon-o-paint-brush', 'w-4 h-4')->toHtml(),
                        ],
                        'api' => [
                            'url' => '/api',
                            'name' => 'API',
                            'icon' => svg('heroicon-o-command-line', 'w-4 h-4')->toHtml(),
                        ],
                    ];
                @endphp

                @foreach($pages as $name => $data)
                    <a href="{{ $data['url'] }}"
                       class="text-sm font-medium transition-colors {{ $currentRoute === $name ? 'text-primary-600 dark:text-primary-400' : 'text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white' }} flex items-center gap-2">
                        {!! $data['icon'] !!}
                        {{ $data['name'] }}
                    </a>
                @endforeach
            </nav>

            <!-- Right side actions -->
            <div class="flex items-center space-x-4">
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
                    <x-heroicon-o-bars-3 class="w-6 h-6" />
                </button>
            </div>
        </div>

        <!-- Mobile menu -->
        <div x-show="mobileMenuOpen" x-transition
             class="md:hidden border-t border-gray-200 dark:border-gray-800 py-4">
            <nav class="flex flex-col space-y-2">
                <a href="/" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg flex items-center gap-2">
                    <x-heroicon-o-home class="w-4 h-4" />
                    Home
                </a>
                @foreach($pages as $name => $data)
                    <a href="{{ $data['url'] }}"
                       class="px-4 py-2 text-sm font-medium {{ $currentRoute === $name ? 'text-primary-600 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }} rounded-lg flex items-center gap-2">
                        {!! $data['icon'] !!}
                        {{ $data['name'] }}
                    </a>
                @endforeach
            </nav>
        </div>
    </div>
</header>

@if(session('success'))
    <div class="fixed top-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50">
        {{ session('success') }}
    </div>
@endif
