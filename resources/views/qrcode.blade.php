<x-layout>
    <section class="mb-16">
        <span class="text-tertiary font-headline font-bold text-xs tracking-[0.3em] uppercase mb-4 block">Encoding System</span>
        <h1 class="text-5xl md:text-7xl font-headline font-extrabold tracking-tighter text-on-surface leading-none mb-6">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-tertiary">QR Code</span> Generator
        </h1>
        <p class="text-on-surface-variant text-sm max-w-2xl">Generate QR codes as SVG or PNG via a simple HTTP API—embed them in apps, docs, or print layouts.</p>
    </section>

    <div class="space-y-12">
        <section>
            <h3 class="section-title mb-8 flex items-center gap-3">
                <span class="material-symbols-outlined text-base">terminal</span>
                Basic Usage
            </h3>
            <div class="code-block">
                <code class="break-all">GET {{ url('/qr') }}?data=https://placehold.cloud&amp;size=300&amp;format=svg</code>
            </div>
            <p class="text-on-surface-variant text-sm mt-4">
                Returns an SVG by default. Add <code class="font-mono text-xs text-tertiary bg-surface-container-lowest px-1.5 py-0.5">format=png</code> for a raster image (requires GD).
            </p>
        </section>

        <section>
            <h3 class="section-title mb-8">Query Parameters</h3>
            <div class="space-y-px">
                <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                    <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">data</span>
                    <span class="text-outline text-xs">Content to encode (required, max 2048 characters)</span>
                </div>
                <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                    <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">size</span>
                    <span class="text-outline text-xs">Output size in pixels (50–1024, default: 300)</span>
                </div>
                <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                    <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">format</span>
                    <span class="text-outline text-xs"><code class="font-mono">svg</code> or <code class="font-mono">png</code> (default: svg)</span>
                </div>
                <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                    <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">fg</span>
                    <span class="text-outline text-xs">Foreground (module) color, 6-digit hex without # (default: 000000)</span>
                </div>
                <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                    <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">bg</span>
                    <span class="text-outline text-xs">Background color, 6-digit hex without # (default: ffffff)</span>
                </div>
                <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                    <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">margin</span>
                    <span class="text-outline text-xs">Quiet zone in modules (0–10, default: 2)</span>
                </div>
                <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                    <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">ecc</span>
                    <span class="text-outline text-xs">Error correction: L, M, Q, or H (default: M)</span>
                </div>
            </div>
        </section>

        <section x-data="{ input: 'https://placehold.cloud' }">
            <h3 class="section-title mb-8">Live Preview</h3>
            <label for="qr-input" class="terminal-label mb-2 block">URL or text</label>
            <input
                id="qr-input"
                type="text"
                x-model="input"
                class="w-full bg-surface-container-lowest border-t-2 border-outline-variant text-on-surface px-4 py-2.5 text-sm font-mono focus:outline-none focus:border-primary mb-6"
                autocomplete="off"
            />
            <div class="bg-surface-container-low p-6 lg:p-8 flex justify-center">
                <img
                    :src="'/qr?data=' + encodeURIComponent(input) + '&size=250'"
                    alt="QR code preview"
                    class="max-w-full h-auto bg-white"
                    width="250"
                    height="250"
                />
            </div>
        </section>

        <section>
            <a href="{{ url('/api') }}"
               class="liquid-chrome p-3 font-headline font-bold text-on-primary-container uppercase tracking-widest text-xs inline-flex items-center gap-2">
                <span class="material-symbols-outlined text-base">bolt</span>
                View full API documentation
            </a>
        </section>
    </div>
</x-layout>
