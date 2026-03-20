<x-layout>
    <div class="mb-16">
        <span class="text-tertiary font-headline font-bold text-xs tracking-[0.3em] uppercase mb-4 block">Utility :: Hash</span>
        <h1 class="text-5xl md:text-7xl font-headline font-extrabold tracking-tighter text-on-surface leading-none mb-4">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-tertiary">HASH</span> GENERATOR
        </h1>
        <p class="text-on-surface-variant text-sm max-w-2xl">Generate cryptographic hashes from any string. Supports MD5, SHA-1, SHA-256, SHA-512, and more via a simple HTTP API.</p>
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
                        <span class="terminal-label mb-2 block">Hash with default algorithm (SHA-256)</span>
                        <div class="code-block">
                            <code class="break-all">GET {{ url('/hash') }}?data=hello</code>
                        </div>
                    </div>
                    <div>
                        <span class="terminal-label mb-2 block">Specify algorithm</span>
                        <div class="code-block">
                            <code class="break-all">GET {{ url('/hash') }}?data=hello&amp;algo=sha256</code>
                        </div>
                    </div>
                    <div>
                        <span class="terminal-label mb-2 block">Return all algorithms at once</span>
                        <div class="code-block">
                            <code class="break-all">GET {{ url('/hash') }}?data=hello&amp;all=true</code>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Parameters</h3>
                <div class="space-y-1">
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">data</span>
                        <span class="text-outline text-xs">The string to hash (required)</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">algo</span>
                        <span class="text-outline text-xs">Algorithm to use (default: sha256). Options: md5, sha1, sha224, sha256, sha384, sha512, crc32, crc32b</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">all</span>
                        <span class="text-outline text-xs">Set to true to return hashes for all available algorithms at once</span>
                    </div>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Available Algorithms</h3>
                <div class="flex flex-wrap gap-2 text-xs font-mono">
                    @foreach(['md5', 'sha1', 'sha224', 'sha256', 'sha384', 'sha512', 'crc32', 'crc32b'] as $algo)
                        <span class="bg-surface-container-lowest text-tertiary px-2 py-1">{{ $algo }}</span>
                    @endforeach
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Example Response</h3>
                <div class="code-block">
<pre class="overflow-x-auto">{
  "data": "hello",
  "algorithm": "sha256",
  "hash": "2cf24dba5fb0a30e26e83b2ac5b9e29e1b161e5c1fa7425e73043362938b9824",
  "length": 64
}</pre>
                </div>
            </section>

            <section x-data="{
                input: 'hello world',
                algo: 'sha256',
                result: null,
                loading: false,
                async run() {
                    this.loading = true;
                    try {
                        const params = new URLSearchParams({ data: this.input, algo: this.algo });
                        const res = await fetch('/hash?' + params);
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
                        <label class="terminal-label mb-2 block">Data</label>
                        <input
                            type="text"
                            x-model="input"
                            class="w-full bg-surface-container-lowest border-t-2 border-outline-variant text-on-surface px-4 py-2.5 text-sm font-mono focus:outline-none focus:border-primary"
                            autocomplete="off"
                        />
                    </div>

                    <div>
                        <label class="terminal-label mb-2 block">Algorithm</label>
                        <select
                            x-model="algo"
                            class="bg-surface-container-lowest border-t-2 border-outline-variant text-on-surface px-4 py-2.5 text-sm font-mono focus:outline-none focus:border-primary"
                        >
                            <option value="md5">md5</option>
                            <option value="sha1">sha1</option>
                            <option value="sha224">sha224</option>
                            <option value="sha256" selected>sha256</option>
                            <option value="sha384">sha384</option>
                            <option value="sha512">sha512</option>
                            <option value="crc32">crc32</option>
                            <option value="crc32b">crc32b</option>
                        </select>
                    </div>

                    <button
                        @click="run()"
                        :disabled="loading || !input.trim()"
                        class="liquid-chrome p-3 font-headline font-bold text-on-primary-container uppercase tracking-widest text-xs inline-flex items-center gap-2"
                    >
                        <span class="material-symbols-outlined text-base">bolt</span>
                        <span x-text="loading ? 'Hashing…' : 'Generate Hash'"></span>
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
