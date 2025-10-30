<x-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">Random Jokes API</h1>
            <p class="text-gray-600 dark:text-gray-400">Lighten up your day with random jokes</p>
        </div>

        @php
            $jokeCount = \App\Models\Joke::count();
        @endphp

        @if($jokeCount > 0)
        <div class="bg-primary-50 dark:bg-primary-900/20 border border-primary-200 dark:border-primary-800 rounded-xl p-6 mb-8">
            <div class="flex items-center">
                <svg class="w-12 h-12 mr-4 text-gray-900 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                </svg>
                <div>
                    <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($jokeCount) }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Jokes in our database</div>
                </div>
            </div>
        </div>
        @endif

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
                            GET {{ route('joke') }}
                        </code>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 mt-3">Returns a random joke from our database.</p>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Response Format</h3>
                    <div class="bg-gray-900 p-4 rounded-lg overflow-x-auto">
                        <pre class="text-green-400 text-sm font-mono"><code>{
  "body": "Why did the scarecrow win an award?",
  "title": "Scarecrow Award",
  "category": "general",
  "rating": "PG"
}</code></pre>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Random Joke Example</h3>
                    @php
                    try {
                        $jokeService = app(\App\Services\JokeService::class);
                        $randomJoke = $jokeService->getRandomJoke();
                    } catch (\Exception $e) {
                        $randomJoke = null;
                    }
                    @endphp
                    @if($randomJoke)
                    <div class="bg-gray-900 p-4 rounded-lg overflow-x-auto">
                        <pre class="text-green-400 text-sm font-mono">@json($randomJoke, JSON_PRETTY_PRINT)</pre>
                    </div>
                    @else
                    <div class="bg-gray-900 p-4 rounded-lg">
                        <p class="text-green-400 text-sm">Run the jokes seeder to see an example!</p>
                    </div>
                    @endif
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Rate Limiting</h3>
                    <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                        <p class="text-gray-700 dark:text-gray-300 text-sm">120 requests per minute</p>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Try It Now</h3>
                    <a href="{{ route('joke') }}" target="_blank" 
                       class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        Get a Random Joke
                    </a>
                </section>
            </div>
        </div>
    </div>
</x-layout>
