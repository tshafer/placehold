<x-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl py-12">
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Video Placeholder</h1>
        <p class="text-xl text-gray-600 dark:text-gray-400 mb-10">Generate static-color MP4 video files at any resolution and duration. Great for testing video players, uploads, and streaming.</p>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 mb-8">
            <div class="flex items-center gap-3 mb-4">
                <x-heroicon-o-command-line class="w-6 h-6 text-gray-900 dark:text-white" />
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Basic Usage</h2>
            </div>
            <code class="block bg-gray-100 dark:bg-gray-900 rounded-lg px-4 py-3 text-sm text-gray-800 dark:text-gray-200 font-mono">GET /video?w=1280&h=720&duration=10</code>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Parameters</h2>
            <div class="space-y-3 text-sm">
                <div class="flex gap-4"><span class="font-mono font-medium text-primary-600 dark:text-primary-400 w-28 shrink-0">w</span><span class="text-gray-600 dark:text-gray-400">Width in pixels (16-1920, default 640)</span></div>
                <div class="flex gap-4"><span class="font-mono font-medium text-primary-600 dark:text-primary-400 w-28 shrink-0">h</span><span class="text-gray-600 dark:text-gray-400">Height in pixels (16-1080, default 360)</span></div>
                <div class="flex gap-4"><span class="font-mono font-medium text-primary-600 dark:text-primary-400 w-28 shrink-0">duration</span><span class="text-gray-600 dark:text-gray-400">Duration in seconds (1-30, default 5)</span></div>
                <div class="flex gap-4"><span class="font-mono font-medium text-primary-600 dark:text-primary-400 w-28 shrink-0">bg</span><span class="text-gray-600 dark:text-gray-400">Background hex color (default 374151)</span></div>
                <div class="flex gap-4"><span class="font-mono font-medium text-primary-600 dark:text-primary-400 w-28 shrink-0">fg</span><span class="text-gray-600 dark:text-gray-400">Text hex color (default ffffff)</span></div>
                <div class="flex gap-4"><span class="font-mono font-medium text-primary-600 dark:text-primary-400 w-28 shrink-0">fps</span><span class="text-gray-600 dark:text-gray-400">Frames per second (1-60, default 24)</span></div>
                <div class="flex gap-4"><span class="font-mono font-medium text-primary-600 dark:text-primary-400 w-28 shrink-0">text</span><span class="text-gray-600 dark:text-gray-400">Overlay text (default "WxH")</span></div>
            </div>
        </div>

        <div class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-700 rounded-xl p-4 mb-8 text-sm text-amber-800 dark:text-amber-300">
            <div class="flex gap-2">
                <x-heroicon-o-exclamation-triangle class="w-5 h-5 shrink-0 mt-0.5" />
                <span>Video generation requires server-side encoding and may take a few seconds. The endpoint is rate-limited to 10 requests per minute.</span>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Examples</h2>
            <div class="space-y-3 text-sm">
                <a href="/video" class="block bg-gray-50 dark:bg-gray-900 rounded-lg px-4 py-3 font-mono text-primary-600 dark:text-primary-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">/video</a>
                <a href="/video?w=1920&h=1080&duration=3&bg=6366f1" class="block bg-gray-50 dark:bg-gray-900 rounded-lg px-4 py-3 font-mono text-primary-600 dark:text-primary-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">/video?w=1920&h=1080&duration=3&bg=6366f1</a>
                <a href="/video?w=320&h=240&duration=10&text=Loading..." class="block bg-gray-50 dark:bg-gray-900 rounded-lg px-4 py-3 font-mono text-primary-600 dark:text-primary-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">/video?w=320&h=240&duration=10&text=Loading...</a>
            </div>
        </div>

        <div class="text-center">
            <a href="/api" class="inline-flex items-center gap-2 text-primary-600 dark:text-primary-400 font-medium hover:underline">
                <x-heroicon-o-bolt class="w-5 h-5" />
                View full API documentation
            </a>
        </div>
    </div>
</x-layout>
