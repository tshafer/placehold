<x-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">Markdown Placeholder</h1>
            <p class="text-gray-600 dark:text-gray-400">Generate realistic Markdown documents with headings, lists, code blocks, tables, and more. Ideal for testing parsers and CMS content.</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-8">
            <div class="space-y-8">
                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white flex items-center">
                        <x-heroicon-o-command-line class="w-6 h-6 mr-2 text-gray-900 dark:text-white" />
                        Endpoint
                    </h3>
                    <div class="bg-gray-900 p-4 rounded-lg">
                        <code class="text-green-400 text-sm break-all font-mono">GET /md?sections=5&title=My+Article</code>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 mt-3">Returns a Markdown document with randomized sections containing paragraphs, lists, code blocks, tables, and more.</p>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Parameters</h3>
                    <div class="space-y-2">
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">sections</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Number of sections (1–20, default: 5)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">title</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Document title (auto-generated if empty)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">seed</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Integer seed for deterministic output</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">features</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">"all" or comma-separated list of features to include</span>
                        </div>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Available Features</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                        @foreach([
                            'paragraph' => 'Body paragraphs',
                            'list' => 'Bullet lists',
                            'ordered_list' => 'Numbered lists',
                            'code' => 'Fenced code blocks',
                            'table' => 'Markdown tables',
                            'blockquote' => 'Block quotes',
                            'image' => 'Placeholder images',
                            'link' => 'External links',
                            'bold_italic' => 'Bold & italic text',
                            'h3' => 'Sub-headings (###)',
                            'toc' => 'Table of contents',
                        ] as $feat => $desc)
                            <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-3">
                                <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white">{{ $feat }}</span>
                                <span class="block text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{ $desc }}</span>
                            </div>
                        @endforeach
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Example Usage</h3>
                    <div class="space-y-6">
                        <div>
                            <p class="text-gray-700 dark:text-gray-300 mb-2 font-medium">Default document (all features):</p>
                            <div class="bg-gray-900 p-4 rounded-lg mb-3">
                                <code class="text-green-400 text-sm break-all font-mono">/md</code>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-4 font-mono text-xs text-gray-700 dark:text-gray-300 overflow-x-auto">
<pre class="whitespace-pre-wrap"># Dolorem rerum architecto voluptatem

> Sed ut perspiciatis unde omnis iste natus error sit voluptatem.

## Table of Contents

- [Section 1](#section-1)
- [Section 2](#section-2)

---

## Consectetur adipiscing elit

Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua...

- Item one with some detail
- Item two explaining another point
  - Nested sub-item

```javascript
function processData(data) {
  const result = data.map(item => item.value);
  return result.filter(Boolean);
}
```

| Name | Status | Date |
| --- | --- | --- |
| alpha | active | 2025-01-15 |
| beta | pending | 2025-03-22 |</pre>
                            </div>
                        </div>

                        <div>
                            <p class="text-gray-700 dark:text-gray-300 mb-2 font-medium">Code & tables only:</p>
                            <div class="bg-gray-900 p-4 rounded-lg">
                                <code class="text-green-400 text-sm break-all font-mono">/md?sections=3&features=paragraph,code,table&seed=42</code>
                            </div>
                        </div>

                        <div>
                            <p class="text-gray-700 dark:text-gray-300 mb-2 font-medium">Long technical doc:</p>
                            <div class="bg-gray-900 p-4 rounded-lg">
                                <code class="text-green-400 text-sm break-all font-mono">/md?sections=10&title=Technical+Documentation&features=all</code>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Rate Limiting</h3>
                    <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                        <p class="text-gray-700 dark:text-gray-300 text-sm">120 requests per minute</p>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Try It Now</h3>
                    <a href="/md?sections=5&seed=1" target="_blank"
                       class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors shadow-lg">
                        <x-heroicon-o-bolt class="w-5 h-5 mr-2" />
                        Generate Markdown
                    </a>
                </section>
            </div>
        </div>
    </div>
</x-layout>
