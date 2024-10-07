
<header
        x-data="{ mobileMenuOpen: false }"
        class="w-full backdrop-blur-md border-b border-white border-opacity-20 py-4 sticky top-0 z-10 transition-colors duration-300 bg-white bg-opacity-10 dark:bg-gray-900 dark:bg-opacity-50">
    <div class="container mx-auto px-4 flex justify-between items-center">
        <a href="/" class="text-3xl font-bold flex items-center text-white dark:text-gray-100">
            <svg width="48" height="48" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2 hover:animate-[logoSpinTakeoff_0.5s_linear_infinite]">
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
            <span class="text-3xl tracking-wide font-vt323 font-bold neon-text text-white dark:text-gray-100">placehold.cloud</span>
        </a>
        <nav class="hidden lg:flex items-center">
            <div x-data="{ isOpen: false }" class="relative">
                <button @click="isOpen = !isOpen" class="flex items-center space-x-2 text-white hover:text-yellow-300 transition-colors duration-300 text-xl">
                    <span>Menu</span>
                    <svg :class="{'rotate-180': isOpen}" class="w-6 h-6 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>

                <div x-cloak x-show="isOpen" @click.away="isOpen = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95" class="absolute right-0 mt-2 w-[80vw] max-w-4xl bg-white dark:bg-gray-800 rounded-lg shadow-lg py-2 z-20">
                    @php
                        $currentRoute = request()->path();
                        $pages = [
                            'image' => ['url' => '/image', 'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>', 'description' => 'Generate custom placeholder images'],
                            'lorem-ipsum' => ['url' => '/lorem-ipsum', 'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>', 'description' => 'Create dummy text for your designs'],
                            'quotes' => ['url' => '/quotes', 'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>', 'description' => 'Get inspirational quotes'],
                            'jokes' => ['url' => '/jokes', 'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>', 'description' => 'Enjoy some humor with random jokes'],
                            'weather' => ['url' => '/weather', 'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>', 'description' => 'Check current weather conditions'],
                            'recipes' => ['url' => '/recipes', 'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>', 'description' => 'Discover delicious recipes'],
                            'holdicon' => ['url' => '/holdicon', 'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path></svg>', 'description' => 'Create custom icon placeholders'],
                            'icons' => ['url' => '/icons', 'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>', 'description' => 'Browse our icon collection'],
                            'contact' => ['url' => '/contact', 'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>', 'description' => 'Get in touch with us'],
                        ];
                    @endphp
                    <div class="grid grid-cols-3 gap-4 p-4">
                        @foreach ($pages as $name => $data)
                            <a href="{{ $data['url'] }}" class="group flex flex-col items-center justify-center p-4 rounded-lg transition-all duration-300"
                               :class="{
                                   'bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-lg scale-105': '{{ $currentRoute }}' === '{{ $name }}',
                                   'bg-gray-100 text-gray-800 hover:bg-gray-200 hover:shadow-md hover:scale-102': '{{ $currentRoute }}' !== '{{ $name }}' && '{{ Cookie::get('darkMode', 'false') }}' === 'false',
                                   'bg-gray-800 text-gray-200 hover:bg-gray-700 hover:shadow-md hover:scale-102': '{{ $currentRoute }}' !== '{{ $name }}' && '{{ Cookie::get('darkMode', 'false') }}' === 'true'
                               }">
                                <div class="flex-shrink-0 w-14 h-14 flex items-center justify-center bg-gradient-to-br from-indigo-500 to-purple-500 rounded-full mb-3 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300 shadow-md">
                                    <div class="flex items-center justify-center w-full h-full text-white group-hover:text-indigo-200 transition-colors duration-300">
                                        {!! $data['icon'] !!}
                                    </div>
                                </div>
                                <h3 class="font-bold text-lg mb-1 text-center transition-colors duration-300 neon-text" :class="{ 'group-hover:text-gray-900': '{{ Cookie::get('darkMode', 'false') }}' === 'false', 'group-hover:text-gray-100': '{{ Cookie::get('darkMode', 'false') }}' === 'true' }">{{ ucfirst($name) }}</h3>
                                <p class="text-lg text-center transition-colors duration-300"
                                   :class="{
                                       'text-white': '{{ $currentRoute }}' === '{{ $name }}',
                                       'text-gray-600 group-hover:text-gray-800': '{{ $currentRoute }}' !== '{{ $name }}' && '{{ Cookie::get('darkMode', 'false') }}' === 'false',
                                       'text-gray-400 group-hover:text-gray-200': '{{ $currentRoute }}' !== '{{ $name }}' && '{{ Cookie::get('darkMode', 'false') }}' === 'true'
                                   }">
                                    {{ $data['description'] }}
                                </p>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <form action="{{ route('toggle-dark-mode') }}" method="POST" class="ml-4">
                @csrf
                <button type="submit" class="p-2 rounded-full transition-colors duration-300 bg-white/10 dark:bg-gray-900/50 hover:bg-gray-400 hover:bg-gray-600">
                    @if(Cookie::get('darkMode', 'false') === 'false')
                        <svg class="w-7 h-7 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                    @else
                        <svg class="w-7 h-7 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    @endif
                </button>
            </form>
        </nav>
        <div class="lg:hidden flex items-center">
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-white focus:outline-none">
                <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
    </div>
    <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90" class="lg:hidden absolute top-full left-0 right-0 bg-gray-900 bg-opacity-95 backdrop-blur-md">
        <ul class="px-4 py-2 space-y-2">
            @foreach ($pages as $name => $data)
                <li>
                    <a href="{{ $data['url'] }}" class="flex items-center py-2 px-3 rounded-lg text-white hover:text-yellow-300 transition-colors duration-300 group text-lg hover:bg-white/10 dark:hover:bg-gray-700" >
                        {!! $data['icon'] !!}
                        <span>{{ ucfirst($name) }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="px-4 py-2">
            <form action="{{ route('toggle-dark-mode') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left py-2 text-white hover:text-yellow-300 transition-colors duration-300 text-lg">
                    @if(Cookie::get('darkMode', 'false') === 'false')
                        Switch to Dark Mode
                    @else
                        Switch to Light Mode
                    @endif
                </button>
            </form>
        </div>
    </div>
</header>
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 relative" role="alert">
        {{ session('success') }}
    </div>
@endif
