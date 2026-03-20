<x-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">Avatar Generator</h1>
            <p class="text-gray-600 dark:text-gray-400">Generate unique 5×5 identicon avatars from any seed string—same seed always produces the same pattern and color.</p>
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
                            GET /avatar/{seed}
                        </code>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 mt-3">Returns a deterministic SVG identicon. The seed can be any string (e.g. username or email).</p>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Parameters</h3>
                    <div class="space-y-2">
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">seed</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Path parameter—any string; hashed to build the pattern and foreground color</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">size</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Square size in pixels (default: 200, min: 16, max: 1024)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">bg</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Background hex color without # (default: f0f0f0)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">format</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Output format (default: svg; only svg is supported)</span>
                        </div>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Preview</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-6">
                        @foreach (['alice', 'bob', 'charlie', 'dave', 'eve', 'frank'] as $exampleSeed)
                            <div class="flex flex-col items-center gap-2">
                                <img
                                    src="{{ route('avatar.show', ['seed' => $exampleSeed]) }}?size=120"
                                    alt="Avatar for {{ $exampleSeed }}"
                                    width="120"
                                    height="120"
                                    class="rounded-lg shadow-md ring-1 ring-gray-200 dark:ring-gray-600"
                                />
                                <span class="text-xs font-mono text-gray-600 dark:text-gray-400">{{ $exampleSeed }}</span>
                            </div>
                        @endforeach
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Rate Limiting</h3>
                    <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                        <p class="text-gray-700 dark:text-gray-300 text-sm">This endpoint is rate-limited to 120 requests per minute to ensure fair usage.</p>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Try It Now</h3>
                    <a href="{{ route('avatar.show', ['seed' => 'placehold.cloud']) }}?size=256" target="_blank"
                       class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors shadow-lg">
                        <x-heroicon-o-bolt class="w-5 h-5 mr-2" />
                        Open sample avatar
                    </a>
                </section>
            </div>
        </div>
    </div>
</x-layout>
