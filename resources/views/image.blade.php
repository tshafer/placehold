<x-layout>
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-6xl font-extrabold mb-8 text-center text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-pink-300 dark:from-blue-300 dark:to-pink-200">Image Placeholder API</h1>

        <div class="bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 p-8 rounded-2xl shadow-lg bg-no-repeat bg-cover dark:from-indigo-800 dark:via-purple-800 dark:to-pink-700">
            <h2 class="text-3xl font-semibold mb-6 text-white">Usage Guide</h2>
            <p class="text-xl text-white/90 mb-8">Create custom placeholder images with our powerful API. Here's how to get started:</p>

            <div class="space-y-12">
                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white">Basic Usage</h3>
                    <div class="bg-black/30 p-4 rounded-lg dark:bg-black/50">
                        <code class="text-green-300 text-sm break-all dark:text-green-400">
                            {{ route('placeholder', ['size' => '300x200', 'background_color' => 'FF5733', 'text_color' => 'FFFFFF']) }}
                        </code>
                    </div>
                    <p class="text-white/90 mt-4">This will generate a 300x200 pixel image with an orange background and white text.</p>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white">Core Parameters</h3>
                    <ul class="list-disc list-inside text-white/90 space-y-2 ml-4">
                        <li><span class="font-semibold">size</span>: Dimensions (e.g., '300x200' or '300' for square)</li>
                        <li><span class="font-semibold">background_color</span>: Hex code for background (default: 'C8C8C8')</li>
                        <li><span class="font-semibold">text_color</span>: Hex code for text (default: '323232')</li>
                    </ul>
                    <p class="text-white/90 mt-4">These parameters are essential for defining the basic properties of your placeholder image.</p>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white">Optional Parameters</h3>
                    <p class="text-white/90 mb-4">Customize your image further with these optional parameters:</p>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                        @foreach([
                            ['name' => 'text', 'description' => 'Custom text (max 100 chars)', 'value' => 'Hello+World'],
                            ['name' => 'format', 'description' => 'Image format (png, jpg, gif, webp, svg)', 'value' => 'webp'],
                            ['name' => 'quality', 'description' => 'Image quality (0-100)', 'value' => '90'],
                            ['name' => 'font', 'description' => 'Font type (arial, couri, times, tron)', 'value' => 'couri'],
                            ['name' => 'text_size', 'description' => 'Size of text (1-500)', 'value' => '34'],
                            ['name' => 'watermark', 'description' => 'Watermark text', 'value' => 'placehold.cloud'],
                            ['name' => 'watermark_size', 'description' => 'Size of watermark (1-100)', 'value' => '20'],
                            ['name' => 'watermark_opacity', 'description' => 'Opacity of watermark (0-100)', 'value' => '50'],
                            ['name' => 'blur', 'description' => 'Blur effect (0-100)', 'value' => '10'],
                            ['name' => 'grayscale', 'description' => 'Apply grayscale (true/false)', 'value' => 'true'],
                            ['name' => 'invert', 'description' => 'Invert colors (true/false)', 'value' => 'true'],
                           // ['name' => 'cat', 'description' => 'Generate cat image (true/false)', 'value' => 'true'],
                            //['name' => 'dog', 'description' => 'Generate dog image (true/false)', 'value' => 'true'],
                            //['name' => 'robot', 'description' => 'Generate robot image (true/false)', 'value' => 'true'],
                        ] as $param)
                            <div class="bg-white/5 p-4 rounded-lg dark:bg-white/10">
                                <h4 class="text-lg font-semibold mb-2 text-white">{{ $param['name'] }}</h4>
                                <p class="text-white/80 mb-2">{{ $param['description'] }}</p>
                                <div class="bg-black/20 p-2 rounded dark:bg-black/40">
                                    <code class="text-green-300 text-xs break-all dark:text-green-400">
                                        {{ route('placeholder', array_merge(['size' => '300x200', 'background_color' => 'FF5733', 'text_color' => 'FFFFFF'], [$param['name'] => $param['value']])) }}
                                    </code>
                                </div>
                                <img src="{{ route('placeholder', array_merge(['size' => '300x200', 'background_color' => 'FF5733', 'text_color' => 'FFFFFF'], [$param['name'] => $param['value']])) }}" alt="Example with {{ $param['name'] }}" class="mt-2 rounded shadow-sm w-full">
                            </div>
                        @endforeach
                    </div>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white">Advanced Example</h3>
                    <p class="text-white/90 mb-4">Combine multiple parameters for more complex placeholder images:</p>
                    <div class="bg-black/30 p-4 rounded-lg mb-4 dark:bg-black/50">
                        <code class="text-green-300 text-sm break-all dark:text-green-400">
                            {{ route('placeholder', ['size' => '300x200', 'background_color' => 'FF5733', 'text_color' => 'FFFFFF', 'text' => 'Hello+World', 'format' => 'png', 'quality' => '90', 'font' => 'arial', 'text_size' => '30', 'watermark' => 'Copyright', 'watermark_size' => '20', 'watermark_opacity' => '50', 'blur' => '5', 'grayscale' => 'false', 'invert' => 'false', 'cat' => 'false', 'dog' => 'false', 'robot' => 'false']) }}
                        </code>
                    </div>
                    <img style="width: 300px; height: 200px;" src="{{ route('placeholder', ['size' => '300x200', 'background_color' => 'FF5733', 'text_color' => 'FFFFFF', 'text' => 'Hello+World', 'format' => 'png', 'quality' => '90', 'font' => 'arial', 'text_size' => '30', 'watermark' => 'Copyright', 'watermark_size' => '20', 'watermark_opacity' => '50', 'blur' => '5', 'grayscale' => 'false', 'invert' => 'false', 'cat' => 'false', 'dog' => 'false', 'robot' => 'false']) }}" alt="Advanced example" class="rounded shadow-sm w-full md:w-1/2 mx-auto">
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white">API Limits and Caching</h3>
                    <p class="text-white/90 mb-4">Our API is rate-limited to 60 requests per minute. Images are cached for one week to improve performance.</p>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white">Error Handling</h3>
                    <p class="text-white/90 mb-4">If an error occurs during image generation, a backup image will be provided with basic information.</p>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white">Security</h3>
                    <p class="text-white/90 mb-4">Our API implements several security headers to protect against common web vulnerabilities:</p>
                    <ul class="list-disc list-inside text-white/90 space-y-2 ml-4">
                        <li>X-Content-Type-Options: nosniff</li>
                        <li>X-Frame-Options: DENY</li>
                        <li>X-XSS-Protection: 1; mode=block</li>
                    </ul>
                </section>
            </div>
        </div>
    </div>
</x-layout>
