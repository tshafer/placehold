<x-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">Colors API</h1>
            <p class="text-gray-600 dark:text-gray-400">Generate color palettes, hex codes, and named colors</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-8">
            <div class="space-y-8">
                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white flex items-center">
                        <svg class="w-6 h-6 mr-2 text-gray-900 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 0 002-2V6a2 0 00-2-2H5a2 0 00-2 2v12a2 0 002 2z"/>
                        </svg>
                        Basic Usage
                    </h3>
                    <div class="bg-gray-900 p-4 rounded-lg">
                        <code class="text-green-400 text-sm break-all font-mono">
                            GET {{ route('colors') }}
                        </code>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 mt-3">Returns a random color palette by default.</p>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Query Parameters</h3>
                    <div class="space-y-2">
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">type</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Type of color data: palette, hex, or named (default: palette)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">count</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Number of results (1-10, default: 5)</span>
                        </div>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Example Usage</h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-gray-700 dark:text-gray-300 mb-2 font-medium">Color Palette:</p>
                            <div class="bg-gray-900 p-4 rounded-lg mb-4">
                                <code class="text-green-400 text-sm break-all font-mono">
                                    GET {{ route('colors', ['type' => 'palette', 'count' => 3]) }}
                                </code>
                            </div>
                        </div>
                        <div>
                            <p class="text-gray-700 dark:text-gray-300 mb-2 font-medium">Random Hex Colors:</p>
                            <div class="bg-gray-900 p-4 rounded-lg mb-4">
                                <code class="text-green-400 text-sm break-all font-mono">
                                    GET {{ route('colors', ['type' => 'hex', 'count' => 5]) }}
                                </code>
                            </div>
                        </div>
                        <div>
                            <p class="text-gray-700 dark:text-gray-300 mb-2 font-medium">Named Colors:</p>
                            <div class="bg-gray-900 p-4 rounded-lg mb-4">
                                <code class="text-green-400 text-sm break-all font-mono">
                                    GET {{ route('colors', ['type' => 'named', 'count' => 8]) }}
                                </code>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Response Format</h3>
                    <div class="space-y-6">
                        <div>
                            <p class="text-gray-700 dark:text-gray-300 mb-2 font-medium">Color Palette Response:</p>
                            <div class="bg-gray-900 p-4 rounded-lg overflow-x-auto">
                                <pre class="text-green-400 text-sm font-mono"><code>{
  "status": "success",
  "type": "palette",
  "count": 3,
  "data": [
    {
      "name": "Ocean Breeze",
      "colors": ["#2E86AB", "#A23B72", "#F18F01", "#C73E1D", "#E8E9EB"]
    },
    {
      "name": "Sunset Vibes",
      "colors": ["#F94144", "#F3722C", "#F8961E", "#F9C74F", "#90BE6D"]
    },
    {
      "name": "Forest Green",
      "colors": ["#264653", "#2A9D8F", "#E9C46A", "#F4A261", "#E76F51"]
    }
  ],
  "timestamp": "2025-01-30 12:00:00"
}</code></pre>
                            </div>
                        </div>
                        <div>
                            <p class="text-gray-700 dark:text-gray-300 mb-2 font-medium">Named Colors Response:</p>
                            <div class="bg-gray-900 p-4 rounded-lg overflow-x-auto">
                                <pre class="text-green-400 text-sm font-mono"><code>{
  "status": "success",
  "type": "named",
  "count": 3,
  "data": [
    {
      "name": "Crimson Red",
      "hex": "#DC143C",
      "rgb": [220, 20, 60],
      "category": "red"
    },
    {
      "name": "Ocean Blue",
      "hex": "#006994",
      "rgb": [0, 105, 148],
      "category": "blue"
    }
  ],
  "timestamp": "2025-01-30 12:00:00"
}</code></pre>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Rate Limiting</h3>
                    <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                        <p class="text-gray-700 dark:text-gray-300 text-sm">This endpoint is rate-limited to 120 requests per minute to ensure fair usage.</p>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Error Handling</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">In case of an error, the API returns a JSON response with an error message:</p>
                    <div class="bg-gray-900 p-4 rounded-lg overflow-x-auto">
                        <pre class="text-green-400 text-sm font-mono"><code>{
  "status": "error",
  "message": "Invalid type. Use: palette, hex, or named"
}</code></pre>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Try It Now</h3>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('colors', ['type' => 'palette']) }}" target="_blank" 
                           class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            Test Palette
                        </a>
                        <a href="{{ route('colors', ['type' => 'hex', 'count' => 5]) }}" target="_blank" 
                           class="inline-flex items-center px-6 py-3 bg-gray-900 dark:bg-gray-700 hover:bg-gray-800 dark:hover:bg-gray-600 text-white font-medium rounded-lg transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            Test Hex
                        </a>
                        <a href="{{ route('colors', ['type' => 'named', 'count' => 5]) }}" target="_blank" 
                           class="inline-flex items-center px-6 py-3 bg-gray-900 dark:bg-gray-700 hover:bg-gray-800 dark:hover:bg-gray-600 text-white font-medium rounded-lg transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            Test Named
                        </a>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-layout>

