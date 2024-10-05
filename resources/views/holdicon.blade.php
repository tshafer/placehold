<x-layout>
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-6xl font-extrabold mb-8 text-center text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-pink-300 dark:from-blue-300 dark:to-pink-200">Holdicon API Documentation</h1>

        <div class="bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 dark:from-indigo-800 dark:via-purple-800 dark:to-pink-700 p-8 rounded-2xl shadow-lg bg-no-repeat bg-cover">
            <h2 class="text-3xl font-semibold mb-6 text-white dark:text-gray-200">Usage Guide</h2>
            <p class="text-xl text-white/90 dark:text-gray-300 mb-8">Create custom placeholder images with our powerful Holdicon API. Here's how to get started:</p>

            <div class="space-y-12">
                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white dark:text-gray-200">Endpoint</h3>
                    <div class="bg-black/30 dark:bg-white/10 p-4 rounded-lg">
                        <code class="text-green-300 dark:text-green-400 text-sm break-all">
                            GET {{ route('holdicon') }}
                        </code>
                    </div>
                    <p class="text-white/90 dark:text-gray-300 mt-4">This API generates customizable placeholder images with optional text, icons, or animal shapes.</p>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white dark:text-gray-200">Parameters</h3>
                    <div class="bg-white/5 dark:bg-black/30 p-4 rounded-lg">
                        <table class="w-full text-white/90 dark:text-gray-300">
                            <tr class="border-b border-white/20 dark:border-gray-700">
                                <th class="text-left py-2">Parameter</th>
                                <th class="text-left py-2">Type</th>
                                <th class="text-left py-2">Default</th>
                                <th class="text-left py-2">Description</th>
                            </tr>
                            <tr class="border-b border-white/20 dark:border-gray-700">
                                <td class="py-2">seed</td>
                                <td>string</td>
                                <td>''</td>
                                <td>Seed for consistent random generation</td>
                            </tr>
                            <tr class="border-b border-white/20 dark:border-gray-700">
                                <td class="py-2">width</td>
                                <td>integer</td>
                                <td>128</td>
                                <td>Width of the image in pixels</td>
                            </tr>
                            <tr class="border-b border-white/20 dark:border-gray-700">
                                <td class="py-2">height</td>
                                <td>integer</td>
                                <td>128</td>
                                <td>Height of the image in pixels</td>
                            </tr>
                            <tr class="border-b border-white/20 dark:border-gray-700">
                                <td class="py-2">background_color</td>
                                <td>string</td>
                                <td>Random</td>
                                <td>Hexadecimal color code for background</td>
                            </tr>
                            <tr class="border-b border-white/20 dark:border-gray-700">
                                <td class="py-2">text_color</td>
                                <td>string</td>
                                <td>Contrast color</td>
                                <td>Hexadecimal color code for text</td>
                            </tr>
                            <tr class="border-b border-white/20 dark:border-gray-700">
                                <td class="py-2">text</td>
                                <td>string</td>
                                <td>Random 2 letters</td>
                                <td>Text to display on the image</td>
                            </tr>
                            <tr class="border-b border-white/20 dark:border-gray-700">
                                <td class="py-2">robot</td>
                                <td>boolean</td>
                                <td>false</td>
                                <td>Generate a robot icon</td>
                            </tr>
                            <tr class="border-b border-white/20 dark:border-gray-700">
                                <td class="py-2">cat</td>
                                <td>boolean</td>
                                <td>false</td>
                                <td>Generate a cat icon</td>
                            </tr>
                            <tr>
                                <td class="py-2">dog</td>
                                <td>boolean</td>
                                <td>false</td>
                                <td>Generate a dog icon</td>
                            </tr>
                        </table>
                    </div>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white dark:text-gray-200">Example Usage</h3>
                    <p class="text-white/90 dark:text-gray-300 mb-4">Generate a 200x200 image with red background and white text "AB":</p>
                    <div class="bg-black/30 dark:bg-white/10 p-4 rounded-lg mb-4">
                        <code class="text-green-300 dark:text-green-400 text-sm break-all">
                            {{ route('holdicon') }}?width=200&height=200&background_color=FF0000&text_color=FFFFFF&text=AB
                        </code>
                    </div>
                    <img src="{{ route('holdicon') }}?width=200&height=200&background_color=FF0000&text_color=FFFFFF&text=AB" alt="Example 1" class="mb-4 rounded shadow-sm">

                    <p class="text-white/90 dark:text-gray-300 mb-4">Generate a 150x150 robot icon with default colors:</p>
                    <div class="bg-black/30 dark:bg-white/10 p-4 rounded-lg mb-4">
                        <code class="text-green-300 dark:text-green-400 text-sm break-all">
                            {{ route('holdicon') }}?width=150&height=150&robot=true
                        </code>
                    </div>
                    <img src="{{ route('holdicon') }}?width=150&height=150&robot=true" alt="Example 2" class="mb-4 rounded shadow-sm">

                    <p class="text-white/90 dark:text-gray-300 mb-4">Generate a 180x180 cat icon with custom colors:</p>
                    <div class="bg-black/30 dark:bg-white/10 p-4 rounded-lg mb-4">
                        <code class="text-green-300 dark:text-green-400 text-sm break-all">
                            {{ route('holdicon') }}?width=180&height=180&cat=true&background_color=00FF00&text_color=000000
                        </code>
                    </div>
                    <img src="{{ route('holdicon') }}?width=180&height=180&cat=true&background_color=00FF00&text_color=000000" alt="Example 3" class="mb-4 rounded shadow-sm">

                    <p class="text-white/90 dark:text-gray-300 mb-4">Generate a 200x200 dog icon with custom colors:</p>
                    <div class="bg-black/30 dark:bg-white/10 p-4 rounded-lg mb-4">
                        <code class="text-green-300 dark:text-green-400 text-sm break-all">
                            {{ route('holdicon') }}?width=200&height=200&dog=true&background_color=0000FF&text_color=FFFFFF
                        </code>
                    </div>
                    <img src="{{ route('holdicon') }}?width=200&height=200&dog=true&background_color=0000FF&text_color=FFFFFF" alt="Example 4" class="mb-4 rounded shadow-sm">
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white dark:text-gray-200">Response</h3>
                    <p class="text-white/90 dark:text-gray-300 mb-4">The API returns a PNG image.</p>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white dark:text-gray-200">Rate Limiting</h3>
                    <p class="text-white/90 dark:text-gray-300 mb-4">This endpoint is rate-limited to 120 requests per minute.</p>
                </section>
            </div>
        </div>
    </div>
</x-layout>
