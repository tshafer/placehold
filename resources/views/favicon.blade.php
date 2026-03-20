<x-layout>
    <section class="mb-16">
        <span class="text-tertiary font-headline font-bold text-xs tracking-[0.3em] uppercase mb-4 block">Icon System</span>
        <h1 class="text-5xl md:text-7xl font-headline font-extrabold tracking-tighter text-on-surface leading-none mb-6">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-tertiary">Favicon</span> Generator
        </h1>
        <p class="text-on-surface-variant text-sm max-w-2xl">Generate simple letter or emoji favicons as scalable SVGs. Use them as site icons, PWA icons, or quick brand placeholders—no image editor required.</p>
    </section>

    <div class="space-y-12">
        <section>
            <h3 class="section-title mb-8 flex items-center gap-3">
                <span class="material-symbols-outlined text-base">terminal</span>
                Basic Usage
            </h3>
            <p class="text-on-surface-variant text-sm mb-4">Request the endpoint with optional query parameters. The response is an SVG with long-lived caching.</p>
            <div class="code-block">
                <code class="break-all">GET {{ route('favicon') }}</code>
            </div>
        </section>

        <section>
            <h3 class="section-title mb-8">Parameters</h3>
            <div class="space-y-px">
                <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                    <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">text</span>
                    <span class="text-outline text-xs">Letter(s) or emoji (default: <span class="font-mono">P</span>, max 2 characters)</span>
                </div>
                <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                    <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">size</span>
                    <span class="text-outline text-xs">Pixel size (default: 64, min 16, max 512)</span>
                </div>
                <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                    <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">bg</span>
                    <span class="text-outline text-xs">Background hex color without <span class="font-mono">#</span> (default: <span class="font-mono">6366f1</span>)</span>
                </div>
                <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                    <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">fg</span>
                    <span class="text-outline text-xs">Foreground hex color without <span class="font-mono">#</span> (default: <span class="font-mono">ffffff</span>)</span>
                </div>
                <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                    <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">radius</span>
                    <span class="text-outline text-xs">Corner radius as percent of size (default: 12, 0–50; 50 is a circle)</span>
                </div>
                <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                    <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">format</span>
                    <span class="text-outline text-xs">Output format (default: <span class="font-mono">svg</span>; only SVG is supported today)</span>
                </div>
                <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                    <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">font</span>
                    <span class="text-outline text-xs">CSS <span class="font-mono">font-family</span> value (default: <span class="font-mono">sans-serif</span>)</span>
                </div>
            </div>
        </section>

        <section>
            <h3 class="section-title mb-8">Preview</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                <div class="bg-surface-container-low p-6 flex flex-col items-center gap-3">
                    <img src="{{ route('favicon', ['text' => 'A', 'size' => 96, 'bg' => '6366f1', 'fg' => 'ffffff']) }}" alt="Favicon A" class="w-24 h-24">
                    <span class="meta-label">A</span>
                </div>
                <div class="bg-surface-container-low p-6 flex flex-col items-center gap-3">
                    <img src="{{ route('favicon', ['text' => 'B', 'size' => 96, 'bg' => '0ea5e9', 'fg' => 'ffffff']) }}" alt="Favicon B" class="w-24 h-24">
                    <span class="meta-label">B · sky</span>
                </div>
                <div class="bg-surface-container-low p-6 flex flex-col items-center gap-3">
                    <img src="{{ route('favicon', ['text' => 'Z', 'size' => 96, 'bg' => 'f43f5e', 'fg' => 'ffffff']) }}" alt="Favicon Z" class="w-24 h-24">
                    <span class="meta-label">Z · rose</span>
                </div>
                <div class="bg-surface-container-low p-6 flex flex-col items-center gap-3">
                    <img src="{{ route('favicon', ['text' => 'AB', 'size' => 96, 'bg' => '6366f1', 'fg' => 'ffffff']) }}" alt="Favicon AB" class="w-24 h-24">
                    <span class="meta-label">AB</span>
                </div>
                <div class="bg-surface-container-low p-6 flex flex-col items-center gap-3">
                    <img src="{{ route('favicon', ['text' => 'Hi', 'size' => 96, 'bg' => '22c55e', 'fg' => 'ffffff']) }}" alt="Favicon Hi" class="w-24 h-24">
                    <span class="meta-label">Hi · green</span>
                </div>
                <div class="bg-surface-container-low p-6 flex flex-col items-center gap-3">
                    <img src="{{ route('favicon', ['text' => 'P', 'size' => 96, 'bg' => '18181b', 'fg' => 'fafafa', 'radius' => 50]) }}" alt="Favicon P circle" class="w-24 h-24">
                    <span class="meta-label">P · circle</span>
                </div>
                <div class="bg-surface-container-low p-6 flex flex-col items-center gap-3">
                    <img src="{{ route('favicon', ['text' => '✨', 'size' => 96, 'bg' => '7c3aed', 'fg' => 'ffffff']) }}" alt="Favicon emoji" class="w-24 h-24">
                    <span class="meta-label">emoji</span>
                </div>
                <div class="bg-surface-container-low p-6 flex flex-col items-center gap-3">
                    <img src="{{ route('favicon', ['text' => 'λ', 'size' => 96, 'bg' => 'eab308', 'fg' => '1c1917']) }}" alt="Favicon lambda" class="w-24 h-24">
                    <span class="meta-label">λ · amber</span>
                </div>
            </div>
        </section>

        <section>
            <h3 class="section-title mb-8">How to Use</h3>
            <p class="text-on-surface-variant text-sm mb-4">Add a <span class="font-mono text-xs text-tertiary">link</span> tag in your HTML <span class="font-mono text-xs text-tertiary">head</span>:</p>
            <div class="code-block overflow-x-auto">
                <code class="whitespace-pre">&lt;link rel="icon" type="image/svg+xml" href="https://placehold.cloud/favicon?text=P&amp;bg=6366f1"&gt;</code>
            </div>
            <p class="text-outline text-xs mt-4">Swap the domain for your own when self-hosting, or point directly at placehold.cloud for quick prototypes.</p>
        </section>

        <section>
            <h3 class="section-title mb-8">Try It</h3>
            <a href="{{ route('favicon', ['text' => 'P', 'bg' => '6366f1', 'fg' => 'ffffff', 'size' => 128]) }}" target="_blank" rel="noopener noreferrer"
               class="liquid-chrome p-3 font-headline font-bold text-on-primary-container uppercase tracking-widest text-xs inline-flex items-center gap-2">
                <span class="material-symbols-outlined text-base">bolt</span>
                Open favicon URL
            </a>
        </section>
    </div>
</x-layout>
