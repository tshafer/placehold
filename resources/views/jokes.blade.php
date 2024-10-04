<x-layout>
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-6xl font-extrabold mb-8 text-center text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-pink-300">Jokes API</h1>

        <div class="bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 p-8 rounded-2xl shadow-lg bg-no-repeat bg-cover">
            <h2 class="text-3xl font-semibold mb-6 text-white">Usage Guide</h2>
            <p class="text-xl text-white/90 mb-8">Get random jokes with our powerful API. Here's how to get started:</p>

            <div class="space-y-12">
                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white">Basic Usage</h3>
                    <div class="bg-black/30 p-4 rounded-lg">
                        <code class="text-green-300 text-sm break-all">
                            {{ route('joke') }}
                        </code>
                    </div>
                    <p class="text-white/90 mt-4">This request will return a random joke from our database.</p>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white">Response Format</h3>
                    <div class="bg-black/30 p-4 rounded-lg">
                        <pre class="text-green-300 text-sm overflow-x-auto">
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
                    <h3 class="text-2xl font-semibold mb-4 text-white">Example Usage</h3>
                    <div class="bg-black/30 p-4 rounded-lg">
                        <pre class="text-green-300 text-sm overflow-x-auto">
fetch('{{ route('joke') }}')
    .then(response => response.json())
    .then(data => console.log(data))
    .catch(error => console.error('Error:', error));
                        </pre>
                    </div>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white">Random Joke Example</h3>
                    <div class="bg-black/30 p-4 rounded-lg">
                        @php
                        $jokeService = app(\App\Services\JokeService::class);
                        $randomJoke = $jokeService->getRandomJoke();
                        @endphp
                        <pre class="text-green-300 text-sm overflow-x-auto">
@json($randomJoke, JSON_PRETTY_PRINT)
                        </pre>
                    </div>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white">Notes</h3>
                    <ul class="list-disc list-inside text-white/90 space-y-2 ml-4">
                        <li>Jokes are randomly selected from our database.</li>
                        <li>The response format includes body, title, category, and rating fields.</li>
                        <li>No authentication is required to use this endpoint.</li>
                        <li>The API adheres to rate limiting to prevent abuse. Please use responsibly.</li>
                    </ul>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white">Error Handling</h3>
                    <p class="text-white/90 mb-4">In case of an error, the API will return an appropriate error response.</p>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white">API Limits</h3>
                    <p class="text-white/90 mb-4">To ensure fair usage, this API is rate-limited. Please adhere to the following limits:</p>
                    <ul class="list-disc list-inside text-white/90 space-y-2 ml-4">
                        <li><span class="font-semibold">120 requests</span> per minute</li>
                    </ul>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white">Category Filter</h3>
                    <p class="text-white/90 mb-4">You can filter jokes by category by adding a query parameter:</p>
                    <div class="bg-black/30 p-4 rounded-lg">
                        <code class="text-green-300 text-sm break-all">
                            {{ route('joke') }}?category=YourCategory
                        </code>
                    </div>
                    <p class="text-white/90 mt-4">Replace 'YourCategory' with the desired category. Use 'Any' to get jokes from all categories.</p>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white">Support</h3>
                    <p class="text-white/90 mb-4">For any issues or questions regarding the Jokes API, please contact our support team at support@placehold.cloud.</p>
                </section>
            </div>
        </div>
    </div>
</x-layout>
