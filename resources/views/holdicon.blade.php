<x-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">Holdicon API</h1>
            <p class="text-gray-600 dark:text-gray-400">Create custom placeholder icons with text, robots, cats, or dogs</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-8">
            <div class="space-y-8">
                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white flex items-center">
                        <x-heroicon-o-command-line class="w-6 h-6 mr-2 text-gray-900 dark:text-white" />
                        Endpoint
                    </h3>
                    <div class="bg-gray-900 p-4 rounded-lg">
                        <code class="text-green-400 text-sm break-all font-mono">
                            GET {{ route('holdicon') }}
                        </code>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 mt-3">Generates customizable placeholder images with optional text, icons, or animal shapes.</p>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Parameters</h3>
                    <div class="space-y-2">
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">width</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Width in pixels (default: 128)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">height</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Height in pixels (default: 128)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">background_color</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Hex color code (default: random)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">text</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Text to display (default: random 2 letters)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">robot/cat/dog</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Generate robot, cat, or dog icon (boolean)</span>
                        </div>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Example Usage</h3>
                    <div class="space-y-6">
                        <div>
                            <p class="text-gray-700 dark:text-gray-300 mb-2 font-medium">Custom text icon:</p>
                            <div class="bg-gray-900 p-4 rounded-lg mb-3">
                                <code class="text-green-400 text-sm break-all font-mono">
                                    {{ route('holdicon') }}?width=200&height=200&background_color=FF0000&text_color=FFFFFF&text=AB
                                </code>
                            </div>
                            <img src="{{ route('holdicon') }}?width=200&height=200&background_color=FF0000&text_color=FFFFFF&text=AB" alt="Example 1" class="rounded-lg shadow-md">
                        </div>

                        <div>
                            <p class="text-gray-700 dark:text-gray-300 mb-2 font-medium">Robot icon:</p>
                            <div class="bg-gray-900 p-4 rounded-lg mb-3">
                                <code class="text-green-400 text-sm break-all font-mono">
                                    {{ route('holdicon') }}?width=150&height=150&robot=true
                                </code>
                            </div>
                            <img src="{{ route('holdicon') }}?width=150&height=150&robot=true" alt="Example 2" class="rounded-lg shadow-md">
                        </div>

                        <div>
                            <p class="text-gray-700 dark:text-gray-300 mb-2 font-medium">Cat icon:</p>
                            <div class="bg-gray-900 p-4 rounded-lg mb-3">
                                <code class="text-green-400 text-sm break-all font-mono">
                                    {{ route('holdicon') }}?width=180&height=180&cat=true&background_color=00FF00&text_color=000000
                                </code>
                            </div>
                            <img src="{{ route('holdicon') }}?width=180&height=180&cat=true&background_color=00FF00&text_color=000000" alt="Example 3" class="rounded-lg shadow-md">
                        </div>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Rate Limiting</h3>
                    <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                        <p class="text-gray-700 dark:text-gray-300 text-sm">120 requests per minute</p>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Try It Now</h3>
                    <a href="{{ route('holdicon') }}?width=128&height=128&text=HI" target="_blank" 
                       class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors shadow-lg">
                        <x-heroicon-o-bolt class="w-5 h-5 mr-2" />
                        Generate Holdicon
                    </a>
                </section>
            </div>
        </div>
    </div>
</x-layout>
