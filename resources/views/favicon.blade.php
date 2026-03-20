<x-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">Favicon Generator</h1>
            <p class="text-gray-600 dark:text-gray-400 max-w-3xl">
                Generate simple letter or emoji favicons as scalable SVGs. Use them as site icons, PWA icons, or quick
                brand placeholders—no image editor required.
            </p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-8">
            <div class="space-y-8">
                <section>
                    <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white flex items-center">
                        <x-heroicon-o-command-line class="w-6 h-6 mr-2 text-gray-900 dark:text-white" />
                        Basic usage
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-3">Request the endpoint with optional query parameters. The response is an SVG with long-lived caching.</p>
                    <div class="bg-gray-900 p-4 rounded-lg">
                        <code class="text-green-400 text-sm break-all font-mono">
                            GET {{ route('favicon') }}
                        </code>
                    </div>
                </section>

                <section>
                    <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Parameters</h2>
                    <div class="space-y-2">
                        <div class="flex flex-col sm:flex-row gap-2 sm:gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white sm:w-40 shrink-0">text</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Letter(s) or emoji (default: <span class="font-mono">P</span>, max 2 characters)</span>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-2 sm:gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white sm:w-40 shrink-0">size</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Pixel size (default: 64, min 16, max 512)</span>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-2 sm:gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white sm:w-40 shrink-0">bg</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Background hex color without <span class="font-mono">#</span> (default: <span class="font-mono">6366f1</span>)</span>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-2 sm:gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white sm:w-40 shrink-0">fg</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Foreground hex color without <span class="font-mono">#</span> (default: <span class="font-mono">ffffff</span>)</span>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-2 sm:gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white sm:w-40 shrink-0">radius</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Corner radius as percent of size (default: 12, 0–50; 50 is a circle)</span>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-2 sm:gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white sm:w-40 shrink-0">format</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Output format (default: <span class="font-mono">svg</span>; only SVG is supported today)</span>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-2 sm:gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white sm:w-40 shrink-0">font</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">CSS <span class="font-mono">font-family</span> value (default: <span class="font-mono">sans-serif</span>)</span>
                        </div>
                    </div>
                </section>

                <section>
                    <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Preview</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                        <div class="flex flex-col items-center gap-2 p-4 bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700">
                            <img src="{{ route('favicon', ['text' => 'A', 'size' => 96, 'bg' => '6366f1', 'fg' => 'ffffff']) }}" alt="Favicon A" class="w-24 h-24 rounded-lg shadow-md ring-1 ring-gray-200 dark:ring-gray-600">
                            <span class="text-xs font-mono text-gray-600 dark:text-gray-400">A</span>
                        </div>
                        <div class="flex flex-col items-center gap-2 p-4 bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700">
                            <img src="{{ route('favicon', ['text' => 'B', 'size' => 96, 'bg' => '0ea5e9', 'fg' => 'ffffff']) }}" alt="Favicon B" class="w-24 h-24 rounded-lg shadow-md ring-1 ring-gray-200 dark:ring-gray-600">
                            <span class="text-xs font-mono text-gray-600 dark:text-gray-400">B · sky</span>
                        </div>
                        <div class="flex flex-col items-center gap-2 p-4 bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700">
                            <img src="{{ route('favicon', ['text' => 'Z', 'size' => 96, 'bg' => 'f43f5e', 'fg' => 'ffffff']) }}" alt="Favicon Z" class="w-24 h-24 rounded-lg shadow-md ring-1 ring-gray-200 dark:ring-gray-600">
                            <span class="text-xs font-mono text-gray-600 dark:text-gray-400">Z · rose</span>
                        </div>
                        <div class="flex flex-col items-center gap-2 p-4 bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700">
                            <img src="{{ route('favicon', ['text' => 'AB', 'size' => 96, 'bg' => '6366f1', 'fg' => 'ffffff']) }}" alt="Favicon AB" class="w-24 h-24 rounded-lg shadow-md ring-1 ring-gray-200 dark:ring-gray-600">
                            <span class="text-xs font-mono text-gray-600 dark:text-gray-400">AB</span>
                        </div>
                        <div class="flex flex-col items-center gap-2 p-4 bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700">
                            <img src="{{ route('favicon', ['text' => 'Hi', 'size' => 96, 'bg' => '22c55e', 'fg' => 'ffffff']) }}" alt="Favicon Hi" class="w-24 h-24 rounded-lg shadow-md ring-1 ring-gray-200 dark:ring-gray-600">
                            <span class="text-xs font-mono text-gray-600 dark:text-gray-400">Hi · green</span>
                        </div>
                        <div class="flex flex-col items-center gap-2 p-4 bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700">
                            <img src="{{ route('favicon', ['text' => 'P', 'size' => 96, 'bg' => '18181b', 'fg' => 'fafafa', 'radius' => 50]) }}" alt="Favicon P circle" class="w-24 h-24 rounded-lg shadow-md ring-1 ring-gray-200 dark:ring-gray-600">
                            <span class="text-xs font-mono text-gray-600 dark:text-gray-400">P · circle</span>
                        </div>
                        <div class="flex flex-col items-center gap-2 p-4 bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700">
                            <img src="{{ route('favicon', ['text' => '✨', 'size' => 96, 'bg' => '7c3aed', 'fg' => 'ffffff']) }}" alt="Favicon emoji" class="w-24 h-24 rounded-lg shadow-md ring-1 ring-gray-200 dark:ring-gray-600">
                            <span class="text-xs font-mono text-gray-600 dark:text-gray-400">emoji</span>
                        </div>
                        <div class="flex flex-col items-center gap-2 p-4 bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700">
                            <img src="{{ route('favicon', ['text' => 'λ', 'size' => 96, 'bg' => 'eab308', 'fg' => '1c1917']) }}" alt="Favicon lambda" class="w-24 h-24 rounded-lg shadow-md ring-1 ring-gray-200 dark:ring-gray-600">
                            <span class="text-xs font-mono text-gray-600 dark:text-gray-400">λ · amber</span>
                        </div>
                    </div>
                </section>

                <section>
                    <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">How to use</h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-3">Add a <span class="font-mono text-sm">link</span> tag in your HTML <span class="font-mono text-sm">head</span>:</p>
                    <div class="bg-gray-900 p-4 rounded-lg overflow-x-auto">
                        <code class="text-green-400 text-sm font-mono whitespace-pre">&lt;link rel="icon" type="image/svg+xml" href="https://placehold.cloud/favicon?text=P&amp;bg=6366f1"&gt;</code>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 mt-3 text-sm">Swap the domain for your own when self-hosting, or point directly at placehold.cloud for quick prototypes.</p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Try it</h2>
                    <a href="{{ route('favicon', ['text' => 'P', 'bg' => '6366f1', 'fg' => 'ffffff', 'size' => 128]) }}" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors shadow-lg">
                        <x-heroicon-o-bolt class="w-5 h-5 mr-2" />
                        Open favicon URL
                    </a>
                </section>
            </div>
        </div>
    </div>
</x-layout>
