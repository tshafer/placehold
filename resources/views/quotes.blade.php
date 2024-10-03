<x-layout>
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold mb-8 text-center text-white">Random Quotes API Documentation</h1>

        <div class="bg-white/10 backdrop-blur-md border border-white/20 p-8 rounded-2xl shadow-lg mb-8">
            <h2 class="text-2xl font-semibold mb-4 text-white">Endpoint</h2>
            <code class="block bg-gray-800 text-green-400 p-4 rounded">GET {{ route('quote') }}</code>
        </div>

        <div class="bg-white/10 backdrop-blur-md border border-white/20 p-8 rounded-2xl shadow-lg mb-8">
            <h2 class="text-2xl font-semibold mb-4 text-white">Response Format</h2>
            <pre class="bg-gray-800 text-green-400 p-4 rounded overflow-x-auto">
{
    "status": "success",
    "data": [
        {
            "_id": "IARxwjpiXK",
            "content": "I had three chairs in my house; one for solitude, two for friendship, three for society.",
            "author": "Henry David Thoreau",
            "tags": [
                "Friendship"
            ],
            "authorSlug": "henry-david-thoreau",
            "length": 88,
            "dateAdded": "2019-08-08",
            "dateModified": "2023-04-14"
        }
    ],
    "timestamp": "YYYY-MM-DD HH:MM:SS"
}
            </pre>
        </div>

        <div class="bg-white/10 backdrop-blur-md border border-white/20 p-8 rounded-2xl shadow-lg mb-8">
            <h2 class="text-2xl font-semibold mb-4 text-white">Example Usage</h2>
            <code class="block bg-gray-800 text-green-400 p-4 rounded mb-4">
GET {{ route('quote') }}
            </code>
            <p class="text-white/90">This request will return a random quote from the Quotable API.</p>
        </div>

        <div class="bg-white/10 backdrop-blur-md border border-white/20 p-8 rounded-2xl shadow-lg mb-8">
            <h2 class="text-2xl font-semibold mb-4 text-white">Rate Limiting</h2>
            <p class="text-white/90 mb-4">To ensure fair usage, this API is rate-limited. Please adhere to the following limits:</p>
            <ul class="list-disc list-inside text-white/90">
                <li>5 requests per second</li>
                <li>3600 requests per hour</li>
            </ul>
        </div>

        <div class="bg-white/10 backdrop-blur-md border border-white/20 p-8 rounded-2xl shadow-lg">
            <h2 class="text-2xl font-semibold mb-4 text-white">Error Handling</h2>
            <p class="text-white/90 mb-4">In case of an error, the API will return a JSON response with an error message:</p>
            <pre class="bg-gray-800 text-green-400 p-4 rounded overflow-x-auto">
{
    "status": "error",
    "message": "An error occurred while fetching the quote"
}
            </pre>
        </div>
    </div>
</x-layout>
