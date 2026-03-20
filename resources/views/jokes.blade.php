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
                <x-heroicon-o-light-bulb class="w-12 h-12 mr-4 text-gray-900 dark:text-white" />
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
                        <x-heroicon-o-command-line class="w-6 h-6 mr-2 text-gray-900 dark:text-white" />
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
                        <x-heroicon-o-bolt class="w-5 h-5 mr-2" />
                        Get a Random Joke
                    </a>
                </section>
            </div>
        </div>
    </div>
</x-layout>
