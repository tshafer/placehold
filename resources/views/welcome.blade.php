<x-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <!-- Hero Section -->
        <div class="text-center py-16">
            <h1 class="text-5xl md:text-6xl font-bold text-gray-900 dark:text-white mb-4">
                The Ultimate Placeholder
                <span class="text-primary-600 dark:text-primary-400">Generator</span>
            </h1>
            <p class="text-xl text-gray-600 dark:text-gray-400 mb-8 max-w-2xl mx-auto">
                Generate custom placeholder images, text, quotes, and more. Free, fast, and production-ready.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="/image" 
                   class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors shadow-lg">
                    <x-heroicon-o-photo class="w-5 h-5 mr-2" />
                    Get Started
                </a>
                <a href="/api" 
                   class="inline-flex items-center px-6 py-3 bg-white dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 font-medium rounded-lg transition-colors">
                    <x-heroicon-o-command-line class="w-5 h-5 mr-2" />
                    API Docs
                </a>
            </div>
        </div>

        <!-- Features Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-gray-100 dark:bg-gray-800 rounded-lg flex items-center justify-center mb-4">
                    <x-heroicon-o-bolt class="w-6 h-6 text-gray-900 dark:text-white" />
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Lightning Fast</h3>
                <p class="text-gray-600 dark:text-gray-400">Sub-second responses with intelligent caching for optimal performance.</p>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-gray-100 dark:bg-gray-800 rounded-lg flex items-center justify-center mb-4">
                    <x-heroicon-o-gift class="w-6 h-6 text-gray-900 dark:text-white" />
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Completely Free</h3>
                <p class="text-gray-600 dark:text-gray-400">No registration, no API keys, no credit card required.</p>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow">
                <div class="w-12 h-12 bg-gray-100 dark:bg-gray-800 rounded-lg flex items-center justify-center mb-4">
                    <x-heroicon-o-paint-brush class="w-6 h-6 text-gray-900 dark:text-white" />
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Highly Customizable</h3>
                <p class="text-gray-600 dark:text-gray-400">Custom sizes, colors, text, formats, and special effects.</p>
            </div>
        </div>

        <!-- Tools Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-16">
            <a href="/image" class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:border-gray-400 dark:hover:border-gray-600 hover:shadow-lg transition-all group">
                <div class="flex items-center mb-3">
                    <x-heroicon-o-photo class="w-8 h-8 mr-3 text-gray-900 dark:text-white group-hover:scale-110 transition-transform" />
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Image Placeholder</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400">Generate custom placeholder images with any size, color, or text.</p>
            </a>

            <a href="/lorem-ipsum" class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:border-gray-400 dark:hover:border-gray-600 hover:shadow-lg transition-all group">
                <div class="flex items-center mb-3">
                    <x-heroicon-o-document-text class="w-8 h-8 mr-3 text-gray-900 dark:text-white group-hover:scale-110 transition-transform" />
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Lorem Ipsum</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400">Create dummy text for your layouts and designs.</p>
            </a>

            <a href="/quotes" class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:border-gray-400 dark:hover:border-gray-600 hover:shadow-lg transition-all group">
                <div class="flex items-center mb-3">
                    <x-heroicon-o-chat-bubble-left class="w-8 h-8 mr-3 text-gray-900 dark:text-white group-hover:scale-110 transition-transform" />
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Random Quotes</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400">Get inspirational and motivational quotes.</p>
            </a>

            <a href="/jokes" class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:border-gray-400 dark:hover:border-gray-600 hover:shadow-lg transition-all group">
                <div class="flex items-center mb-3">
                    <x-heroicon-o-face-smile class="w-8 h-8 mr-3 text-gray-900 dark:text-white group-hover:scale-110 transition-transform" />
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Random Jokes</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400">Lighten up your day with some humor.</p>
            </a>

            <a href="/weather" class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:border-gray-400 dark:hover:border-gray-600 hover:shadow-lg transition-all group">
                <div class="flex items-center mb-3">
                    <x-heroicon-o-cloud class="w-8 h-8 mr-3 text-gray-900 dark:text-white group-hover:scale-110 transition-transform" />
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Weather Data</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400">Get real-time weather information.</p>
            </a>

            <a href="/recipes" class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:border-gray-400 dark:hover:border-gray-600 hover:shadow-lg transition-all group">
                <div class="flex items-center mb-3">
                    <x-heroicon-o-book-open class="w-8 h-8 mr-3 text-gray-900 dark:text-white group-hover:scale-110 transition-transform" />
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Random Recipes</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400">Discover delicious cooking ideas.</p>
            </a>

            <a href="/colors" class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:border-gray-400 dark:hover:border-gray-600 hover:shadow-lg transition-all group">
                <div class="flex items-center mb-3">
                    <x-heroicon-o-paint-brush class="w-8 h-8 mr-3 text-gray-900 dark:text-white group-hover:scale-110 transition-transform" />
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Color Palettes</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400">Generate beautiful color palettes and hex codes.</p>
            </a>

            <a href="/holdicon" class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:border-gray-400 dark:hover:border-gray-600 hover:shadow-lg transition-all group">
                <div class="flex items-center mb-3">
                    <x-heroicon-o-view-columns class="w-8 h-8 mr-3 text-gray-900 dark:text-white group-hover:scale-110 transition-transform" />
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Icon Placeholders</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400">Generate placeholder icons with custom styling.</p>
            </a>

            <a href="/icons" class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:border-gray-400 dark:hover:border-gray-600 hover:shadow-lg transition-all group">
                <div class="flex items-center mb-3">
                    <x-heroicon-o-paint-brush class="w-8 h-8 mr-3 text-gray-900 dark:text-white group-hover:scale-110 transition-transform" />
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Icon Library</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400">Browse our collection of beautiful icons.</p>
            </a>

            <a href="/avatar" class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:border-gray-400 dark:hover:border-gray-600 hover:shadow-lg transition-all group">
                <div class="flex items-center mb-3">
                    <x-heroicon-o-user-circle class="w-8 h-8 mr-3 text-gray-900 dark:text-white group-hover:scale-110 transition-transform" />
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Avatar Generator</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400">Generate unique identicon avatars from any seed.</p>
            </a>

            <a href="/qrcode" class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:border-gray-400 dark:hover:border-gray-600 hover:shadow-lg transition-all group">
                <div class="flex items-center mb-3">
                    <x-heroicon-o-qr-code class="w-8 h-8 mr-3 text-gray-900 dark:text-white group-hover:scale-110 transition-transform" />
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">QR Codes</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400">Generate QR codes for any URL or text.</p>
            </a>

            <a href="/favicon-generator" class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:border-gray-400 dark:hover:border-gray-600 hover:shadow-lg transition-all group">
                <div class="flex items-center mb-3">
                    <x-heroicon-o-star class="w-8 h-8 mr-3 text-gray-900 dark:text-white group-hover:scale-110 transition-transform" />
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Favicon Generator</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400">Create simple letter favicons for any website.</p>
            </a>

            <a href="/json-placeholder" class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:border-gray-400 dark:hover:border-gray-600 hover:shadow-lg transition-all group">
                <div class="flex items-center mb-3">
                    <x-heroicon-o-code-bracket class="w-8 h-8 mr-3 text-gray-900 dark:text-white group-hover:scale-110 transition-transform" />
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">JSON Placeholder</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400">Fake REST API for users, posts, comments, and todos.</p>
            </a>

            <a href="/pdf-generator" class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:border-gray-400 dark:hover:border-gray-600 hover:shadow-lg transition-all group">
                <div class="flex items-center mb-3">
                    <x-heroicon-o-document class="w-8 h-8 mr-3 text-gray-900 dark:text-white group-hover:scale-110 transition-transform" />
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">PDF Placeholder</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400">Generate dummy PDF documents with lorem ipsum text.</p>
            </a>

            <a href="/csv-generator" class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:border-gray-400 dark:hover:border-gray-600 hover:shadow-lg transition-all group">
                <div class="flex items-center mb-3">
                    <x-heroicon-o-table-cells class="w-8 h-8 mr-3 text-gray-900 dark:text-white group-hover:scale-110 transition-transform" />
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">CSV / Data Generator</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400">Fake tabular data with names, emails, addresses, and more.</p>
            </a>

            <a href="/markdown-generator" class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:border-gray-400 dark:hover:border-gray-600 hover:shadow-lg transition-all group">
                <div class="flex items-center mb-3">
                    <x-heroicon-o-hashtag class="w-8 h-8 mr-3 text-gray-900 dark:text-white group-hover:scale-110 transition-transform" />
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Markdown Placeholder</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400">Realistic markdown with headings, lists, code blocks, and tables.</p>
            </a>

            <a href="/video-generator" class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:border-gray-400 dark:hover:border-gray-600 hover:shadow-lg transition-all group">
                <div class="flex items-center mb-3">
                    <x-heroicon-o-film class="w-8 h-8 mr-3 text-gray-900 dark:text-white group-hover:scale-110 transition-transform" />
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Video Placeholder</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400">Static-color MP4 videos at any resolution and duration.</p>
            </a>
        </div>

        <!-- Explore Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">
            <a href="/playground" class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:border-gray-400 dark:hover:border-gray-600 hover:shadow-lg transition-all group">
                <div class="flex items-center mb-3">
                    <x-heroicon-o-code-bracket-square class="w-8 h-8 mr-3 text-gray-900 dark:text-white group-hover:scale-110 transition-transform" />
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Playground</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400">Live HTML/CSS/JS editor using the API. Build and share instantly.</p>
            </a>

            <a href="/stats" class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:border-gray-400 dark:hover:border-gray-600 hover:shadow-lg transition-all group">
                <div class="flex items-center mb-3">
                    <x-heroicon-o-chart-bar class="w-8 h-8 mr-3 text-gray-900 dark:text-white group-hover:scale-110 transition-transform" />
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Usage Dashboard</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400">Live API usage statistics with per-endpoint breakdown.</p>
            </a>

            <a href="/changelog" class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:border-gray-400 dark:hover:border-gray-600 hover:shadow-lg transition-all group">
                <div class="flex items-center mb-3">
                    <x-heroicon-o-megaphone class="w-8 h-8 mr-3 text-gray-900 dark:text-white group-hover:scale-110 transition-transform" />
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Changelog</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400">See what's new and improved. Full release history.</p>
            </a>
        </div>

        <!-- CTA Section -->
        <div class="bg-gradient-to-r from-primary-600 to-primary-700 rounded-2xl p-12 text-center text-white">
            <h2 class="text-3xl font-bold mb-4">Ready to start generating?</h2>
            <p class="text-xl text-primary-100 mb-8">Start creating amazing placeholders in seconds.</p>
            <a href="/image" class="inline-flex items-center px-8 py-4 bg-white text-primary-600 font-semibold rounded-lg hover:bg-primary-50 transition-colors shadow-lg">
                Try It Free
                <x-heroicon-o-arrow-right class="w-5 h-5 ml-2" />
            </a>
        </div>
    </div>
</x-layout>
