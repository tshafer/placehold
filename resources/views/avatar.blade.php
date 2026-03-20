<x-layout>
    <section class="mb-16">
        <span class="text-tertiary font-headline font-bold text-xs tracking-[0.3em] uppercase mb-4 block">Identity System</span>
        <h1 class="text-5xl md:text-7xl font-headline font-extrabold tracking-tighter text-on-surface leading-none mb-6">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-tertiary">Avatar</span> Generator
        </h1>
        <p class="text-on-surface-variant text-sm max-w-2xl">Generate unique 5×5 identicon avatars from any seed string—same seed always produces the same pattern and color.</p>
    </section>

    <div class="space-y-12">
        <section>
            <h3 class="section-title mb-8 flex items-center gap-3">
                <span class="material-symbols-outlined text-base">terminal</span>
                Basic Usage
            </h3>
            <div class="code-block">
                <code class="break-all">GET /avatar/{seed}</code>
            </div>
            <p class="text-on-surface-variant text-sm mt-4">Returns a deterministic SVG identicon. The seed can be any string (e.g. username or email).</p>
        </section>

        <section>
            <h3 class="section-title mb-8">Parameters</h3>
            <div class="space-y-px">
                <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                    <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">seed</span>
                    <span class="text-outline text-xs">Path parameter—any string; hashed to build the pattern and foreground color</span>
                </div>
                <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                    <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">size</span>
                    <span class="text-outline text-xs">Square size in pixels (default: 200, min: 16, max: 1024)</span>
                </div>
                <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                    <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">bg</span>
                    <span class="text-outline text-xs">Background hex color without # (default: f0f0f0)</span>
                </div>
                <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                    <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">format</span>
                    <span class="text-outline text-xs">Output format (default: svg; only svg is supported)</span>
                </div>
            </div>
        </section>

        <section>
            <h3 class="section-title mb-8">Preview</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-6">
                @foreach (['alice', 'bob', 'charlie', 'dave', 'eve', 'frank'] as $exampleSeed)
                    <div class="flex flex-col items-center gap-3">
                        <div class="bg-surface-container-low p-3">
                            <img
                                src="{{ route('avatar.show', ['seed' => $exampleSeed]) }}?size=120"
                                alt="Avatar for {{ $exampleSeed }}"
                                width="120"
                                height="120"
                            />
                        </div>
                        <span class="meta-label">{{ $exampleSeed }}</span>
                    </div>
                @endforeach
            </div>
        </section>

        <section>
            <h3 class="section-title mb-8">Rate Limiting</h3>
            <div class="bg-surface-container-low p-6 flex items-start gap-3">
                <span class="material-symbols-outlined text-secondary text-lg mt-0.5">speed</span>
                <p class="text-on-surface-variant text-sm">This endpoint is rate-limited to <span class="text-secondary font-bold">120 requests per minute</span> to ensure fair usage.</p>
            </div>
        </section>

        <section>
            <h3 class="section-title mb-8">Try It Now</h3>
            <a href="{{ route('avatar.show', ['seed' => 'placehold.cloud']) }}?size=256" target="_blank"
               class="liquid-chrome p-3 font-headline font-bold text-on-primary-container uppercase tracking-widest text-xs inline-flex items-center gap-2">
                <span class="material-symbols-outlined text-base">bolt</span>
                Open sample avatar
            </a>
        </section>
    </div>
</x-layout>
