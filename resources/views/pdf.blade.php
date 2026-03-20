<x-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl py-12">
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">PDF Placeholder Generator</h1>
        <p class="text-xl text-gray-600 dark:text-gray-400 mb-10">Generate dummy PDF documents filled with lorem ipsum text. Perfect for testing uploads, previews, and document workflows.</p>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 mb-8">
            <div class="flex items-center gap-3 mb-4">
                <x-heroicon-o-command-line class="w-6 h-6 text-gray-900 dark:text-white" />
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Basic Usage</h2>
            </div>
            <code class="block bg-gray-100 dark:bg-gray-900 rounded-lg px-4 py-3 text-sm text-gray-800 dark:text-gray-200 font-mono">GET /pdf?pages=5&title=My+Document</code>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Parameters</h2>
            <div class="space-y-3 text-sm">
                <div class="flex gap-4"><span class="font-mono font-medium text-primary-600 dark:text-primary-400 w-28 shrink-0">pages</span><span class="text-gray-600 dark:text-gray-400">Number of pages (1-50, default 3)</span></div>
                <div class="flex gap-4"><span class="font-mono font-medium text-primary-600 dark:text-primary-400 w-28 shrink-0">title</span><span class="text-gray-600 dark:text-gray-400">Document title (default "Sample Document")</span></div>
                <div class="flex gap-4"><span class="font-mono font-medium text-primary-600 dark:text-primary-400 w-28 shrink-0">size</span><span class="text-gray-600 dark:text-gray-400">Page size: a4, letter, legal (default a4)</span></div>
                <div class="flex gap-4"><span class="font-mono font-medium text-primary-600 dark:text-primary-400 w-28 shrink-0">orientation</span><span class="text-gray-600 dark:text-gray-400">portrait or landscape (default portrait)</span></div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Examples</h2>
            <div class="space-y-3 text-sm">
                <a href="/pdf" class="block bg-gray-50 dark:bg-gray-900 rounded-lg px-4 py-3 font-mono text-primary-600 dark:text-primary-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">/pdf</a>
                <a href="/pdf?pages=10&title=Project+Report" class="block bg-gray-50 dark:bg-gray-900 rounded-lg px-4 py-3 font-mono text-primary-600 dark:text-primary-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">/pdf?pages=10&title=Project+Report</a>
                <a href="/pdf?pages=2&size=letter&orientation=landscape" class="block bg-gray-50 dark:bg-gray-900 rounded-lg px-4 py-3 font-mono text-primary-600 dark:text-primary-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">/pdf?pages=2&size=letter&orientation=landscape</a>
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
