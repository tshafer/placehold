<header x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }"
        :class="{ 'bg-white bg-opacity-10': !darkMode, 'bg-gray-900 bg-opacity-50': darkMode }"
        class="w-full backdrop-blur-md border-b border-white border-opacity-20 py-4 sticky top-0 z-10 transition-colors duration-300">
            <div class="container mx-auto px-4 flex justify-between items-center">
                <a href="/" class="text-2xl font-bold flex items-center" :class="{ 'text-white': !darkMode, 'text-gray-200': darkMode }">
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
                    <span class="text-2xl tracking-wide font-vt323 font-bold neon-text">placehold.cloud</span>
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
                                'icons' => '/icons',
                                'contact' => '/contact',
                            ];
                        @endphp
                        @foreach ($pages as $name => $url)
                            <li>
                                <a href="{{ $url }}" class="menu-item flex items-center transition-all duration-300 neon-text"
                                   :class="{ 'hover:text-yellow-300': !darkMode, 'hover:text-yellow-200': darkMode,
                                             'text-yellow-300': (!darkMode && '{{ $currentRoute }}' === '{{ $name }}'),
                                             'text-yellow-200': (darkMode && '{{ $currentRoute }}' === '{{ $name }}'),
                                             'text-white': (!darkMode && '{{ $currentRoute }}' !== '{{ $name }}'),
                                             'text-gray-300': (darkMode && '{{ $currentRoute }}' !== '{{ $name }}') }"
                                   :class="{'font-bold scale-120': '{{ $currentRoute }}' === '{{ $name }}'}">
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
                                        @case('icons')
                                            <svg class="w-6 h-6 mr-2 transition-transform duration-300 group-hover:animate-bounce" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="2" y="2" width="20" height="20" rx="2" ry="2"/>
                                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                                <circle cx="15.5" cy="8.5" r="1.5"/>
                                                <circle cx="12" cy="15.5" r="1.5"/>
                                                <path d="M20 14.5v2a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2"/>
                                            </svg>
                                            @break
                                        @case('contact')
                                            <svg class="w-6 h-6 mr-2 transition-transform duration-300 group-hover:animate-bounce" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
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
