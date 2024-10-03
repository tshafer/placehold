<x-layout>
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold mb-6 text-center text-white">Jokes API Documentation</h1>

        <div class="bg-white/10 backdrop-blur-md border border-white/20 p-8 rounded-2xl shadow-lg">
            <h2 class="text-2xl font-semibold mb-4 text-white">Endpoint</h2>
            <p class="text-white/80 mb-4">GET {{ route('joke') }}</p>

            <h2 class="text-2xl font-semibold mb-4 text-white">Description</h2>
            <p class="text-white/80 mb-4">This endpoint returns a random joke from various categories. The jokes are sourced from an external API and cached for improved performance.</p>

            <h2 class="text-2xl font-semibold mb-4 text-white">Response Format</h2>
            <pre class="bg-gray-800 text-green-400 p-4 rounded-lg overflow-x-auto">
{
    "joke": "string" // For single-part jokes
    // OR
    "setup": "string",
    "delivery": "string" // For two-part jokes
}
            </pre>

            <h2 class="text-2xl font-semibold mt-6 mb-4 text-white">Example Usage</h2>
            <pre class="bg-gray-800 text-blue-400 p-4 rounded-lg overflow-x-auto">
fetch('{{ route('joke') }}')
    .then(response => response.json())
    .then(data => console.log(data))
    .catch(error => console.error('Error:', error));
            </pre>

            <h2 class="text-2xl font-semibold mt-6 mb-4 text-white">Notes</h2>
            <ul class="list-disc list-inside text-white/80">
                <li>The API uses caching to improve performance and reduce load on the external joke service.</li>
                <li>If the external joke API is unavailable, a fallback joke is returned to ensure continuous service.</li>
                <li>Jokes are randomly selected from a pool of {{ \App\Http\Controllers\JokesController::MAX_JOKE_ID }} jokes.</li>
                <li>The response format may vary between single-part and two-part jokes.</li>
                <li>No authentication is required to use this endpoint.</li>
                <li>The API adheres to rate limiting to prevent abuse. Please use responsibly.</li>
            </ul>

            <h2 class="text-2xl font-semibold mt-6 mb-4 text-white">Error Handling</h2>
            <p class="text-white/80 mb-4">In case of an error, the API will return an appropriate Joke.</p>

            <h2 class="text-2xl font-semibold mt-6 mb-4 text-white">Support</h2>
            <p class="text-white/80 mb-4">For any issues or questions regarding the Jokes API, please contact our support team at support@placehold.cloud.</p>
        </div>
    </div>
</x-layout>
