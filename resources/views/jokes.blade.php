<x-layout>
    <div class="container mx-auto px-4 py-12">
        <div class="bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 dark:from-indigo-800 dark:via-purple-800 dark:to-pink-700 p-8 rounded-2xl shadow-lg bg-no-repeat bg-cover">
        <h1 class="text-6xl font-extrabold mb-8 text-center text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-pink-300 dark:from-blue-300 dark:to-pink-200">Jokes API</h1>

            <h2 class="text-3xl font-semibold mb-6 text-white dark:text-gray-200">Usage Guide</h2>
            <p class="text-xl text-white/90 dark:text-gray-300 mb-8">Get random jokes with our powerful API. Here's how to get started:</p>

            @php
                $jokeCount = \App\Models\Joke::count();
            @endphp
            <p class="text-2xl text-white/90 dark:text-gray-300 mb-8">Currently, we have {{ number_format($jokeCount) }} jokes in our database!</p>

            <div class="space-y-12">
                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white dark:text-gray-200">Basic Usage</h3>
                    <div class="bg-black/30 dark:bg-white/10 p-4 rounded-lg">
                        <code class="text-green-300 dark:text-green-400 text-sm break-all">
                            {{ route('joke') }}
                        </code>
                    </div>
                    <p class="text-white/90 dark:text-gray-300 mt-4">This request will return a random joke from our database.</p>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white dark:text-gray-200">Response Format</h3>
                    <div class="bg-black/30 dark:bg-white/10 p-4 rounded-lg">
                        <pre class="text-green-300 dark:text-green-400 text-sm overflow-x-auto">
{
    "body": "string",
    "title": "string",
    "category": "string",
    "rating": "string"
}
                        </pre>
                    </div>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white dark:text-gray-200">Example Usage</h3>
                    <div class="bg-black/30 dark:bg-white/10 p-4 rounded-lg">
                        <pre class="text-green-300 dark:text-green-400 text-sm overflow-x-auto">
fetch('{{ route('joke') }}')
    .then(response => response.json())
    .then(data => console.log(data))
    .catch(error => console.error('Error:', error));
                        </pre>
                    </div>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white dark:text-gray-200">Random Joke Example</h3>
                    <div class="bg-black/30 dark:bg-white/10 p-4 rounded-lg">
                        @php
                        $jokeService = app(\App\Services\JokeService::class);
                        $randomJoke = $jokeService->getRandomJoke();
                        @endphp
                        <pre class="text-green-300 dark:text-green-400 text-sm overflow-x-auto">
@json($randomJoke, JSON_PRETTY_PRINT)
                        </pre>
                    </div>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white dark:text-gray-200">Notes</h3>
                    <ul class="list-disc list-inside text-white/90 dark:text-gray-300 space-y-2 ml-4">
                        <li>Jokes are randomly selected from our database.</li>
                        <li>The response format includes body, title, category, and rating fields.</li>
                        <li>No authentication is required to use this endpoint.</li>
                        <li>The API adheres to rate limiting to prevent abuse. Please use responsibly.</li>
                    </ul>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white dark:text-gray-200">Error Handling</h3>
                    <p class="text-white/90 dark:text-gray-300 mb-4">In case of an error, the API will return an appropriate error response.</p>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white dark:text-gray-200">API Limits</h3>
                    <p class="text-white/90 dark:text-gray-300 mb-4">To ensure fair usage, this API is rate-limited. Please adhere to the following limits:</p>
                    <ul class="list-disc list-inside text-white/90 dark:text-gray-300 space-y-2 ml-4">
                        <li><span class="font-semibold">120 requests</span> per minute</li>
                    </ul>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white dark:text-gray-200">Category Filter</h3>
                    <p class="text-white/90 dark:text-gray-300 mb-4">You can filter jokes by category by adding a query parameter:</p>
                    <div class="bg-black/30 dark:bg-white/10 p-4 rounded-lg">
                        <code class="text-green-300 dark:text-green-400 text-sm break-all">
                            {{ route('joke') }}?category=YourCategory
                        </code>
                    </div>
                    <p class="text-white/90 dark:text-gray-300 mt-4">Replace 'YourCategory' with the desired category. Use 'Any' to get jokes from all categories.</p>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white dark:text-gray-200">Support</h3>
                    <p class="text-white/90 dark:text-gray-300 mb-4">For any issues or questions regarding the Jokes API, please contact our support team at support@placehold.cloud.</p>
                </section>
            </div>
        </div>
    </div>
</x-layout>
