<x-layout>
    <div class="mb-16">
        <span class="text-tertiary font-headline font-bold text-xs tracking-[0.3em] uppercase mb-4 block">Utility :: Color</span>
        <h1 class="text-5xl md:text-7xl font-headline font-extrabold tracking-tighter text-on-surface leading-none mb-4">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-tertiary">COLOR</span> CONVERTER
        </h1>
        <p class="text-on-surface-variant text-sm max-w-2xl">Convert hex colors to RGB, HSL, and more. Get contrast ratios, luminance, complementary colors, and closest CSS color names.</p>
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
                        <span class="terminal-label mb-2 block">Convert a 6-character hex</span>
                        <div class="code-block">
                            <code class="break-all">GET {{ url('/color') }}/ff5733</code>
                        </div>
                    </div>
                    <div>
                        <span class="terminal-label mb-2 block">Convert a 3-character shorthand</span>
                        <div class="code-block">
                            <code class="break-all">GET {{ url('/color') }}/f00</code>
                        </div>
                    </div>
                </div>
                <p class="text-on-surface-variant text-sm mt-4">
                    Pass a 3 or 6 character hex value as a path parameter&mdash;no <code class="font-mono text-xs text-tertiary bg-surface-container-lowest px-1.5 py-0.5">#</code> prefix needed.
                </p>
            </section>

            <section>
                <h3 class="section-title mb-8">Parameters</h3>
                <div class="space-y-1">
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">hex</span>
                        <span class="text-outline text-xs">Hex color code as path parameter (3 or 6 characters, e.g. ff5733 or f00)</span>
                    </div>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Example Response</h3>
                <div class="code-block">
<pre class="overflow-x-auto">{
  "hex": "#ff5733",
  "rgb": { "r": 255, "g": 87, "b": 51 },
  "rgb_css": "rgb(255, 87, 51)",
  "hsl": { "h": 11, "s": 100, "l": 60 },
  "hsl_css": "hsl(11, 100%, 60%)",
  "name": "orangered",
  "luminance": 0.2138,
  "contrast": {
    "on_white": 3.13,
    "on_black": 5.28,
    "best_text": "#000000"
  },
  "complement": "#33d4ff"
}</pre>
                </div>
            </section>

            <section x-data="{
                hex: 'ff5733',
                result: null,
                loading: false,
                get cleanHex() {
                    return this.hex.replace(/^#/, '').replace(/[^0-9a-fA-F]/g, '').slice(0, 6);
                },
                get isValid() {
                    return /^[0-9a-fA-F]{3}$|^[0-9a-fA-F]{6}$/.test(this.cleanHex);
                },
                get swatchColor() {
                    return this.isValid ? '#' + this.cleanHex : 'transparent';
                },
                async run() {
                    if (!this.isValid) return;
                    this.loading = true;
                    try {
                        const res = await fetch('/color/' + this.cleanHex);
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
                        <label class="terminal-label mb-2 block">Hex Color</label>
                        <div class="flex items-center gap-4">
                            <div class="relative flex-1">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-outline text-sm font-mono">#</span>
                                <input
                                    type="text"
                                    x-model="hex"
                                    maxlength="7"
                                    placeholder="ff5733"
                                    class="w-full bg-surface-container-lowest border-t-2 border-outline-variant text-on-surface pl-8 pr-4 py-2.5 text-sm font-mono focus:outline-none focus:border-primary"
                                    autocomplete="off"
                                />
                            </div>
                            <div
                                class="w-12 h-12 border-2 border-outline-variant/30 shrink-0 transition-colors"
                                :style="'background-color:' + swatchColor"
                            ></div>
                        </div>
                        <p class="text-outline text-xs mt-1" x-show="hex.length > 0 && !isValid">Enter a valid 3 or 6 character hex code</p>
                    </div>

                    <button
                        @click="run()"
                        :disabled="loading || !isValid"
                        class="liquid-chrome p-3 font-headline font-bold text-on-primary-container uppercase tracking-widest text-xs inline-flex items-center gap-2"
                    >
                        <span class="material-symbols-outlined text-base">bolt</span>
                        <span x-text="loading ? 'Converting…' : 'Convert Color'"></span>
                    </button>

                    <template x-if="result && !result.error">
                        <div class="space-y-4">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-20 h-20 border-2 border-outline-variant/30 shrink-0"
                                    :style="'background-color:' + (result.hex || swatchColor)"
                                ></div>
                                <div class="space-y-1">
                                    <span class="meta-label block">Preview</span>
                                    <span class="font-mono text-sm text-on-surface" x-text="result.hex"></span>
                                    <span class="block font-mono text-xs text-on-surface-variant" x-text="result.rgb_css"></span>
                                    <span class="block font-mono text-xs text-on-surface-variant" x-text="result.hsl_css"></span>
                                </div>
                            </div>
                            <div class="code-block">
                                <pre class="overflow-x-auto" x-text="JSON.stringify(result, null, 2)"></pre>
                            </div>
                        </div>
                    </template>

                    <template x-if="result && result.error">
                        <div class="code-block">
                            <pre class="overflow-x-auto text-red-400" x-text="JSON.stringify(result, null, 2)"></pre>
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
