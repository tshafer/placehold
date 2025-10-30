<x-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">Weather API</h1>
            <p class="text-gray-600 dark:text-gray-400">Get accurate weather data for any location</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-8">
            <div class="space-y-8">
                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white flex items-center">
                        <svg class="w-6 h-6 mr-2 text-gray-900 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/>
                        </svg>
                        Basic Usage
                    </h3>
                    <div class="bg-gray-900 p-4 rounded-lg">
                        <code class="text-green-400 text-sm break-all font-mono">
                            GET {{ route('weather', ['city' => 'London', 'country' => 'GB']) }}
                        </code>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 mt-3">Returns weather data for London, UK.</p>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Query Parameters</h3>
                    <div class="space-y-2">
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">city</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Name of the city (required)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">country</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Two-letter country code (required)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">units</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Units (metric, imperial, standard) (optional)</span>
                        </div>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Example Usage</h3>
                    <div class="bg-gray-900 p-4 rounded-lg mb-4">
                        <code class="text-green-400 text-sm break-all font-mono">
                            GET {{ route('weather', ['city' => 'London', 'country' => 'GB', 'units' => 'metric', 'forecast_days' => 3]) }}
                        </code>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400">Returns weather data for London, UK, in metric units with 3-day forecast.</p>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Rate Limiting</h3>
                    <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                        <p class="text-gray-700 dark:text-gray-300 text-sm">To ensure fair usage:</p>
                        <ul class="list-disc list-inside mt-3 space-y-2 text-gray-700 dark:text-gray-300 text-sm ml-4">
                            <li><span class="font-semibold">60 requests</span> per minute</li>
                            <li><span class="font-semibold">1000 requests</span> per day</li>
                        </ul>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Try It Now</h3>
                    <a href="{{ route('weather', ['city' => 'London', 'country' => 'GB']) }}" target="_blank" 
                       class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        Get Weather Data
                    </a>
                </section>
            </div>
        </div>
    </div>
</x-layout>
