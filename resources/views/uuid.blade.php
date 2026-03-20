<x-layout>
    <div class="mb-16">
        <span class="text-tertiary font-headline font-bold text-xs tracking-[0.3em] uppercase mb-4 block">Utility :: UUID</span>
        <h1 class="text-5xl md:text-7xl font-headline font-extrabold tracking-tighter text-on-surface leading-none mb-4">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-tertiary">UUID</span> GENERATOR
        </h1>
        <p class="text-on-surface-variant text-sm max-w-2xl">Generate RFC 4122 compliant UUIDs via a simple HTTP API. Supports version 4 (random) and version 7 (time-ordered) with formatting options.</p>
    </div>

    <div class="bg-surface-container-low p-6 lg:p-8">
        <div class="space-y-10">
            <section>
                <h3 class="section-title mb-8 flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">terminal</span>
                    Basic Usage
                </h3>
                <div class="space-y-4">
                    <div>
                        <span class="terminal-label mb-2 block">Generate a single UUID</span>
                        <div class="code-block">
                            <code class="break-all">GET {{ url('/uuid') }}</code>
                        </div>
                    </div>
                    <div>
                        <span class="terminal-label mb-2 block">Generate multiple UUIDs</span>
                        <div class="code-block">
                            <code class="break-all">GET {{ url('/uuid') }}?count=5</code>
                        </div>
                    </div>
                    <div>
                        <span class="terminal-label mb-2 block">Version 7 with formatting</span>
                        <div class="code-block">
                            <code class="break-all">GET {{ url('/uuid') }}?count=3&amp;version=7&amp;uppercase=true</code>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Parameters</h3>
                <div class="space-y-1">
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">count</span>
                        <span class="text-outline text-xs">Number of UUIDs to generate (1–100, default: 1)</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">version</span>
                        <span class="text-outline text-xs">UUID version: 4 (random) or 7 (time-ordered). Default: 4</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">uppercase</span>
                        <span class="text-outline text-xs">Return UUIDs in uppercase (true/false, default: false)</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">nodashes</span>
                        <span class="text-outline text-xs">Remove dashes from UUIDs (true/false, default: false)</span>
                    </div>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Example Response</h3>
                <div class="code-block">
<pre class="overflow-x-auto">{
  "count": 3,
  "version": 4,
  "uuids": [
    "f47ac10b-58cc-4372-a567-0e02b2c3d479",
    "7c9e6679-7425-40de-944b-e07fc1f90ae7",
    "550e8400-e29b-41d4-a716-446655440000"
  ]
}</pre>
                </div>
            </section>

            <section x-data="{
                count: 5,
                version: '4',
                uppercase: false,
                nodashes: false,
                result: null,
                loading: false,
                async run() {
                    this.loading = true;
                    try {
                        const params = new URLSearchParams({
                            count: this.count,
                            version: this.version,
                        });
                        if (this.uppercase) params.set('uppercase', 'true');
                        if (this.nodashes) params.set('nodashes', 'true');
                        const res = await fetch('/uuid?' + params);
                        this.result = await res.json();
                    } catch (e) {
                        this.result = { error: 'Request failed' };
                    }
                    this.loading = false;
                }
            }">
                <h3 class="section-title mb-8">Try It</h3>

                <div class="space-y-4">
                    <div>
                        <label class="terminal-label mb-2 block">Count (1–100)</label>
                        <div class="flex items-center gap-4">
                            <input
                                type="range"
                                x-model="count"
                                min="1"
                                max="100"
                                class="flex-1 accent-primary"
                            />
                            <input
                                type="number"
                                x-model="count"
                                min="1"
                                max="100"
                                class="w-20 bg-surface-container-lowest border-t-2 border-outline-variant text-on-surface px-3 py-2 text-sm font-mono text-center focus:outline-none focus:border-primary"
                            />
                        </div>
                    </div>

                    <div>
                        <label class="terminal-label mb-2 block">Version</label>
                        <div class="flex gap-4 items-center">
                            <label class="flex items-center gap-2 text-on-surface-variant text-sm cursor-pointer">
                                <input type="radio" x-model="version" value="4" class="accent-primary" />
                                v4 (random)
                            </label>
                            <label class="flex items-center gap-2 text-on-surface-variant text-sm cursor-pointer">
                                <input type="radio" x-model="version" value="7" class="accent-primary" />
                                v7 (time-ordered)
                            </label>
                        </div>
                    </div>

                    <div class="flex gap-6">
                        <label class="flex items-center gap-2 text-on-surface-variant text-sm cursor-pointer">
                            <input type="checkbox" x-model="uppercase" class="accent-primary" />
                            Uppercase
                        </label>
                        <label class="flex items-center gap-2 text-on-surface-variant text-sm cursor-pointer">
                            <input type="checkbox" x-model="nodashes" class="accent-primary" />
                            No dashes
                        </label>
                    </div>

                    <button
                        @click="run()"
                        :disabled="loading"
                        class="liquid-chrome p-3 font-headline font-bold text-on-primary-container uppercase tracking-widest text-xs inline-flex items-center gap-2"
                    >
                        <span class="material-symbols-outlined text-base">bolt</span>
                        <span x-text="loading ? 'Generating…' : 'Generate UUIDs'"></span>
                    </button>

                    <template x-if="result">
                        <div class="code-block">
                            <pre class="overflow-x-auto" x-text="JSON.stringify(result, null, 2)"></pre>
                        </div>
                    </template>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Rate Limiting</h3>
                <div class="bg-surface-container-lowest border-t-2 border-secondary p-4 flex items-center gap-3">
                    <span class="w-2 h-2 rounded-full bg-secondary animate-beacon-pulse"></span>
                    <p class="text-on-surface-variant text-sm">120 requests per minute</p>
                </div>
            </section>
        </div>
    </div>
</x-layout>
