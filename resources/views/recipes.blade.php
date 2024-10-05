<x-layout>
    <div class="container mx-auto px-4 py-12">
        <div class="bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 dark:from-indigo-800 dark:via-purple-800 dark:to-pink-700 p-8 rounded-2xl shadow-lg bg-no-repeat bg-cover">
        <h1 class="text-6xl font-extrabold mb-8 text-center text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-pink-300 dark:from-blue-300 dark:to-pink-200">Recipe API</h1>

            <h2 class="text-3xl font-semibold mb-6 text-white dark:text-gray-200">Usage Guide</h2>
            <p class="text-xl text-white/90 dark:text-gray-300 mb-8">Get delicious recipes with our powerful API. Here's how to get started:</p>

            <div class="space-y-12">
                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white dark:text-gray-200">Basic Usage</h3>
                    <div class="bg-black/30 dark:bg-white/10 p-4 rounded-lg">
                        <code class="text-green-300 dark:text-green-400 text-sm break-all">
                            {{ route('recipe') }}
                        </code>
                    </div>
                    <p class="text-white/90 dark:text-gray-300 mt-4">This request will return random recipes from our database.</p>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white dark:text-gray-200">Query Parameters</h3>
                    <ul class="list-disc list-inside text-white/90 dark:text-gray-300 space-y-2 ml-4">
                        <li><span class="font-semibold">query</span>: Search query for recipes (optional)</li>
                        <li><span class="font-semibold">category</span>: Recipe category (optional)</li>
                        <li><span class="font-semibold">area</span>: Recipe area/cuisine (optional)</li>
                        <li><span class="font-semibold">number</span>: Number of recipes to return (1-25, default: 10) (optional)</li>
                    </ul>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white dark:text-gray-200">Response Format</h3>
                    <div class="bg-black/30 dark:bg-white/10 p-4 rounded-lg">
                        <pre class="text-green-300 dark:text-green-400 text-sm overflow-x-auto">
{
    "status": "success",
    "data": [
        {
            "id": "recipe_id",
            "title": "Recipe Title",
            "image": "Image URL",
            "category": "Recipe Category",
            "area": "Recipe Area",
            "instructions": "Cooking Instructions",
            "sourceUrl": "Source URL",
            "youtubeUrl": "YouTube URL",
            "ingredients": [
                {
                    "ingredient": "Ingredient Name",
                    "measure": "Measurement"
                },
                // ... more ingredients
            ]
        },
        // ... more recipes
    ],
    "timestamp": "YYYY-MM-DD HH:MM:SS"
}
                        </pre>
                    </div>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white dark:text-gray-200">Example Usage</h3>
                    <p class="text-white/90 dark:text-gray-300 mb-4">Here's an example of how to use the API with parameters:</p>
                    <div class="bg-black/30 dark:bg-white/10 p-4 rounded-lg mb-4">
                        <code class="text-green-300 dark:text-green-400 text-sm break-all">
                            {{ route('recipe', ['number' => 5, 'category' => 'Dessert']) }}
                        </code>
                    </div>
                    <p class="text-white/90 dark:text-gray-300">This request will return 5 random dessert recipes.</p>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white dark:text-gray-200">Error Handling</h3>
                    <p class="text-white/90 dark:text-gray-300 mb-4">In case of an error, the API will return a JSON response with an error message:</p>
                    <div class="bg-black/30 dark:bg-white/10 p-4 rounded-lg">
                        <pre class="text-green-300 dark:text-green-400 text-sm overflow-x-auto">
{
    "status": "error",
    "message": "Error description"
}
                        </pre>
                    </div>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white dark:text-gray-200">API Limits</h3>
                    <p class="text-white/90 dark:text-gray-300 mb-4">To ensure fair usage, this API is rate-limited. Please adhere to the following limits:</p>
                    <ul class="list-disc list-inside text-white/90 dark:text-gray-300 space-y-2 ml-4">
                        <li><span class="font-semibold">60 requests</span> per minute</li>
                        <li><span class="font-semibold">1000 requests</span> per day</li>
                    </ul>
                </section>
            </div>
        </div>
    </div>
</x-layout>
