<footer class="w-full bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800 mt-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            <div class="col-span-1 md:col-span-2">
                <a href="/" class="flex items-center space-x-2 mb-4">
                    <svg width="32" height="32" viewBox="0 0 40 40" fill="none">
                        <rect width="40" height="40" rx="8" class="fill-gray-900 dark:fill-white"/>
                        <path d="M20 8L28 16H12L20 8Z" class="fill-white dark:fill-gray-900"/>
                        <path d="M8 20L16 28V12L8 20Z" class="fill-white dark:fill-gray-900"/>
                        <path d="M32 20L24 28V12L32 20Z" class="fill-white dark:fill-gray-900"/>
                        <path d="M20 32L28 24H12L20 32Z" class="fill-white dark:fill-gray-900"/>
                    </svg>
                    <span class="text-xl font-bold text-gray-900 dark:text-white">placehold.cloud</span>
                </a>
                <p class="text-gray-600 dark:text-gray-400 mb-4 max-w-md">
                    Your go-to solution for placeholder content and APIs. Free, fast, and production-ready.
                </p>
            </div>

            <div>
                <h4 class="text-sm font-semibold text-gray-900 dark:text-white uppercase tracking-wider mb-4">Tools</h4>
                <ul class="space-y-2">
                    <li><a href="/image" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">Images</a></li>
                    <li><a href="/lorem-ipsum" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">Text</a></li>
                    <li><a href="/quotes" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">Quotes</a></li>
                    <li><a href="/jokes" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">Jokes</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-sm font-semibold text-gray-900 dark:text-white uppercase tracking-wider mb-4">Company</h4>
                <ul class="space-y-2">
                    <li><a href="/about-us" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">About</a></li>
                    <li><a href="/api" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">API Docs</a></li>
                    <li><a href="/contact" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">Contact</a></li>
                    <li><a href="/privacy-policy" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">Privacy</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-200 dark:border-gray-800 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    &copy; {{ date('Y') }} placehold.cloud. All rights reserved.
                </p>
                <p class="text-gray-600 dark:text-gray-400 text-sm mt-4 md:mt-0">
                    Built with Laravel 12
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- Cookie Consent -->
<div id="cookie-consent" x-data="{ show: !localStorage.getItem('cookieConsent') }" x-show="show" x-transition
     class="fixed bottom-0 left-0 right-0 bg-gray-900 text-white py-4 px-6 shadow-lg z-50">
    <div class="container mx-auto flex flex-col sm:flex-row justify-between items-center gap-4">
        <p class="text-sm">We use cookies to improve your experience. By using our site, you agree to our <a href="/cookie-policy" class="underline hover:text-gray-300">Cookie Policy</a>.</p>
        <button @click="localStorage.setItem('cookieConsent', 'true'); show = false"
                class="bg-white text-gray-900 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors text-sm font-medium whitespace-nowrap">
            Accept
        </button>
    </div>
</div>
