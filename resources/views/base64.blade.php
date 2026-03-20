<x-layout>
    <div class="mb-16">
        <span class="text-tertiary font-headline font-bold text-xs tracking-[0.3em] uppercase mb-4 block">Utility :: Base64</span>
        <h1 class="text-5xl md:text-7xl font-headline font-extrabold tracking-tighter text-on-surface leading-none mb-4">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-tertiary">BASE64</span> ENCODER
        </h1>
        <p class="text-on-surface-variant text-sm max-w-2xl">Encode and decode Base64 strings via a simple HTTP API. Pass raw text to encode or a Base64 string to decode.</p>
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
                        <span class="terminal-label mb-2 block">Encode a string</span>
                        <div class="code-block">
                            <code class="break-all">GET {{ url('/base64') }}?encode=hello</code>
                        </div>
                    </div>
                    <div>
                        <span class="terminal-label mb-2 block">Decode a string</span>
                        <div class="code-block">
                            <code class="break-all">GET {{ url('/base64') }}?decode=aGVsbG8=</code>
                        </div>
                    </div>
                </div>
                <p class="text-on-surface-variant text-sm mt-4">
                    Supply either <code class="font-mono text-xs text-tertiary bg-surface-container-lowest px-1.5 py-0.5">encode</code> or
                    <code class="font-mono text-xs text-tertiary bg-surface-container-lowest px-1.5 py-0.5">decode</code>&mdash;not both.
                </p>
            </section>

            <section>
                <h3 class="section-title mb-8">Parameters</h3>
                <div class="space-y-1">
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">encode</span>
                        <span class="text-outline text-xs">Plain-text string to Base64-encode</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">decode</span>
                        <span class="text-outline text-xs">Base64-encoded string to decode back to plain text</span>
                    </div>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Example Response</h3>
                <div class="code-block">
<pre class="overflow-x-auto">{
  "input": "hello",
  "output": "aGVsbG8=",
  "operation": "encode",
  "length": 8
}</pre>
                </div>
            </section>

            <section x-data="{
                input: 'hello world',
                operation: 'encode',
                result: null,
                loading: false,
                async run() {
                    this.loading = true;
                    try {
                        const param = this.operation === 'encode'
                            ? 'encode=' + encodeURIComponent(this.input)
                            : 'decode=' + encodeURIComponent(this.input);
                        const res = await fetch('/base64?' + param);
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
                        <label class="terminal-label mb-2 block">Input</label>
                        <input
                            type="text"
                            x-model="input"
                            class="w-full bg-surface-container-lowest border-t-2 border-outline-variant text-on-surface px-4 py-2.5 text-sm font-mono focus:outline-none focus:border-primary"
                            autocomplete="off"
                        />
                    </div>

                    <div class="flex gap-4 items-center">
                        <label class="flex items-center gap-2 text-on-surface-variant text-sm cursor-pointer">
                            <input type="radio" x-model="operation" value="encode" class="accent-primary" />
                            Encode
                        </label>
                        <label class="flex items-center gap-2 text-on-surface-variant text-sm cursor-pointer">
                            <input type="radio" x-model="operation" value="decode" class="accent-primary" />
                            Decode
                        </label>
                    </div>

                    <button
                        @click="run()"
                        :disabled="loading || !input.trim()"
                        class="liquid-chrome p-3 font-headline font-bold text-on-primary-container uppercase tracking-widest text-xs inline-flex items-center gap-2"
                    >
                        <span class="material-symbols-outlined text-base">bolt</span>
                        <span x-text="loading ? 'Processing…' : 'Run'"></span>
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
