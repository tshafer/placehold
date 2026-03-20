<x-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">API Documentation</h1>
            <p class="text-gray-600 dark:text-gray-400">Comprehensive guide to our placeholder APIs</p>
        </div>

        <!-- Quick Start Banner -->
        <div class="bg-primary-50 dark:bg-primary-900/20 border border-primary-200 dark:border-primary-800 rounded-xl p-8 mb-8">
                <h2 class="text-2xl font-bold mb-2 flex items-center text-gray-900 dark:text-white">
                    <x-heroicon-o-bolt class="w-6 h-6 mr-2 text-gray-900 dark:text-white" />
                    Quick Start
                </h2>
                <p class="text-lg mb-4 text-gray-600 dark:text-gray-400">Generate your first placeholder image in seconds:</p>
                <div class="space-y-2 mb-4">
                    <div class="bg-gray-900 p-4 rounded-lg">
                        <code class="text-green-400 text-sm font-mono">GET https://placehold.cloud/640x320?text=Hello</code>
                    </div>
                    <div class="bg-gray-900 p-4 rounded-lg">
                        <code class="text-green-400 text-sm font-mono">GET https://placehold.cloud/p/500x300/FF5733/FFFFFF</code>
                    </div>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400">No API key required • Free forever • 9 image formats • Production-ready</p>
            </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-8">
            <section class="mb-12">
                <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white">Introduction</h2>
                <p class="text-gray-600 dark:text-gray-400">
                    Welcome to the placehold.cloud API documentation. Our API allows you to generate custom placeholder images (9 formats), lorem ipsum text, quotes, jokes, weather information, recipes, colors, and holdicons programmatically. This comprehensive guide will help you integrate our services into your applications with ease.
                </p>
            </section>

            <section class="mb-12">
                <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white">Authentication</h2>
                <p class="text-gray-600 dark:text-gray-400">
                    No authentication is required to use our API. However, please be mindful of our rate limits and fair usage policy. We recommend including your application name in the User-Agent header for better request tracking and support.
                </p>
            </section>

            <section class="mb-12">
                <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white">Base URL</h2>
                <p class="text-gray-600 dark:text-gray-400 mb-4">
                    All API requests should be made to:
                </p>
                <div class="bg-gray-900 p-4 rounded-lg mb-4">
                    <code class="text-green-400 text-sm font-mono">https://placehold.cloud</code>
                </div>
                <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                    <p class="text-gray-700 dark:text-gray-300 flex items-start gap-2">
                        <x-heroicon-o-information-circle class="w-5 h-5 flex-shrink-0 mt-0.5" />
                        <span class="text-sm">All endpoints are public and can be accessed directly via GET requests. No authentication required!</span>
                    </p>
                </div>
            </section>

            <section class="mb-12">
                <h2 class="text-2xl font-semibold mb-6 text-gray-900 dark:text-white">Endpoints</h2>

                <div class="space-y-8">
                    <div>
                        <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">1. Placeholder Images</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-2"><strong>Endpoints:</strong> <code class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white px-2 py-1 rounded font-mono text-sm">/p/{size}/{background}/{text_color}</code> or <code class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white px-2 py-1 rounded font-mono text-sm">/{size}</code></p>
                        <p class="text-gray-600 dark:text-gray-400 mb-2"><strong>Method:</strong> GET</p>
                        <p class="text-gray-600 dark:text-gray-400 mb-2"><strong>Parameters:</strong></p>
                        <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-4 space-y-2">
                            <div class="flex gap-4"><span class="font-mono text-sm text-gray-900 dark:text-white w-32">size</span><span class="text-gray-700 dark:text-gray-300 text-sm">Dimensions (e.g., 500x300 or just 640x320)</span></div>
                            <div class="flex gap-4"><span class="font-mono text-sm text-gray-900 dark:text-white w-32">format</span><span class="text-gray-700 dark:text-gray-300 text-sm">png, jpg, jpeg, webp, gif, avif, bmp, ico, svg</span></div>
                            <div class="flex gap-4"><span class="font-mono text-sm text-gray-900 dark:text-white w-32">text</span><span class="text-gray-700 dark:text-gray-300 text-sm">Custom text</span></div>
                            <div class="flex gap-4"><span class="font-mono text-sm text-gray-900 dark:text-white w-32">bg</span><span class="text-gray-700 dark:text-gray-300 text-sm">Background color (short alias)</span></div>
                            <div class="flex gap-4"><span class="font-mono text-sm text-gray-900 dark:text-white w-32">fg</span><span class="text-gray-700 dark:text-gray-300 text-sm">Text color (short alias)</span></div>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 mt-4"><strong>Examples:</strong></p>
                        <div class="space-y-2">
                            <div class="bg-gray-900 p-4 rounded-lg">
                                <code class="text-green-400 text-sm font-mono break-all">/p/500x300/FF5733/FFFFFF?text=Hello+World</code>
                            </div>
                            <div class="bg-gray-900 p-4 rounded-lg">
                                <code class="text-green-400 text-sm font-mono break-all">/640x320?text=Case+Study&bg=efefef&fg=374151</code>
                            </div>
                            <div class="bg-gray-900 p-4 rounded-lg">
                                <code class="text-green-400 text-sm font-mono break-all">/500x300?text=Preview&format=webp</code>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">2. Lorem Ipsum</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-2"><strong>Endpoint:</strong> <code class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white px-2 py-1 rounded font-mono text-sm">GET /l</code></p>
                        <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-4 space-y-2">
                            <div class="flex gap-4"><span class="font-mono text-sm text-gray-900 dark:text-white w-32">paragraphs</span><span class="text-gray-700 dark:text-gray-300 text-sm">Number of paragraphs (1-100)</span></div>
                            <div class="flex gap-4"><span class="font-mono text-sm text-gray-900 dark:text-white w-32">format</span><span class="text-gray-700 dark:text-gray-300 text-sm">json, html, text</span></div>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 mt-4"><strong>Example:</strong></p>
                        <div class="bg-gray-900 p-4 rounded-lg mt-2">
                            <code class="text-green-400 text-sm font-mono break-all">/l?paragraphs=3&format=json</code>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">3. Quotes</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-2"><strong>Endpoint:</strong> <code class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white px-2 py-1 rounded font-mono text-sm">GET /q</code></p>
                        <p class="text-gray-600 dark:text-gray-400">Returns a random inspirational quote.</p>
                        <div class="bg-gray-900 p-4 rounded-lg mt-4">
                            <code class="text-green-400 text-sm font-mono break-all">/q</code>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">4. Jokes</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-2"><strong>Endpoint:</strong> <code class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white px-2 py-1 rounded font-mono text-sm">GET /j</code></p>
                        <p class="text-gray-600 dark:text-gray-400">Returns a random joke from our database.</p>
                        <div class="bg-gray-900 p-4 rounded-lg mt-4">
                            <code class="text-green-400 text-sm font-mono break-all">/j</code>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">5. Weather</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-2"><strong>Endpoint:</strong> <code class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white px-2 py-1 rounded font-mono text-sm">GET /w</code></p>
                        <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-4 space-y-2">
                            <div class="flex gap-4"><span class="font-mono text-sm text-gray-900 dark:text-white w-32">city</span><span class="text-gray-700 dark:text-gray-300 text-sm">City name (required)</span></div>
                            <div class="flex gap-4"><span class="font-mono text-sm text-gray-900 dark:text-white w-32">country</span><span class="text-gray-700 dark:text-gray-300 text-sm">Country code (required)</span></div>
                        </div>
                        <div class="bg-gray-900 p-4 rounded-lg mt-4">
                            <code class="text-green-400 text-sm font-mono break-all">/w?city=London&country=GB</code>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">6. Recipes</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-2"><strong>Endpoint:</strong> <code class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white px-2 py-1 rounded font-mono text-sm">GET /r</code></p>
                        <p class="text-gray-600 dark:text-gray-400">Returns random recipes from TheMealDB API.</p>
                        <div class="bg-gray-900 p-4 rounded-lg mt-4">
                            <code class="text-green-400 text-sm font-mono break-all">/r</code>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">7. Colors</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-2"><strong>Endpoint:</strong> <code class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white px-2 py-1 rounded font-mono text-sm">GET /c</code></p>
                        <p class="text-gray-600 dark:text-gray-400">Generate color palettes, hex codes, and named colors.</p>
                        <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-4 space-y-2">
                            <div class="flex gap-4"><span class="font-mono text-sm text-gray-900 dark:text-white w-32">type</span><span class="text-gray-700 dark:text-gray-300 text-sm">palette, hex, or named (default: palette)</span></div>
                            <div class="flex gap-4"><span class="font-mono text-sm text-gray-900 dark:text-white w-32">count</span><span class="text-gray-700 dark:text-gray-300 text-sm">Number of results (1-10, default: 5)</span></div>
                        </div>
                        <div class="bg-gray-900 p-4 rounded-lg mt-4">
                            <code class="text-green-400 text-sm font-mono break-all">/c?type=palette&count=3</code>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">8. Holdicons</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-2"><strong>Endpoint:</strong> <code class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white px-2 py-1 rounded font-mono text-sm">GET /h</code></p>
                        <p class="text-gray-600 dark:text-gray-400">Generate placeholder icons with text, cats, dogs, or robots.</p>
                        <div class="bg-gray-900 p-4 rounded-lg mt-4">
                            <code class="text-green-400 text-sm font-mono break-all">/h?width=128&height=128&text=Hi</code>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mb-12">
                <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white">Rate Limits</h2>
                <p class="text-gray-600 dark:text-gray-400">
                    To ensure fair usage, we limit requests to 100 per hour per IP address. If you exceed this limit, you'll receive a 429 Too Many Requests response. The response will include a Retry-After header indicating how long to wait before making another request.
                </p>
            </section>

            <section class="mb-12">
                <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white">Error Handling</h2>
                <p class="text-gray-600 dark:text-gray-400 mb-4">
                    Our API uses conventional HTTP response codes to indicate the success or failure of an API request. In general:
                </p>
                <ul class="list-disc list-inside text-gray-600 dark:text-gray-400 ml-4 space-y-1">
                    <li>2xx range indicate success</li>
                    <li>4xx range indicate an error that failed given the information provided (e.g., a required parameter was omitted)</li>
                    <li>5xx range indicate an error with our servers</li>
                </ul>
            </section>

            <section>
                <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white">Support</h2>
                <p class="text-gray-600 dark:text-gray-400">
                    If you have any questions or need assistance with our API, please don't hesitate to contact our support team at 
                    <a href="mailto:support@placehold.cloud" class="text-gray-900 dark:text-white hover:underline">support@placehold.cloud</a>. We're here to help you integrate our services seamlessly into your applications.
                </p>
            </section>
        </div>
    </div>
</x-layout>
