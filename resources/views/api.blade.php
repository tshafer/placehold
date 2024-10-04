<x-layout>
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-6xl font-extrabold mb-8 text-center text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-pink-300">API Documentation</h1>

        <div class="bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 p-8 rounded-2xl shadow-lg bg-no-repeat bg-cover">
            <section class="mb-12">
                <h2 class="text-3xl font-semibold mb-6 text-white">Introduction</h2>
                <p class="text-xl text-white/90">
                    Welcome to the placehold.cloud API documentation. Our API allows you to generate custom placeholder images, lorem ipsum text, quotes, jokes, weather information, and recipes programmatically. This comprehensive guide will help you integrate our services into your applications with ease.
                </p>
            </section>

            <section class="mb-12">
                <h2 class="text-3xl font-semibold mb-6 text-white">Authentication</h2>
                <p class="text-xl text-white/90">
                    No authentication is required to use our API. However, please be mindful of our rate limits and fair usage policy. We recommend including your application name in the User-Agent header for better request tracking and support.
                </p>
            </section>

            <section class="mb-12">
                <h2 class="text-3xl font-semibold mb-6 text-white">Base URL</h2>
                <p class="text-xl text-white/90">
                    All API requests should be made to:
                    <code class="bg-white/20 px-2 py-1 rounded">https://api.placehold.cloud/v1</code>
                </p>
            </section>

            <section class="mb-12">
                <h2 class="text-3xl font-semibold mb-6 text-white">Endpoints</h2>

                <div class="space-y-8">
                    <div>
                        <h3 class="text-2xl font-semibold mb-4 text-white">1. Placeholder Images</h3>
                        <p class="text-white/90 mb-2"><strong>Endpoint:</strong> <code class="bg-white/20 px-2 py-1 rounded">/image/{width}/{height}</code></p>
                        <p class="text-white/90 mb-2"><strong>Method:</strong> GET</p>
                        <p class="text-white/90 mb-2"><strong>Parameters:</strong></p>
                        <ul class="list-disc list-inside text-white/90 ml-4">
                            <li>width (required): Width of the image in pixels</li>
                            <li>height (required): Height of the image in pixels</li>
                            <li>background (optional): Background color (hex code without #)</li>
                            <li>text (optional): Custom text to display on the image</li>
                            <li>font (optional): Font family for the text (default: Arial)</li>
                            <li>format (optional): Image format (jpg, png, webp; default: png)</li>
                        </ul>
                        <p class="text-white/90 mt-2"><strong>Example:</strong> <code class="bg-white/20 px-2 py-1 rounded">/image/300/200?background=ff0000&text=Hello%20World&font=Roboto&format=webp</code></p>
                    </div>

                    <div>
                        <h3 class="text-2xl font-semibold mb-4 text-white">2. Lorem Ipsum</h3>
                        <p class="text-white/90 mb-2"><strong>Endpoint:</strong> <code class="bg-white/20 px-2 py-1 rounded">/lorem-ipsum</code></p>
                        <p class="text-white/90 mb-2"><strong>Method:</strong> GET</p>
                        <p class="text-white/90 mb-2"><strong>Parameters:</strong></p>
                        <ul class="list-disc list-inside text-white/90 ml-4">
                            <li>paragraphs (optional): Number of paragraphs to generate (default: 1)</li>
                            <li>words (optional): Number of words per paragraph (default: 100)</li>
                            <li>format (optional): Output format (html, text; default: text)</li>
                        </ul>
                        <p class="text-white/90 mt-2"><strong>Example:</strong> <code class="bg-white/20 px-2 py-1 rounded">/lorem-ipsum?paragraphs=3&words=50&format=html</code></p>
                    </div>

                    <div>
                        <h3 class="text-2xl font-semibold mb-4 text-white">3. Quotes</h3>
                        <p class="text-white/90 mb-2"><strong>Endpoint:</strong> <code class="bg-white/20 px-2 py-1 rounded">/quotes</code></p>
                        <p class="text-white/90 mb-2"><strong>Method:</strong> GET</p>
                        <p class="text-white/90 mb-2"><strong>Parameters:</strong></p>
                        <ul class="list-disc list-inside text-white/90 ml-4">
                            <li>category (optional): Specific category of quotes (e.g., inspirational, funny, love)</li>
                            <li>author (optional): Filter quotes by author name</li>
                        </ul>
                        <p class="text-white/90">Returns a random quote or a quote matching the specified criteria.</p>
                        <p class="text-white/90 mt-2"><strong>Example:</strong> <code class="bg-white/20 px-2 py-1 rounded">/quotes?category=inspirational&author=Einstein</code></p>
                    </div>

                    <div>
                        <h3 class="text-2xl font-semibold mb-4 text-white">4. Jokes</h3>
                        <p class="text-white/90 mb-2"><strong>Endpoint:</strong> <code class="bg-white/20 px-2 py-1 rounded">/jokes</code></p>
                        <p class="text-white/90 mb-2"><strong>Method:</strong> GET</p>
                        <p class="text-white/90 mb-2"><strong>Parameters:</strong></p>
                        <ul class="list-disc list-inside text-white/90 ml-4">
                            <li>category (optional): Joke category (e.g., programming, general, knock-knock)</li>
                            <li>lang (optional): Language of the joke (default: en)</li>
                        </ul>
                        <p class="text-white/90">Returns a random joke or a joke from the specified category.</p>
                        <p class="text-white/90 mt-2"><strong>Example:</strong> <code class="bg-white/20 px-2 py-1 rounded">/jokes?category=programming&lang=en</code></p>
                    </div>

                    <div>
                        <h3 class="text-2xl font-semibold mb-4 text-white">5. Weather</h3>
                        <p class="text-white/90 mb-2"><strong>Endpoint:</strong> <code class="bg-white/20 px-2 py-1 rounded">/weather</code></p>
                        <p class="text-white/90 mb-2"><strong>Method:</strong> GET</p>
                        <p class="text-white/90 mb-2"><strong>Parameters:</strong></p>
                        <ul class="list-disc list-inside text-white/90 ml-4">
                            <li>city (required): Name of the city</li>
                            <li>country (optional): Country code (e.g., US, GB, FR)</li>
                            <li>units (optional): Units of measurement (metric, imperial; default: metric)</li>
                        </ul>
                        <p class="text-white/90 mt-2"><strong>Example:</strong> <code class="bg-white/20 px-2 py-1 rounded">/weather?city=London&country=GB&units=metric</code></p>
                    </div>

                    <div>
                        <h3 class="text-2xl font-semibold mb-4 text-white">6. Recipes</h3>
                        <p class="text-white/90 mb-2"><strong>Endpoint:</strong> <code class="bg-white/20 px-2 py-1 rounded">/recipes</code></p>
                        <p class="text-white/90 mb-2"><strong>Method:</strong> GET</p>
                        <p class="text-white/90 mb-2"><strong>Parameters:</strong></p>
                        <ul class="list-disc list-inside text-white/90 ml-4">
                            <li>category (optional): Category of recipes (e.g., breakfast, lunch, dinner)</li>
                            <li>cuisine (optional): Cuisine type (e.g., Italian, Mexican, Chinese)</li>
                            <li>diet (optional): Dietary restrictions (e.g., vegetarian, vegan, gluten-free)</li>
                            <li>limit (optional): Number of recipes to return (default: 1, max: 10)</li>
                        </ul>
                        <p class="text-white/90 mt-2"><strong>Example:</strong> <code class="bg-white/20 px-2 py-1 rounded">/recipes?category=dinner&cuisine=Italian&diet=vegetarian&limit=5</code></p>
                    </div>
                </div>
            </section>

            <section class="mb-12">
                <h2 class="text-3xl font-semibold mb-6 text-white">Rate Limits</h2>
                <p class="text-xl text-white/90">
                    To ensure fair usage, we limit requests to 100 per hour per IP address. If you exceed this limit, you'll receive a 429 Too Many Requests response. The response will include a Retry-After header indicating how long to wait before making another request.
                </p>
            </section>

            <section class="mb-12">
                <h2 class="text-3xl font-semibold mb-6 text-white">Error Handling</h2>
                <p class="text-xl text-white/90 mb-4">
                    Our API uses conventional HTTP response codes to indicate the success or failure of an API request. In general:
                </p>
                <ul class="list-disc list-inside text-white/90 ml-4">
                    <li>2xx range indicate success</li>
                    <li>4xx range indicate an error that failed given the information provided (e.g., a required parameter was omitted)</li>
                    <li>5xx range indicate an error with our servers</li>
                </ul>
            </section>

            <section>
                <h2 class="text-3xl font-semibold mb-6 text-white">Support</h2>
                <p class="text-xl text-white/90">
                    If you have any questions or need assistance with our API, please don't hesitate to contact our support team at api-support@placehold.cloud. We're here to help you integrate our services seamlessly into your applications.
                </p>
            </section>
        </div>
    </div>
</x-layout>
