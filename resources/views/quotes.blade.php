<x-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">Random Quotes API</h1>
            <p class="text-gray-600 dark:text-gray-400">Get inspiring quotes with our free API</p>
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
                            GET {{ route('quote') }}
                        </code>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 mt-3">Returns a random quote from the Quotable API.</p>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Response Format</h3>
                    <div class="bg-gray-900 p-4 rounded-lg overflow-x-auto">
                        <pre class="text-green-400 text-sm font-mono"><code>{
  "status": "success",
  "data": [
    {
      "_id": "IARxwjpiXK",
      "content": "I had three chairs in my house; one for solitude, two for friendship, three for society.",
      "author": "Henry David Thoreau",
      "tags": ["Friendship"],
      "authorSlug": "henry-david-thoreau",
      "length": 88,
      "dateAdded": "2019-08-08",
      "dateModified": "2023-04-14"
    }
  ],
  "timestamp": "YYYY-MM-DD HH:MM:SS"
}</code></pre>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Rate Limiting</h3>
                    <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                        <p class="text-gray-700 dark:text-gray-300 text-sm">To ensure fair usage, this API is rate-limited:</p>
                        <ul class="list-disc list-inside mt-3 space-y-2 text-gray-700 dark:text-gray-300 text-sm ml-4">
                            <li><span class="font-semibold">5 requests</span> per second</li>
                            <li><span class="font-semibold">3600 requests</span> per hour</li>
                        </ul>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Error Handling</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">In case of an error, the API returns a JSON response with an error message:</p>
                    <div class="bg-gray-900 p-4 rounded-lg overflow-x-auto">
                        <pre class="text-green-400 text-sm font-mono"><code>{
  "status": "error",
  "message": "An error occurred while fetching the quote"
}</code></pre>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Try It Now</h3>
                    <a href="{{ route('quote') }}" target="_blank" 
                       class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors shadow-lg">
                        <x-heroicon-o-bolt class="w-5 h-5 mr-2" />
                        Test the API
                    </a>
                </section>
            </div>
        </div>
    </div>
</x-layout>
