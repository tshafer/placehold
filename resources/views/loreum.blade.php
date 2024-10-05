<x-layout>
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-6xl font-extrabold mb-8 text-center text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-pink-300 dark:from-blue-300 dark:to-pink-200">Lorem Ipsum Generator API</h1>

        <div class="bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 dark:from-indigo-800 dark:via-purple-800 dark:to-pink-700 p-8 rounded-2xl shadow-lg bg-no-repeat bg-cover">
            <h2 class="text-3xl font-semibold mb-6 text-white dark:text-gray-200">Usage Guide</h2>
            <p class="text-xl text-white/90 dark:text-gray-300 mb-8">Generate custom Lorem Ipsum text with our powerful API. Here's how to get started:</p>

            <div class="space-y-12">
                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white dark:text-gray-200">Basic Usage</h3>
                    <div class="bg-black/30 dark:bg-white/10 p-4 rounded-lg">
                        <code class="text-green-300 dark:text-green-400 text-sm break-all">
                            {{ url('/l') }}
                        </code>
                    </div>
                    <p class="text-white/90 dark:text-gray-300 mt-4">This will generate 3 paragraphs of Lorem Ipsum text by default.</p>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white dark:text-gray-200">Parameters</h3>
                    <ul class="list-disc list-inside text-white/90 dark:text-gray-300 space-y-2 ml-4">
                        <li><span class="font-semibold">paragraphs</span>: Number of paragraphs (1-100, default: 3)</li>
                        <li><span class="font-semibold">minWords</span>: Minimum words per paragraph (1-100, default: 5)</li>
                        <li><span class="font-semibold">maxWords</span>: Maximum words per paragraph (minWords-100, default: 20)</li>
                        <li><span class="font-semibold">startWithLoremIpsum</span>: Start with "Lorem ipsum" (true/false, default: true)</li>
                        <li><span class="font-semibold">useCache</span>: Use cached results (true/false, default: false)</li>
                        <li><span class="font-semibold">format</span>: Output format (json/html/text, default: json)</li>
                        <li><span class="font-semibold">capitalize</span>: Capitalize first letter of each word (true/false, default: true)</li>
                        <li><span class="font-semibold">addPunctuation</span>: Add period at end of paragraphs (true/false, default: false)</li>
                        <li><span class="font-semibold">seed</span>: Seed for random generation (integer, optional)</li>
                        <li><span class="font-semibold">uniqueWords</span>: Use unique words in each paragraph (true/false, default: false)</li>
                    </ul>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white dark:text-gray-200">Example</h3>
                    <div class="bg-black/30 dark:bg-white/10 p-4 rounded-lg mb-4">
                        <code class="text-green-300 dark:text-green-400 text-sm break-all">
                            {{ url('/l?paragraphs=2&minWords=10&maxWords=15&format=html&capitalize=false&addPunctuation=true') }}
                        </code>
                    </div>
                    <p class="text-white/90 dark:text-gray-300 mt-4">This will generate 2 paragraphs, each containing 10-15 words, in HTML format, without capitalization but with punctuation.</p>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white dark:text-gray-200">Response Format</h3>
                    <p class="text-white/90 dark:text-gray-300 mb-4">The API returns a JSON response with the following structure:</p>
                    <pre class="bg-black/30 dark:bg-white/10 p-4 rounded-lg text-green-300 dark:text-green-400 text-sm">
{
    "status": "success",
    "data": [ ... ],  // Array of paragraphs or formatted string
    "metadata": {
        "paragraphs": 3,
        "minWords": 5,
        "maxWords": 20,
        "totalWords": 45,
        "format": "json",
        "seed": 12345
    }
}
                    </pre>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white dark:text-gray-200">Error Handling</h3>
                    <p class="text-white/90 dark:text-gray-300 mb-4">If an error occurs, the API will return a JSON response with an error message:</p>
                    <pre class="bg-black/30 dark:bg-white/10 p-4 rounded-lg text-green-300 dark:text-green-400 text-sm">
{
    "status": "error",
    "message": "An error occurred: [Error message]"
}
                    </pre>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white dark:text-gray-200">Rate Limiting</h3>
                    <p class="text-white/90 dark:text-gray-300 mb-4">The API is rate-limited to 120 requests per minute to ensure fair usage.</p>
                </section>
            </div>
        </div>
    </div>
</x-layout>
