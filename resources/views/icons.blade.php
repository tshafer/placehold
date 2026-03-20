<x-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">SVG Icon Library</h1>
            <p class="text-gray-600 dark:text-gray-400">Browse and download our collection of beautiful icons</p>
        </div>

        <!-- Download All Icons Button -->
        <div class="mb-8 flex justify-center">
            <a href="{{ route('download.all.icons') }}" 
               class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors shadow-lg">
                <x-heroicon-o-arrow-down-tray class="w-5 h-5 mr-2" />
                Download All Icons
            </a>
        </div>

        <div x-data="{ searchQuery: '', selectedIcon: null }">

        <!-- Search Bar -->
        <div class="mb-8">
            <div class="relative">
                <input x-model="searchQuery" type="text" placeholder="Search icons..."
                       class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                <x-heroicon-o-magnifying-glass class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" />
            </div>
        </div>

        <!-- Icons Grid -->
        <div class="grid grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-6">
            @foreach (File::files(resource_path('svg')) as $file)
                @php
                    $iconName = pathinfo($file, PATHINFO_FILENAME);
                    $svgContent = file_get_contents($file);
                    $randomBg = 'bg-gray-100 dark:bg-gray-800';
                    $randomText = 'text-gray-900 dark:text-white';
                @endphp
                <div x-show="searchQuery === '' || '{{ strtolower($iconName) }}'.includes(searchQuery.toLowerCase())" 
                     x-on:click="selectedIcon = { name: '{{ $iconName }}', content: `{{ $svgContent }}` }"
                     class="flex flex-col items-center p-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg hover:border-gray-400 dark:hover:border-gray-600 hover:shadow-lg transition-all cursor-pointer group">
                    <div class="{{ $randomBg }} rounded-lg p-4 mb-3 group-hover:scale-110 transition-transform">
                        {!! preg_replace('/<svg /', '<svg class="h-8 w-8 ' . $randomText . '" ', $svgContent) !!}
                    </div>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300 text-center">{{ $iconName }}</span>
                    <a href="{{ asset('svg/' . $iconName . '.svg') }}" download 
                       x-on:click.stop
                       class="mt-2 px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded text-xs hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                        Download
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Modal -->
        <div x-show="selectedIcon" 
             x-on:click="selectedIcon = null"
             x-transition
             class="fixed inset-0 z-50 overflow-y-auto bg-black/50 flex items-center justify-center p-4">
            <div x-on:click.stop
                 x-transition
                 class="bg-white dark:bg-gray-800 rounded-xl shadow-xl max-w-3xl w-full">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                            <span x-text="selectedIcon?.name || ''" class="font-mono text-gray-900 dark:text-white"></span>
                        </h3>
                        <button x-on:click="selectedIcon = null" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    
                    <div class="flex justify-center mb-6">
                        <div class="bg-gray-100 dark:bg-gray-900 rounded-lg p-8">
                            <div x-html="selectedIcon?.content" class="w-24 h-24 text-gray-900 dark:text-white"></div>
                        </div>
                    </div>
                    
                    <div class="relative">
                        <pre class="bg-gray-900 p-4 rounded-lg overflow-x-auto"><code x-text="selectedIcon?.content || ''" class="text-green-400 text-sm font-mono"></code></pre>
                        <button x-on:click="navigator.clipboard.writeText(selectedIcon.content); $event.target.textContent = 'Copied!'; setTimeout(() => $event.target.textContent = 'Copy', 2000)"
                                class="absolute top-2 right-2 px-3 py-1 bg-gray-900 dark:bg-gray-100 hover:bg-gray-800 dark:hover:bg-gray-200 text-white dark:text-gray-900 rounded text-sm font-medium transition-colors">
                            Copy
                        </button>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </div>
</x-layout>
