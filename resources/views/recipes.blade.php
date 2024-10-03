<x-layout>
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold mb-8 text-center text-white">Recipe API Documentation</h1>

        <div class="bg-white/10 backdrop-blur-md border border-white/20 p-8 rounded-2xl shadow-lg mb-8">
            <h2 class="text-2xl font-semibold mb-4 text-white">Endpoint</h2>
            <code class="block bg-gray-800 text-green-400 p-4 rounded">GET {{ route('recipe') }}</code>
        </div>

        <div class="bg-white/10 backdrop-blur-md border border-white/20 p-8 rounded-2xl shadow-lg mb-8">
            <h2 class="text-2xl font-semibold mb-4 text-white">Query Parameters</h2>
            <ul class="list-disc list-inside text-white/90">
                <li><strong>query</strong> (optional): Search query for recipes</li>
                <li><strong>category</strong> (optional): Recipe category</li>
                <li><strong>area</strong> (optional): Recipe area/cuisine</li>
                <li><strong>number</strong> (optional): Number of recipes to return (1-25, default: 10)</li>
            </ul>
        </div>

        <div class="bg-white/10 backdrop-blur-md border border-white/20 p-8 rounded-2xl shadow-lg mb-8">
            <h2 class="text-2xl font-semibold mb-4 text-white">Response Format</h2>
            <pre class="bg-gray-800 text-green-400 p-4 rounded overflow-x-auto">
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

        <div class="bg-white/10 backdrop-blur-md border border-white/20 p-8 rounded-2xl shadow-lg mb-8">
            <h2 class="text-2xl font-semibold mb-4 text-white">Example Usage</h2>
            <code class="block bg-gray-800 text-green-400 p-4 rounded mb-4">
GET {{ route('recipe', ['number' => 5, 'category' => 'Dessert']) }}
            </code>
            <p class="text-white/90">This request will return 5 random dessert recipes.</p>
        </div>

        <div class="bg-white/10 backdrop-blur-md border border-white/20 p-8 rounded-2xl shadow-lg">
            <h2 class="text-2xl font-semibold mb-4 text-white">Error Handling</h2>
            <p class="text-white/90 mb-4">In case of an error, the API will return a JSON response with an error message:</p>
            <pre class="bg-gray-800 text-green-400 p-4 rounded overflow-x-auto">
{
    "status": "error",
    "message": "Error description"
}
            </pre>
        </div>
    </div>
</x-layout>
