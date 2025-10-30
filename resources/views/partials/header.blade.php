
<header class="w-full bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 sticky top-0 z-50">
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
                        'image' => ['url' => '/image', 'name' => 'Images'],
                        'lorem-ipsum' => ['url' => '/lorem-ipsum', 'name' => 'Text'],
                        'quotes' => ['url' => '/quotes', 'name' => 'Quotes'],
                        'jokes' => ['url' => '/jokes', 'name' => 'Jokes'],
                        'api' => ['url' => '/api', 'name' => 'API'],
                    ];
                @endphp

                @foreach($pages as $name => $data)
                    <a href="{{ $data['url'] }}"
                       class="text-sm font-medium transition-colors {{ $currentRoute === $name ? 'text-primary-600 dark:text-primary-400' : 'text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white' }}">
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
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                            </svg>
                        @else
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        @endif
                    </button>
                </form>

                <!-- Mobile menu button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="md:hidden p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile menu -->
        <div x-data="{ mobileMenuOpen: false }" x-show="mobileMenuOpen" x-transition
             class="md:hidden border-t border-gray-200 dark:border-gray-800 py-4">
            <nav class="flex flex-col space-y-2">
                <a href="/" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg">Home</a>
                @foreach($pages as $name => $data)
                    <a href="{{ $data['url'] }}"
                       class="px-4 py-2 text-sm font-medium {{ $currentRoute === $name ? 'text-primary-600 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }} rounded-lg">
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
