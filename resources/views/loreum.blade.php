<x-layout>
    <div class="mb-16">
        <span class="text-tertiary font-headline font-bold text-xs tracking-[0.3em] uppercase mb-4 block">API Documentation</span>
        <h1 class="text-5xl md:text-7xl font-headline font-extrabold tracking-tighter text-on-surface leading-none">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-tertiary">Lorem Ipsum</span> Generator
        </h1>
        <p class="text-on-surface-variant text-sm mt-4">Generate custom placeholder text for your designs</p>
    </div>

    <div class="bg-surface-container-low p-6 lg:p-8">
        <div class="space-y-10">
            <section>
                <h3 class="section-title mb-8 flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary">terminal</span>
                    Basic Usage
                </h3>
                <div class="code-block">
                    <code class="break-all">GET {{ url('/l') }}</code>
                </div>
                <p class="text-on-surface-variant text-sm mt-3">Generates 3 paragraphs of Lorem Ipsum text by default.</p>
            </section>

            <section>
                <h3 class="section-title mb-8">Parameters</h3>
                <div class="space-y-1">
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">paragraphs</span>
                        <span class="text-outline text-xs">Number of paragraphs (1-100, default: 3)</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">minWords</span>
                        <span class="text-outline text-xs">Minimum words per paragraph (1-100, default: 5)</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">maxWords</span>
                        <span class="text-outline text-xs">Maximum words per paragraph (1-100, default: 20)</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">format</span>
                        <span class="text-outline text-xs">Output format (json/html/text, default: json)</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">seed</span>
                        <span class="text-outline text-xs">Seed for random generation (optional)</span>
                    </div>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Example</h3>
                <div class="code-block mb-4">
                    <code class="break-all">{{ url('/l?paragraphs=2&minWords=10&maxWords=15&format=html&capitalize=false&addPunctuation=true') }}</code>
                </div>
                <p class="text-on-surface-variant text-sm">Generates 2 paragraphs, each with 10-15 words, in HTML format.</p>
            </section>

            <section>
                <h3 class="section-title mb-8">Response Format</h3>
                <div class="code-block overflow-x-auto">
                    <pre><code>{
  "status": "success",
  "data": [ ... ],
  "metadata": {
    "paragraphs": 3,
    "minWords": 5,
    "maxWords": 20,
    "totalWords": 45,
    "format": "json",
    "seed": 12345
  }
}</code></pre>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Try It Now</h3>
                <a href="{{ url('/l') }}" target="_blank"
                   class="liquid-chrome p-3 font-headline font-bold text-on-primary-container uppercase tracking-widest text-xs inline-flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">bolt</span>
                    Generate Lorem Ipsum
                </a>
            </section>
        </div>
    </div>
</x-layout>
