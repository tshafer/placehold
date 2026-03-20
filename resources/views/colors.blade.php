<x-layout>
    <div class="mb-16">
        <span class="text-tertiary font-headline font-bold text-xs tracking-[0.3em] uppercase mb-4 block">API Documentation</span>
        <h1 class="text-5xl md:text-7xl font-headline font-extrabold tracking-tighter text-on-surface leading-none">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-tertiary">Colors</span> API
        </h1>
        <p class="text-on-surface-variant text-sm mt-4">Generate color palettes, hex codes, and named colors</p>
    </div>

    <div class="bg-surface-container-low p-6 lg:p-8">
        <div class="space-y-10">
            <section>
                <h3 class="section-title mb-8 flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary">terminal</span>
                    Basic Usage
                </h3>
                <div class="code-block">
                    <code class="break-all">GET {{ route('colors') }}</code>
                </div>
                <p class="text-on-surface-variant text-sm mt-3">Returns a random color palette by default.</p>
            </section>

            <section>
                <h3 class="section-title mb-8">Query Parameters</h3>
                <div class="space-y-1">
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">type</span>
                        <span class="text-outline text-xs">Type of color data: palette, hex, or named (default: palette)</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">count</span>
                        <span class="text-outline text-xs">Number of results (1-10, default: 5)</span>
                    </div>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Example Usage</h3>
                <div class="space-y-4">
                    <div>
                        <span class="terminal-label mb-2 block">Color Palette</span>
                        <div class="code-block">
                            <code class="break-all">GET {{ route('colors', ['type' => 'palette', 'count' => 3]) }}</code>
                        </div>
                    </div>
                    <div>
                        <span class="terminal-label mb-2 block">Random Hex Colors</span>
                        <div class="code-block">
                            <code class="break-all">GET {{ route('colors', ['type' => 'hex', 'count' => 5]) }}</code>
                        </div>
                    </div>
                    <div>
                        <span class="terminal-label mb-2 block">Named Colors</span>
                        <div class="code-block">
                            <code class="break-all">GET {{ route('colors', ['type' => 'named', 'count' => 8]) }}</code>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Response Format</h3>
                <div class="space-y-6">
                    <div>
                        <span class="terminal-label mb-2 block">Color Palette Response</span>
                        <div class="code-block overflow-x-auto">
                            <pre><code>{
  "status": "success",
  "type": "palette",
  "count": 3,
  "data": [
    {
      "name": "Ocean Breeze",
      "colors": ["#2E86AB", "#A23B72", "#F18F01", "#C73E1D", "#E8E9EB"]
    },
    {
      "name": "Sunset Vibes",
      "colors": ["#F94144", "#F3722C", "#F8961E", "#F9C74F", "#90BE6D"]
    },
    {
      "name": "Forest Green",
      "colors": ["#264653", "#2A9D8F", "#E9C46A", "#F4A261", "#E76F51"]
    }
  ],
  "timestamp": "2025-01-30 12:00:00"
}</code></pre>
                        </div>
                    </div>
                    <div>
                        <span class="terminal-label mb-2 block">Named Colors Response</span>
                        <div class="code-block overflow-x-auto">
                            <pre><code>{
  "status": "success",
  "type": "named",
  "count": 3,
  "data": [
    {
      "name": "Crimson Red",
      "hex": "#DC143C",
      "rgb": [220, 20, 60],
      "category": "red"
    },
    {
      "name": "Ocean Blue",
      "hex": "#006994",
      "rgb": [0, 105, 148],
      "category": "blue"
    }
  ],
  "timestamp": "2025-01-30 12:00:00"
}</code></pre>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Rate Limiting</h3>
                <div class="bg-surface-container-lowest p-4 border-l-2 border-tertiary">
                    <p class="text-on-surface-variant text-sm">This endpoint is rate-limited to 120 requests per minute to ensure fair usage.</p>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Error Handling</h3>
                <p class="text-on-surface-variant text-sm mb-4">In case of an error, the API returns a JSON response with an error message:</p>
                <div class="code-block overflow-x-auto">
                    <pre><code>{
  "status": "error",
  "message": "Invalid type. Use: palette, hex, or named"
}</code></pre>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Try It Now</h3>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('colors', ['type' => 'palette']) }}" target="_blank"
                       class="liquid-chrome p-3 font-headline font-bold text-on-primary-container uppercase tracking-widest text-xs inline-flex items-center gap-2">
                        <span class="material-symbols-outlined text-base">bolt</span>
                        Test Palette
                    </a>
                    <a href="{{ route('colors', ['type' => 'hex', 'count' => 5]) }}" target="_blank"
                       class="text-outline border border-outline-variant/40 hover:text-primary hover:border-primary/40 px-4 py-2 font-headline font-bold text-xs uppercase tracking-widest transition-all inline-flex items-center gap-2">
                        <span class="material-symbols-outlined text-base">bolt</span>
                        Test Hex
                    </a>
                    <a href="{{ route('colors', ['type' => 'named', 'count' => 5]) }}" target="_blank"
                       class="text-outline border border-outline-variant/40 hover:text-primary hover:border-primary/40 px-4 py-2 font-headline font-bold text-xs uppercase tracking-widest transition-all inline-flex items-center gap-2">
                        <span class="material-symbols-outlined text-base">bolt</span>
                        Test Named
                    </a>
                </div>
            </section>
        </div>
    </div>
</x-layout>
