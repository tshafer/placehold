<x-layout>
    <div x-cloak x-data="{ selectedIcon: null, searchQuery: '' }" class="container mx-auto px-4 py-12 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 shadow-2xl rounded-3xl">
        <h1 class="text-6xl font-extrabold mb-8 text-center text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-pink-300">Holdicon SVG Icons</h1>

        <!-- Download All Icons Button -->
        <div class="flex justify-center mb-8">
            <a href="{{ route('download.all.icons') }}" class="text-white px-6 py-3 bg-gradient-to-r from-neon-blue to-neon-purple rounded-full text-lg font-bold hover:from-neon-purple hover:to-neon-blue transition-all duration-300 shadow-neon flex items-center space-x-3 group relative overflow-hidden">
                <span class="absolute inset-0 bg-white/20 transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700 ease-out"></span>
                <svg class="w-6 h-6 relative z-10 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                <span class="relative z-10 group-hover:animate-pulse">DOWNLOAD ALL ICONS</span>
            </a>
        </div>

        <!-- Search Bar -->
        <div class="mb-8 relative group">
            <input x-model="searchQuery" type="text" placeholder="Search icons..."
                class="w-full px-4 py-2 rounded-full bg-white/10 text-white placeholder-white/50 border-2 border-white/30 focus:outline-none focus:border-neon-blue transition-all duration-300 shadow-neon group-hover:shadow-neon-lg"
                x-on:input="searchQuery = $event.target.value.toLowerCase()"
                x-on:focus="$el.classList.add('animate-glow')"
                x-on:blur="$el.classList.remove('animate-glow')">
            <div class="absolute inset-0 bg-gradient-to-r from-neon-blue via-neon-purple to-neon-pink opacity-0 group-hover:opacity-20 rounded-full transition-opacity duration-300 pointer-events-none animate-gradient-x"></div>
            <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-6 h-6 text-white/50 group-hover:text-white transition-all duration-300 pointer-events-none animate-float" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>

        <div class="grid grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-8">
            @php
                $colors = ['text-neon-pink', 'text-neon-blue', 'text-neon-green', 'text-neon-yellow', 'text-neon-purple', 'text-neon-orange', 'text-neon-red', 'text-neon-cyan'];
                $bgColors = [
                    'bg-gradient-to-br from-purple-800 to-indigo-900',
                    'bg-gradient-to-br from-pink-800 to-red-900',
                    'bg-gradient-to-br from-blue-800 to-teal-900',
                    'bg-gradient-to-br from-green-800 to-yellow-900',
                    'bg-gradient-to-br from-orange-800 to-pink-900'
                ];
            @endphp
            @foreach (File::files(resource_path('svg')) as $file)
                @php
                    $iconName = pathinfo($file, PATHINFO_FILENAME);
                    $svgContent = file_get_contents($file);
                    $randomColor = $colors[array_rand($colors)];
                    $randomBgColor = $bgColors[array_rand($bgColors)];
                @endphp
                <div x-show="searchQuery === '' || '{{ strtolower($iconName) }}'.includes(searchQuery.toLowerCase())" class="flex flex-col items-center group cursor-pointer transform transition duration-300 hover:scale-110" @click="selectedIcon = { name: '{{ $iconName }}', content: `{{ $svgContent }}` }">
                    <div class="{{ $randomBgColor }} rounded-xl p-4 shadow-neon transition-all duration-300 group-hover:shadow-neon-lg group-hover:rotate-6">
                        {!! preg_replace('/<svg /', '<svg class="h-12 w-12 transition-all duration-300 ' . $randomColor . ' group-hover:animate-pulse" ', $svgContent) !!}
                    </div>
                    <span class="mt-3 text-sm font-bold transition-all duration-300 group-hover:text-{{ $randomColor }} group-hover:translate-y-1 font-retro text-white tracking-widest">{{ strtoupper($iconName) }}</span>
                    <a href="{{ asset('svg/' . $iconName . '.svg') }}" download class="text-white/80 mt-2 px-4 py-2 bg-gradient-to-r from-{{ $randomColor }} to-neon-blue rounded-full text-xs font-bold text-black hover:from-neon-blue hover:to-{{ $randomColor }} transition-all duration-300 group-hover:animate-pulse shadow-neon flex items-center space-x-2" @click.stop>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        <span>DOWNLOAD</span>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Additional Icons -->
        <!-- <div class="mt-12">
            <h2 class="text-4xl font-bold mb-6 text-center text-white">More Icons</h2>
            <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
                <div x-show="searchQuery === '' || 'mail'.includes(searchQuery.toLowerCase())" class="flex flex-col items-center group cursor-pointer transform transition duration-300 hover:scale-105" @click="selectedIcon = { name: 'Mail', content: `<svg class='h-10 w-10 text-lime-300 transition-all duration-300 group-hover:animate-bounce' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z' /></svg>` }">
                    <div class="bg-black/30 rounded-lg p-3 shadow-inner transition-all duration-300 group-hover:shadow-lg group-hover:scale-110 group-hover:rotate-3">
                        <svg class="h-10 w-10 text-lime-300 transition-all duration-300 group-hover:animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span class="mt-2 text-sm font-semibold transition-all duration-300 group-hover:text-white/90 group-hover:translate-y-1 font-sans text-white/70">MAIL</span>
                </div>
            </div>
        </div> -->



        <!-- Modal -->
        <div x-show="selectedIcon" x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 overflow-y-auto"
        aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gradient-to-br from-purple-800 to-pink-600 bg-opacity-75 transition-opacity"
                aria-hidden="true" @click="$refs.modal.classList.add('opacity-0', 'scale-95'); setTimeout(() => selectedIcon = null, 200)"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="selectedIcon" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block align-bottom bg-black rounded-lg text-left overflow-hidden shadow-neon transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full border-4 border-neon-pink"
                x-ref="modal">
                    <div class="bg-gradient-to-r from-neon-blue to-neon-purple px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-2xl leading-6 font-bold text-white font-retro tracking-widest" id="modal-title">
                                    SVG Code for <span x-text="selectedIcon?.name || ''" class="text-neon-yellow"></span>
                                </h3>
                                <div class="mt-4 flex justify-center mb-4">
                                    <div class="w-24 h-24 bg-gradient-to-r from-neon-blue to-neon-purple rounded-lg flex items-center justify-center p-4">
                                        <div x-html="selectedIcon?.content" class="w-full h-full text-white"></div>
                                    </div>
                                </div>
                                <div class="mt-4 relative">
                                    <pre class="text-sm text-neon-green bg-black p-4 rounded-md overflow-x-auto border-2 border-neon-cyan text-wrap leading-relaxed"><code x-text="selectedIcon?.content || ''"></code></pre>
                                    <button @click="if (selectedIcon) { navigator.clipboard.writeText(selectedIcon.content); $el.textContent = 'Copied!'; setTimeout(() => $el.textContent = 'Copy', 2000) }"
                                    class="text-neon-blue absolute top-2 right-2 px-3 py-1 rounded-full text-xs font-bold hover:bg-neon-yellow transition-all duration-300 shadow-neon z-10">
                                        Copy
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gradient-to-r from-neon-purple to-neon-pink px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" @click="$refs.modal.classList.add('opacity-0', 'scale-95'); setTimeout(() => { selectedIcon = null; $refs.modal.classList.remove('opacity-0', 'scale-95'); }, 200)"
                        class="w-full inline-flex justify-center rounded-md border-4 border-neon-pink shadow-neon-blue px-6 py-3 bg-gradient-to-r from-neon-purple to-neon-blue text-xl font-bold text-white hover:from-neon-blue hover:to-neon-purple focus:outline-none focus:ring-4 focus:ring-offset-4 focus:ring-neon-yellow sm:ml-3 sm:w-auto transition-all duration-300 font-retro tracking-widest uppercase transform hover:scale-105">
                            <span class="mr-2">&#9733;</span>CLOSE<span class="ml-2">&#9733;</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
