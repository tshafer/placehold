<x-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">Recipe API</h1>
            <p class="text-gray-600 dark:text-gray-400">Discover delicious recipes from around the world</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-8">
            <div class="space-y-8">
                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white flex items-center">
                        <svg class="w-6 h-6 mr-2 text-gray-900 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        Basic Usage
                    </h3>
                    <div class="bg-gray-900 p-4 rounded-lg">
                        <code class="text-green-400 text-sm break-all font-mono">
                            GET {{ route('recipe') }}
                        </code>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 mt-3">Returns random recipes from our database.</p>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Query Parameters</h3>
                    <div class="space-y-2">
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">query</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Search query for recipes (optional)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">category</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Recipe category (optional)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">number</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Number of recipes (1-25, default: 10) (optional)</span>
                        </div>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Example Usage</h3>
                    <div class="bg-gray-900 p-4 rounded-lg mb-4">
                        <code class="text-green-400 text-sm break-all font-mono">
                            GET {{ route('recipe', ['number' => 5, 'category' => 'Dessert']) }}
                        </code>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400">Returns 5 random dessert recipes.</p>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Rate Limiting</h3>
                    <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                        <p class="text-gray-700 dark:text-gray-300 text-sm">60 requests per minute, 1000 requests per day</p>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Try It Now</h3>
                    <a href="{{ route('recipe') }}" target="_blank" 
                       class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        Get Random Recipes
                    </a>
                </section>
            </div>
        </div>
    </div>
</x-layout>
