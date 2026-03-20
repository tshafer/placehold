<x-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl py-12">
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Markdown Placeholder</h1>
        <p class="text-xl text-gray-600 dark:text-gray-400 mb-10">Generate realistic Markdown documents with headings, lists, code blocks, tables, and more. Ideal for testing parsers and CMS content.</p>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 mb-8">
            <div class="flex items-center gap-3 mb-4">
                <x-heroicon-o-command-line class="w-6 h-6 text-gray-900 dark:text-white" />
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Basic Usage</h2>
            </div>
            <code class="block bg-gray-100 dark:bg-gray-900 rounded-lg px-4 py-3 text-sm text-gray-800 dark:text-gray-200 font-mono">GET /md?sections=5&title=My+Article</code>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Parameters</h2>
            <div class="space-y-3 text-sm">
                <div class="flex gap-4"><span class="font-mono font-medium text-primary-600 dark:text-primary-400 w-28 shrink-0">sections</span><span class="text-gray-600 dark:text-gray-400">Number of sections (1-20, default 5)</span></div>
                <div class="flex gap-4"><span class="font-mono font-medium text-primary-600 dark:text-primary-400 w-28 shrink-0">title</span><span class="text-gray-600 dark:text-gray-400">Document title (auto-generated if empty)</span></div>
                <div class="flex gap-4"><span class="font-mono font-medium text-primary-600 dark:text-primary-400 w-28 shrink-0">seed</span><span class="text-gray-600 dark:text-gray-400">Seed for deterministic output</span></div>
                <div class="flex gap-4"><span class="font-mono font-medium text-primary-600 dark:text-primary-400 w-28 shrink-0">features</span><span class="text-gray-600 dark:text-gray-400">"all" or comma-separated list of features to include</span></div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Available Features</h2>
            <div class="flex flex-wrap gap-2 text-xs font-mono">
                @foreach(['paragraph','list','ordered_list','code','table','blockquote','image','link','bold_italic','h3','toc'] as $feat)
                    <span class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-2 py-1 rounded">{{ $feat }}</span>
                @endforeach
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Examples</h2>
            <div class="space-y-3 text-sm">
                <a href="/md" class="block bg-gray-50 dark:bg-gray-900 rounded-lg px-4 py-3 font-mono text-primary-600 dark:text-primary-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">/md</a>
                <a href="/md?sections=3&features=paragraph,code,table&seed=42" class="block bg-gray-50 dark:bg-gray-900 rounded-lg px-4 py-3 font-mono text-primary-600 dark:text-primary-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">/md?sections=3&features=paragraph,code,table&seed=42</a>
                <a href="/md?sections=10&title=Technical+Documentation" class="block bg-gray-50 dark:bg-gray-900 rounded-lg px-4 py-3 font-mono text-primary-600 dark:text-primary-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">/md?sections=10&title=Technical+Documentation</a>
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
