<x-layout>
    {{-- Hero Heading --}}
    <div class="mb-16 flex flex-col lg:flex-row justify-between items-end gap-8">
        <div>
            <span class="text-tertiary font-headline font-bold text-xs tracking-[0.3em] uppercase mb-4 block">Generator :: Image</span>
            <h2 class="text-5xl md:text-7xl font-headline font-extrabold tracking-tighter text-on-surface leading-none">
                IMAGE<br><span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-tertiary">GENERATOR</span>
            </h2>
        </div>
        <div class="flex items-center gap-2 bg-surface-container px-4 py-2 border-l-2 border-secondary">
            <span class="w-2 h-2 rounded-full bg-secondary animate-beacon-pulse"></span>
            <span class="meta-label text-secondary">Live Preview</span>
        </div>
    </div>

    <div x-data="imageGenerator()" class="grid grid-cols-12 gap-8 items-start">
        {{-- Controls Panel --}}
        <div class="col-span-12 lg:col-span-4 space-y-8">
            <div class="bg-surface-container-low p-8 relative overflow-hidden group">
                <h3 class="section-title mb-10">Configuration</h3>
                <div class="space-y-8">
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <label class="terminal-label">Dimensions</label>
                            <span class="text-xs font-headline text-tertiary" x-text="size"></span>
                        </div>
                        <input type="text" x-model="size" @input="updatePreview" placeholder="500x300" class="terminal-input w-full text-xl font-headline font-bold p-0">
                    </div>

                    <div class="space-y-3">
                        <label class="terminal-label">Background Hex</label>
                        <div class="flex gap-3 items-center">
                            <input type="color" x-model="bgColor" @input="updatePreview" class="h-10 w-14 bg-transparent cursor-pointer border-0">
                            <input type="text" x-model="bgColor" @input="updatePreview" class="terminal-input flex-1 font-headline">
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="terminal-label">Text Hex</label>
                        <div class="flex gap-3 items-center">
                            <input type="color" x-model="textColor" @input="updatePreview" class="h-10 w-14 bg-transparent cursor-pointer border-0">
                            <input type="text" x-model="textColor" @input="updatePreview" class="terminal-input flex-1 font-headline">
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="terminal-label">Overlay Text</label>
                        <input type="text" x-model="text" @input="updatePreview" placeholder="Your Text" class="terminal-input w-full font-headline">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-3">
                            <label class="terminal-label">Format</label>
                            <select x-model="format" @change="updatePreview" class="terminal-input w-full font-headline text-sm">
                                <option value="png">PNG</option>
                                <option value="svg">SVG</option>
                                <option value="jpg">JPG</option>
                                <option value="webp">WebP</option>
                                <option value="avif">AVIF</option>
                                <option value="gif">GIF</option>
                            </select>
                        </div>
                        <div class="space-y-3">
                            <label class="terminal-label">Font</label>
                            <select x-model="font" @change="updatePreview" class="terminal-input w-full font-headline text-sm">
                                <option value="arial">Arial</option>
                                <option value="couri">Courier</option>
                                <option value="times">Times</option>
                                <option value="tron">Tron</option>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="terminal-label">Effects</label>
                        <div class="flex flex-wrap gap-4 mt-1">
                            <label class="flex items-center gap-2 cursor-pointer text-outline hover:text-on-surface transition-colors text-xs uppercase tracking-wider">
                                <input type="checkbox" x-model="grayscale" @change="updatePreview" class="bg-surface-container-lowest border-outline-variant rounded-sm">
                                Grayscale
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer text-outline hover:text-on-surface transition-colors text-xs uppercase tracking-wider">
                                <input type="checkbox" x-model="invert" @change="updatePreview" class="bg-surface-container-lowest border-outline-variant rounded-sm">
                                Invert
                            </label>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="terminal-label">Special Sources</label>
                        <div class="flex flex-wrap gap-4 mt-1">
                            @foreach(['cat' => 'Cat', 'dog' => 'Dog', 'robot' => 'Robot'] as $key => $label)
                                <label class="flex items-center gap-2 cursor-pointer text-outline hover:text-on-surface transition-colors text-xs uppercase tracking-wider">
                                    <input type="checkbox" x-model="{{ $key }}" @change="updatePreview" class="bg-surface-container-lowest border-outline-variant rounded-sm">
                                    {{ $label }}
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <button @click="updatePreview" class="w-full liquid-chrome p-4 font-headline font-black text-on-primary-container uppercase tracking-[0.3em] text-sm shadow-[0_0_20px_rgba(171,199,255,0.3)] hover:scale-[1.02] active:scale-95 transition-all">
                        Generate Stream
                    </button>
                </div>
            </div>
        </div>

        {{-- Preview Area --}}
        <div class="col-span-12 lg:col-span-8">
            <div class="bg-surface-container-highest/30 glass-panel p-2 border border-outline-variant/15 relative">
                <div class="absolute top-6 left-6 z-10 flex items-center gap-4">
                    <div class="bg-surface-container-lowest/80 glass-panel px-3 py-1 text-[9px] font-headline font-bold uppercase text-tertiary tracking-widest border border-tertiary/20">
                        PREVIEW_MODE // LIVE
                    </div>
                </div>
                <div class="aspect-video w-full bg-surface-container-lowest relative overflow-hidden flex items-center justify-center">
                    <img :src="previewUrl" alt="Preview" class="max-w-full max-h-full object-contain">
                    <div class="absolute bottom-6 left-6 z-10">
                        <div class="text-[48px] font-headline font-black text-on-surface/10 leading-none select-none" x-text="size"></div>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center p-4 gap-4">
                    <div class="flex items-center gap-6">
                        <button @click="copyToClipboard(previewUrl)" class="flex items-center gap-2 text-outline hover:text-secondary transition-all">
                            <span class="material-symbols-outlined text-sm">content_copy</span>
                            <span class="meta-label">Copy URL</span>
                        </button>
                        <button @click="copyToClipboard(htmlUrl)" class="flex items-center gap-2 text-outline hover:text-secondary transition-all">
                            <span class="material-symbols-outlined text-sm">code</span>
                            <span class="meta-label">Copy HTML</span>
                        </button>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-tertiary text-sm">schedule</span>
                        <span class="meta-label text-outline">Cached 1yr</span>
                    </div>
                </div>
            </div>

            {{-- URL Readout --}}
            <div class="mt-6 code-block space-y-2">
                <div class="flex gap-4">
                    <span class="text-secondary">[URL]</span>
                    <span class="text-on-surface/60 break-all" x-text="previewUrl"></span>
                </div>
                <div class="flex gap-4">
                    <span class="text-primary">[HTML]</span>
                    <span class="text-on-surface/60 break-all" x-text="htmlUrl"></span>
                </div>
                <div class="flex gap-4">
                    <span class="text-tertiary">[MD]</span>
                    <span class="text-on-surface/60 break-all" x-text="markdownUrl"></span>
                </div>
            </div>

            {{-- API Docs --}}
            <div class="mt-10 bg-surface-container-low p-8">
                <h3 class="section-title mb-8">API Documentation</h3>
                <div class="space-y-6">
                    <div>
                        <span class="terminal-label block mb-3">Short Format</span>
                        <div class="code-block">
                            <code class="text-tertiary">/640x320?text=Hello&bg=efefef&fg=374151</code>
                        </div>
                    </div>
                    <div>
                        <span class="terminal-label block mb-3">Full Format</span>
                        <div class="code-block">
                            <code class="text-tertiary">/p/300x200/FF5733/FFFFFF?format=png&text=Hello</code>
                        </div>
                    </div>
                    <div>
                        <span class="terminal-label block mb-3">Parameters</span>
                        <div class="space-y-1">
                            @foreach([
                                ['size', 'Dimensions (e.g., 300x200 or 300 for square)'],
                                ['format', 'png, jpg, webp, avif, gif, bmp, ico, svg'],
                                ['bg', 'Background hex color (default: C8C8C8)'],
                                ['fg', 'Text hex color (default: 323232)'],
                                ['text', 'Custom overlay text'],
                                ['font', 'arial, couri, times, tron'],
                                ['quality', '1-100 compression quality'],
                            ] as [$param, $desc])
                                <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                                    <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">{{ $param }}</span>
                                    <span class="text-outline text-xs">{{ $desc }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <a href="/api" class="inline-flex items-center gap-2 text-primary hover:text-secondary transition-colors font-headline font-bold text-xs uppercase tracking-widest">
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        Full API Docs
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div x-show="copied" x-transition class="fixed bottom-6 right-6 bg-tertiary-container text-on-tertiary-container px-6 py-3 shadow-lg z-50 font-headline text-xs uppercase tracking-widest flex items-center gap-2">
        <span class="material-symbols-outlined text-sm">check_circle</span>
        Copied to clipboard
    </div>

    <script>
        function imageGenerator() {
            return {
                size: '500x300',
                bgColor: '#C8C8C8',
                textColor: '#323232',
                text: '',
                format: 'png',
                font: 'arial',
                quality: 90,
                grayscale: false,
                invert: false,
                cat: false,
                dog: false,
                robot: false,
                copied: false,

                get previewUrl() {
                    const bg = this.bgColor.replace('#', '');
                    const text = this.textColor.replace('#', '');
                    let url = `/p/${this.size}/${bg}/${text}?format=${this.format}&font=${this.font}&quality=${this.quality}`;
                    if (this.text) url += `&text=${encodeURIComponent(this.text)}`;
                    if (this.grayscale) url += `&grayscale=true`;
                    if (this.invert) url += `&invert=true`;
                    if (this.cat) url += `&cat=true`;
                    if (this.dog) url += `&dog=true`;
                    if (this.robot) url += `&robot=true`;
                    return url;
                },
                get markdownUrl() { return `![Placeholder](${this.previewUrl})`; },
                get htmlUrl() { return `<img src="${this.previewUrl}" alt="Placeholder">`; },
                updatePreview() {},
                async copyToClipboard(text) {
                    try {
                        await navigator.clipboard.writeText(text);
                        this.copied = true;
                        setTimeout(() => this.copied = false, 2000);
                    } catch (e) {}
                }
            }
        }
    </script>
</x-layout>
