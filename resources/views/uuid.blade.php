<x-layout>
    <div class="max-w-4xl text-[15px] leading-relaxed">
        <span class="text-tertiary font-headline font-bold text-xs tracking-wide uppercase mb-4 block">UUID(1)</span>
        <h1 class="sr-only">UUID Generator</h1>

        <x-man-section title="Name">
            <p>uuid — generate RFC 4122 UUIDs, version 4 (random) or 7 (time-ordered)</p>
        </x-man-section>

        <x-man-section title="Synopsis">
            <div class="code-block break-all">GET {{ url('/uuid') }} [?count=<u>n</u>] [&amp;version=4|7] [&amp;uppercase=true] [&amp;nodashes=true]</div>
        </x-man-section>

        <x-man-section title="Options">
            <dl class="space-y-3">
                <div><dt class="font-bold text-primary">count</dt><dd class="ml-6">Number of UUIDs to generate, 1–100. Default 1.</dd></div>
                <div><dt class="font-bold text-primary">version</dt><dd class="ml-6">4 (random) or 7 (time-ordered). Default 4.</dd></div>
                <div><dt class="font-bold text-primary">uppercase</dt><dd class="ml-6">Return uppercase hex. Default false.</dd></div>
                <div><dt class="font-bold text-primary">nodashes</dt><dd class="ml-6">Strip the dashes. Default false.</dd></div>
            </dl>
        </x-man-section>

        <x-man-section title="Examples">
            <div class="space-y-4 break-all">
                <div><p class="text-outline">One UUID:</p><p class="ml-6"><span class="text-outline">$</span> curl {{ url('/uuid') }}</p></div>
                <div><p class="text-outline">Five at once:</p><p class="ml-6"><span class="text-outline">$</span> curl "{{ url('/uuid') }}?count=5"</p></div>
                <div><p class="text-outline">Three uppercase v7 UUIDs:</p><p class="ml-6"><span class="text-outline">$</span> curl "{{ url('/uuid') }}?count=3&amp;version=7&amp;uppercase=true"</p></div>
            </div>
        </x-man-section>

        <x-man-section title="Output">
            <pre class="code-block">{
  "count": 3,
  "version": 4,
  "uuids": [
    "f47ac10b-58cc-4372-a567-0e02b2c3d479",
    "7c9e6679-7425-40de-944b-e07fc1f90ae7",
    "550e8400-e29b-41d4-a716-446655440000"
  ]
}</pre>
        </x-man-section>

        <x-man-section title="Try it" x-data="{
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
            <div class="space-y-4">
                <div class="flex flex-wrap items-center gap-4">
                    <label for="uuid-count" class="font-bold">count</label>
                    <input id="uuid-count" type="range" x-model="count" min="1" max="100" class="flex-1 min-w-40 accent-primary" />
                    <input type="number" x-model="count" min="1" max="100" aria-label="Count"
                           class="w-20 bg-surface-container-lowest border border-outline-variant text-on-surface px-3 py-2 text-sm text-center focus:outline-none focus:border-on-surface" />
                </div>

                <fieldset class="flex flex-wrap gap-x-6 gap-y-2 items-center">
                    <legend class="font-bold float-left mr-6">version</legend>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" x-model="version" value="4" class="accent-primary" /> 4
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" x-model="version" value="7" class="accent-primary" /> 7
                    </label>
                </fieldset>

                <div class="flex flex-wrap gap-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" x-model="uppercase" class="accent-primary" /> uppercase
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" x-model="nodashes" class="accent-primary" /> nodashes
                    </label>
                </div>

                <button type="button" @click="run()" :disabled="loading"
                        class="liquid-chrome text-on-primary-container px-5 py-3 font-bold text-sm hover:opacity-80 transition-opacity">
                    <span x-text="loading ? 'Running…' : 'Run'"></span>
                </button>

                <template x-if="result">
                    <pre class="code-block" x-text="JSON.stringify(result, null, 2)"></pre>
                </template>
            </div>
        </x-man-section>

        <x-man-section title="Limits">
            <p>120 requests per minute per IP.</p>
        </x-man-section>
    </div>
</x-layout>
