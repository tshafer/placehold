<x-layout>
    <div class="mb-16">
        <span class="text-tertiary font-headline font-bold text-xs tracking-[0.3em] uppercase mb-4 block">Asset Library</span>
        <h1 class="text-5xl md:text-7xl font-headline font-extrabold tracking-tighter text-on-surface leading-none mb-4">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-tertiary">SVG</span> Icon Library
        </h1>
        <p class="text-on-surface-variant text-sm max-w-2xl">Browse and download our collection of beautiful icons.</p>
    </div>

    <div class="mb-10 flex justify-center">
        <a href="{{ route('download.all.icons') }}"
           class="liquid-chrome p-3 font-headline font-bold text-on-primary-container uppercase tracking-widest text-xs inline-flex items-center gap-2">
            <span class="material-symbols-outlined text-base">download</span>
            Download All Icons
        </a>
    </div>

    <div x-data="{ searchQuery: '', selectedIcon: null }">

        <div class="mb-10">
            <div class="relative">
                <input x-model="searchQuery" type="text" placeholder="Search icons..."
                       class="w-full px-4 py-3 bg-surface-container-lowest border-b-2 border-outline-variant/40 text-on-surface placeholder-outline font-mono text-sm focus:border-primary focus:outline-none transition-colors">
                <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline">search</span>
            </div>
        </div>

        <div class="grid grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-4">
            @foreach (File::files(resource_path('svg')) as $file)
                @php
                    $iconName = pathinfo($file, PATHINFO_FILENAME);
                    $svgContent = file_get_contents($file);
                @endphp
                <div x-show="searchQuery === '' || '{{ strtolower($iconName) }}'.includes(searchQuery.toLowerCase())"
                     x-on:click="selectedIcon = { name: '{{ $iconName }}', content: `{{ $svgContent }}` }"
                     class="flex flex-col items-center p-4 bg-surface-container-low hover:bg-surface-container-lowest transition-all cursor-pointer group">
                    <div class="bg-surface-container-lowest p-4 mb-3 group-hover:scale-110 transition-transform">
                        {!! preg_replace('/<svg /', '<svg class="h-8 w-8 text-on-surface" ', $svgContent) !!}
                    </div>
                    <span class="text-xs text-outline text-center font-mono">{{ $iconName }}</span>
                    <a href="{{ asset('svg/' . $iconName . '.svg') }}" download
                       x-on:click.stop
                       class="mt-2 text-outline border border-outline-variant/40 hover:text-primary hover:border-primary/40 px-3 py-1 font-headline font-bold text-[10px] uppercase tracking-widest transition-all">
                        Download
                    </a>
                </div>
            @endforeach
        </div>

        <div x-show="selectedIcon"
             x-on:click="selectedIcon = null"
             x-transition
             class="fixed inset-0 z-50 overflow-y-auto bg-black/70 flex items-center justify-center p-4">
            <div x-on:click.stop
                 x-transition
                 class="bg-surface-container-low max-w-3xl w-full">
                <div class="p-6 lg:p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-headline font-bold text-on-surface uppercase tracking-widest text-sm">
                            <span x-text="selectedIcon?.name || ''" class="font-mono text-primary"></span>
                        </h3>
                        <button x-on:click="selectedIcon = null" class="text-outline hover:text-primary transition-colors">
                            <span class="material-symbols-outlined">close</span>
                        </button>
                    </div>

                    <div class="flex justify-center mb-8">
                        <div class="bg-surface-container-lowest p-8">
                            <div x-html="selectedIcon?.content" class="w-24 h-24 text-on-surface"></div>
                        </div>
                    </div>

                    <div class="relative">
                        <pre class="code-block overflow-x-auto"><code x-text="selectedIcon?.content || ''"></code></pre>
                        <button x-on:click="navigator.clipboard.writeText(selectedIcon.content); $event.target.textContent = 'Copied!'; setTimeout(() => $event.target.textContent = 'Copy', 2000)"
                                class="absolute top-2 right-2 text-outline border border-outline-variant/40 hover:text-primary hover:border-primary/40 px-4 py-2 font-headline font-bold text-xs uppercase tracking-widest transition-all">
                            Copy
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-layout>
