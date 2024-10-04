<x-layout>
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-6xl font-extrabold mb-8 text-center text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-pink-300">Random Quotes API</h1>

        <div class="bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 p-8 rounded-2xl shadow-lg bg-no-repeat bg-cover">
            <h2 class="text-3xl font-semibold mb-6 text-white">Usage Guide</h2>
            <p class="text-xl text-white/90 mb-8">Get random quotes with our powerful API. Here's how to get started:</p>

            <div class="space-y-12">
                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white">Basic Usage</h3>
                    <div class="bg-black/30 p-4 rounded-lg">
                        <code class="text-green-300 text-sm break-all">
                            {{ route('quote') }}
                        </code>
                    </div>
                    <p class="text-white/90 mt-4">This request will return a random quote from the Quotable API.</p>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white">Response Format</h3>
                    <div class="bg-black/30 p-4 rounded-lg">
                        <pre class="text-green-300 text-sm overflow-x-auto">
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
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white">Rate Limiting</h3>
                    <p class="text-white/90 mb-4">To ensure fair usage, this API is rate-limited. Please adhere to the following limits:</p>
                    <ul class="list-disc list-inside text-white/90 space-y-2 ml-4">
                        <li><span class="font-semibold">5 requests</span> per second</li>
                        <li><span class="font-semibold">3600 requests</span> per hour</li>
                    </ul>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white">Error Handling</h3>
                    <p class="text-white/90 mb-4">In case of an error, the API will return a JSON response with an error message:</p>
                    <div class="bg-black/30 p-4 rounded-lg">
                        <pre class="text-green-300 text-sm overflow-x-auto">
{
    "status": "error",
    "message": "An error occurred while fetching the quote"
}
                        </pre>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-layout>
