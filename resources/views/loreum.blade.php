<x-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">Lorem Ipsum Generator API</h1>
            <p class="text-gray-600 dark:text-gray-400">Generate custom placeholder text for your designs</p>
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
                            GET {{ url('/l') }}
                        </code>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 mt-3">Generates 3 paragraphs of Lorem Ipsum text by default.</p>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Parameters</h3>
                    <div class="space-y-2">
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-32">paragraphs</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm">Number of paragraphs (1-100, default: 3)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-32">minWords</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm">Minimum words per paragraph (1-100, default: 5)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-32">maxWords</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm">Maximum words per paragraph (1-100, default: 20)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-32">format</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm">Output format (json/html/text, default: json)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-32">seed</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm">Seed for random generation (optional)</span>
                        </div>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Example</h3>
                    <div class="bg-gray-900 p-4 rounded-lg mb-4">
                        <code class="text-green-400 text-sm break-all font-mono">
                            {{ url('/l?paragraphs=2&minWords=10&maxWords=15&format=html&capitalize=false&addPunctuation=true') }}
                        </code>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400">Generates 2 paragraphs, each with 10-15 words, in HTML format.</p>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Response Format</h3>
                    <div class="bg-gray-900 p-4 rounded-lg overflow-x-auto">
                        <pre class="text-green-400 text-sm font-mono"><code>{
  "status": "success",
  "data": [ ... ],
  "metadata": {
    "paragraphs": 3,
    "minWords": 5,
    "maxWords": 20,
    "totalWords": 45,
    "format": "json",
    "seed": 12345
  }
}</code></pre>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Try It Now</h3>
                    <a href="{{ url('/l') }}" target="_blank" 
                       class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors shadow-lg">
                        <x-heroicon-o-bolt class="w-5 h-5 mr-2" />
                        Generate Lorem Ipsum
                    </a>
                </section>
            </div>
        </div>
    </div>
</x-layout>
