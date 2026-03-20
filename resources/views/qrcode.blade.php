<x-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">QR Code Generator</h1>
            <p class="text-gray-600 dark:text-gray-400">
                Generate QR codes as SVG or PNG via a simple HTTP API—embed them in apps, docs, or print layouts.
            </p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-8">
            <div class="space-y-8">
                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white flex items-center">
                        <x-heroicon-o-command-line class="w-6 h-6 mr-2 text-gray-900 dark:text-white" />
                        Basic Usage
                    </h3>
                    <div class="bg-gray-900 p-4 rounded-lg">
                        <code class="text-green-400 text-sm break-all font-mono">
                            GET {{ url('/qr') }}?data=https://placehold.cloud&amp;size=300&amp;format=svg
                        </code>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 mt-3">
                        Returns an SVG by default. Add <code class="text-sm font-mono bg-gray-100 dark:bg-gray-900 px-1.5 py-0.5 rounded">format=png</code> for a raster image (requires GD).
                    </p>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Query Parameters</h3>
                    <div class="space-y-2">
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40 shrink-0">data</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Content to encode (required, max 2048 characters)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40 shrink-0">size</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Output size in pixels (50–1024, default: 300)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40 shrink-0">format</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1"><code class="font-mono">svg</code> or <code class="font-mono">png</code> (default: svg)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40 shrink-0">fg</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Foreground (module) color, 6-digit hex without # (default: 000000)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40 shrink-0">bg</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Background color, 6-digit hex without # (default: ffffff)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40 shrink-0">margin</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Quiet zone in modules (0–10, default: 2)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40 shrink-0">ecc</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Error correction: L, M, Q, or H (default: M)</span>
                        </div>
                    </div>
                </section>

                <section x-data="{ input: 'https://placehold.cloud' }">
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Live preview</h3>
                    <label for="qr-input" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">URL or text</label>
                    <input
                        id="qr-input"
                        type="text"
                        x-model="input"
                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 mb-6"
                        autocomplete="off"
                    />
                    <div class="flex justify-center p-6 bg-gray-50 dark:bg-gray-900/50 rounded-xl border border-gray-200 dark:border-gray-700">
                        <img
                            :src="'/qr?data=' + encodeURIComponent(input) + '&size=250'"
                            alt="QR code preview"
                            class="max-w-full h-auto rounded-lg shadow-sm bg-white"
                            width="250"
                            height="250"
                        />
                    </div>
                </section>

                <section>
                    <a
                        href="{{ url('/api') }}"
                        class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors shadow-lg"
                    >
                        <x-heroicon-o-bolt class="w-5 h-5 mr-2" />
                        View full API documentation
                    </a>
                </section>
            </div>
        </div>
    </div>
</x-layout>
