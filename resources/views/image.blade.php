<x-layout>
    <div class="max-w-5xl text-[15px] leading-relaxed">
        <span class="text-tertiary font-headline font-bold text-xs tracking-wide uppercase mb-4 block">IMAGE(1)</span>
        <h1 class="sr-only">Image Placeholder Generator</h1>

        <x-man-section title="Name">
            <p>image — placeholder images at any size, color, text and format</p>
        </x-man-section>

        <x-man-section title="Synopsis">
            <div class="code-block break-all space-y-1">
                <div>GET {{ url('/') }}/<u>W</u>x<u>H</u> [?text=<u>str</u>] [&amp;bg=<u>hex</u>] [&amp;fg=<u>hex</u>]</div>
                <div>GET {{ url('/p') }}/<u>W</u>x<u>H</u>/<u>bg</u>/<u>fg</u> [?format=<u>fmt</u>] [&amp;text=<u>str</u>] [&amp;font=<u>name</u>] [&amp;quality=<u>n</u>]</div>
            </div>
        </x-man-section>

        <x-man-section title="Options">
            <dl class="space-y-3">
                @foreach([
                    ['size', 'Dimensions, e.g. 300x200, or 300 for a square.'],
                    ['format', 'png, jpg, webp, avif, gif, bmp, ico or svg.'],
                    ['bg', 'Background hex color. Default C8C8C8.'],
                    ['fg', 'Text hex color. Default 323232.'],
                    ['text', 'Overlay text. Default "Placeholder".'],
                    ['font', 'arial, couri, times or tron.'],
                    ['quality', 'Compression quality, 1–100.'],
                    ['grayscale, invert', 'Filters; pass true to apply.'],
                    ['cat, dog, robot', 'Use a photo or robot instead of a flat color; pass true.'],
                ] as [$param, $desc])
                    <div><dt class="font-bold text-primary">{{ $param }}</dt><dd class="ml-6">{{ $desc }}</dd></div>
                @endforeach
            </dl>
        </x-man-section>

        <x-man-section title="Examples">
            <div class="space-y-4 break-all">
                <div><p class="text-outline">A 640×320 banner with a caption:</p><p class="ml-6"><span class="text-outline">$</span> curl -O "{{ url('/640x320') }}?text=Hello&amp;bg=efefef&amp;fg=374151"</p></div>
                <div><p class="text-outline">Orange PNG, white text:</p><p class="ml-6"><span class="text-outline">$</span> curl -O "{{ url('/p/300x200/FF5733/FFFFFF') }}?format=png&amp;text=Hello"</p></div>
            </div>
        </x-man-section>

        <x-man-section title="Try it">
            <div x-data="imageGenerator()" class="grid lg:grid-cols-[18rem_minmax(0,1fr)] gap-8 items-start">
                <div class="space-y-5">
                    <div>
                        <label for="img-size" class="font-bold block mb-1">size</label>
                        <input id="img-size" type="text" x-model="size" placeholder="500x300" class="terminal-input w-full">
                    </div>
                    <div>
                        <label for="img-bg" class="font-bold block mb-1">bg</label>
                        <div class="flex gap-3 items-center">
                            <input type="color" x-model="bgColor" aria-label="Background color picker" class="h-11 w-12 bg-transparent cursor-pointer border border-outline-variant">
                            <input id="img-bg" type="text" x-model="bgColor" class="terminal-input flex-1 min-w-0">
                        </div>
                    </div>
                    <div>
                        <label for="img-fg" class="font-bold block mb-1">fg</label>
                        <div class="flex gap-3 items-center">
                            <input type="color" x-model="textColor" aria-label="Text color picker" class="h-11 w-12 bg-transparent cursor-pointer border border-outline-variant">
                            <input id="img-fg" type="text" x-model="textColor" class="terminal-input flex-1 min-w-0">
                        </div>
                    </div>
                    <div>
                        <label for="img-text" class="font-bold block mb-1">text</label>
                        <input id="img-text" type="text" x-model="text" placeholder="Your text" class="terminal-input w-full">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="img-format" class="font-bold block mb-1">format</label>
                            <select id="img-format" x-model="format" class="terminal-input w-full">
                                <option value="png">png</option>
                                <option value="svg">svg</option>
                                <option value="jpg">jpg</option>
                                <option value="webp">webp</option>
                                <option value="avif">avif</option>
                                <option value="gif">gif</option>
                            </select>
                        </div>
                        <div>
                            <label for="img-font" class="font-bold block mb-1">font</label>
                            <select id="img-font" x-model="font" class="terminal-input w-full">
                                <option value="arial">arial</option>
                                <option value="couri">couri</option>
                                <option value="times">times</option>
                                <option value="tron">tron</option>
                            </select>
                        </div>
                    </div>
                    <fieldset>
                        <legend class="font-bold mb-1">flags</legend>
                        <div class="flex flex-wrap gap-x-5 gap-y-2">
                            @foreach(['grayscale', 'invert', 'cat', 'dog', 'robot'] as $flag)
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" x-model="{{ $flag }}" class="accent-primary"> {{ $flag }}
                                </label>
                            @endforeach
                        </div>
                    </fieldset>
                </div>

                <div class="min-w-0">
                    <div class="aspect-video w-full bg-surface-container-lowest border border-outline-variant flex items-center justify-center overflow-hidden">
                        <img :src="previewUrl" :alt="'Placeholder preview, ' + size" class="max-w-full max-h-full object-contain">
                    </div>

                    <div class="mt-4 code-block space-y-2">
                        <div class="flex gap-4"><span class="text-primary shrink-0 w-14">url</span><span class="break-all" x-text="previewUrl"></span></div>
                        <div class="flex gap-4"><span class="text-primary shrink-0 w-14">html</span><span class="break-all" x-text="htmlUrl"></span></div>
                        <div class="flex gap-4"><span class="text-primary shrink-0 w-14">md</span><span class="break-all" x-text="markdownUrl"></span></div>
                    </div>

                    <div class="mt-3 flex flex-wrap gap-x-6 gap-y-2 items-center">
                        <button type="button" @click="copyToClipboard(previewUrl)" class="text-primary hover:underline">[copy url]</button>
                        <button type="button" @click="copyToClipboard(htmlUrl)" class="text-primary hover:underline">[copy html]</button>
                        <button type="button" @click="copyToClipboard(markdownUrl)" class="text-primary hover:underline">[copy md]</button>
                        <span class="text-outline" role="status" x-text="copied ? 'copied.' : ''"></span>
                    </div>
                </div>
            </div>
        </x-man-section>

        <x-man-section title="Caching">
            <p>Responses are cached for a day (max-age=86400), so repeat requests are fast.</p>
        </x-man-section>

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
