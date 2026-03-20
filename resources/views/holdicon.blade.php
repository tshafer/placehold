<x-layout>
    <div class="mb-16">
        <span class="text-tertiary font-headline font-bold text-xs tracking-[0.3em] uppercase mb-4 block">Icon Generation</span>
        <h1 class="text-5xl md:text-7xl font-headline font-extrabold tracking-tighter text-on-surface leading-none mb-4">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-tertiary">Holdicon</span> API
        </h1>
        <p class="text-on-surface-variant text-sm max-w-2xl">Create custom placeholder icons with text, robots, cats, or dogs.</p>
    </div>

    <div class="bg-surface-container-low p-6 lg:p-8">
        <div class="space-y-10">
            <section>
                <h3 class="section-title mb-8 flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">terminal</span>
                    Endpoint
                </h3>
                <div class="code-block">
                    <code class="break-all">GET {{ route('holdicon') }}</code>
                </div>
                <p class="text-on-surface-variant text-sm mt-4">Generates customizable placeholder images with optional text, icons, or animal shapes.</p>
            </section>

            <section>
                <h3 class="section-title mb-8">Parameters</h3>
                <div class="space-y-1">
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">width</span>
                        <span class="text-outline text-xs">Width in pixels (default: 128)</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">height</span>
                        <span class="text-outline text-xs">Height in pixels (default: 128)</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">background_color</span>
                        <span class="text-outline text-xs">Hex color code (default: random)</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">text</span>
                        <span class="text-outline text-xs">Text to display (default: random 2 letters)</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">robot/cat/dog</span>
                        <span class="text-outline text-xs">Generate robot, cat, or dog icon (boolean)</span>
                    </div>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Example Usage</h3>
                <div class="space-y-8">
                    <div>
                        <span class="terminal-label mb-2 block">Custom text icon</span>
                        <div class="code-block mb-4">
                            <code class="break-all">{{ route('holdicon') }}?width=200&height=200&background_color=FF0000&text_color=FFFFFF&text=AB</code>
                        </div>
                        <img src="{{ route('holdicon') }}?width=200&height=200&background_color=FF0000&text_color=FFFFFF&text=AB" alt="Example 1">
                    </div>

                    <div>
                        <span class="terminal-label mb-2 block">Robot icon</span>
                        <div class="code-block mb-4">
                            <code class="break-all">{{ route('holdicon') }}?width=150&height=150&robot=true</code>
                        </div>
                        <img src="{{ route('holdicon') }}?width=150&height=150&robot=true" alt="Example 2">
                    </div>

                    <div>
                        <span class="terminal-label mb-2 block">Cat icon</span>
                        <div class="code-block mb-4">
                            <code class="break-all">{{ route('holdicon') }}?width=180&height=180&cat=true&background_color=00FF00&text_color=000000</code>
                        </div>
                        <img src="{{ route('holdicon') }}?width=180&height=180&cat=true&background_color=00FF00&text_color=000000" alt="Example 3">
                    </div>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Rate Limiting</h3>
                <div class="bg-surface-container-lowest border-t-2 border-secondary p-4 flex items-center gap-3">
                    <span class="w-2 h-2 rounded-full bg-secondary animate-beacon-pulse"></span>
                    <p class="text-on-surface-variant text-sm">120 requests per minute</p>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Try It Now</h3>
                <a href="{{ route('holdicon') }}?width=128&height=128&text=HI" target="_blank"
                   class="liquid-chrome p-3 font-headline font-bold text-on-primary-container uppercase tracking-widest text-xs inline-flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">bolt</span>
                    Generate Holdicon
                </a>
            </section>
        </div>
    </div>
</x-layout>
