<x-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">PDF Placeholder Generator</h1>
            <p class="text-gray-600 dark:text-gray-400">Generate dummy PDF documents filled with lorem ipsum text. Perfect for testing uploads, previews, and document workflows.</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-8">
            <div class="space-y-8">
                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white flex items-center">
                        <x-heroicon-o-command-line class="w-6 h-6 mr-2 text-gray-900 dark:text-white" />
                        Endpoint
                    </h3>
                    <div class="bg-gray-900 p-4 rounded-lg">
                        <code class="text-green-400 text-sm break-all font-mono">GET /pdf?pages=5&title=My+Document</code>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 mt-3">Returns a PDF document with auto-generated headings and paragraphs of lorem ipsum on each page.</p>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Parameters</h3>
                    <div class="space-y-2">
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">pages</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Number of pages (1–50, default: 3)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">title</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Document title (default: "Sample Document")</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">size</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Page size: a4, letter, legal (default: a4)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">orientation</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">portrait or landscape (default: portrait)</span>
                        </div>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Example Usage</h3>
                    <div class="space-y-6">
                        <div>
                            <p class="text-gray-700 dark:text-gray-300 mb-2 font-medium">Default 3-page A4 document:</p>
                            <div class="bg-gray-900 p-4 rounded-lg mb-3">
                                <code class="text-green-400 text-sm break-all font-mono">/pdf</code>
                            </div>
                            <a href="/pdf" target="_blank" class="inline-flex items-center gap-3 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:border-gray-400 dark:hover:border-gray-500 transition-colors">
                                <div class="bg-red-100 dark:bg-red-900/30 rounded-lg p-3">
                                    <x-heroicon-o-document class="w-8 h-8 text-red-600 dark:text-red-400" />
                                </div>
                                <div>
                                    <span class="block text-sm font-medium text-gray-900 dark:text-white">Sample Document.pdf</span>
                                    <span class="block text-xs text-gray-500 dark:text-gray-400">3 pages &middot; A4 &middot; Portrait</span>
                                </div>
                            </a>
                        </div>

                        <div>
                            <p class="text-gray-700 dark:text-gray-300 mb-2 font-medium">10-page project report:</p>
                            <div class="bg-gray-900 p-4 rounded-lg mb-3">
                                <code class="text-green-400 text-sm break-all font-mono">/pdf?pages=10&title=Project+Report</code>
                            </div>
                            <a href="/pdf?pages=10&title=Project+Report" target="_blank" class="inline-flex items-center gap-3 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:border-gray-400 dark:hover:border-gray-500 transition-colors">
                                <div class="bg-red-100 dark:bg-red-900/30 rounded-lg p-3">
                                    <x-heroicon-o-document class="w-8 h-8 text-red-600 dark:text-red-400" />
                                </div>
                                <div>
                                    <span class="block text-sm font-medium text-gray-900 dark:text-white">Project Report.pdf</span>
                                    <span class="block text-xs text-gray-500 dark:text-gray-400">10 pages &middot; A4 &middot; Portrait</span>
                                </div>
                            </a>
                        </div>

                        <div>
                            <p class="text-gray-700 dark:text-gray-300 mb-2 font-medium">Landscape letter-size:</p>
                            <div class="bg-gray-900 p-4 rounded-lg mb-3">
                                <code class="text-green-400 text-sm break-all font-mono">/pdf?pages=2&size=letter&orientation=landscape</code>
                            </div>
                            <a href="/pdf?pages=2&size=letter&orientation=landscape" target="_blank" class="inline-flex items-center gap-3 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:border-gray-400 dark:hover:border-gray-500 transition-colors">
                                <div class="bg-red-100 dark:bg-red-900/30 rounded-lg p-3">
                                    <x-heroicon-o-document class="w-8 h-8 text-red-600 dark:text-red-400" />
                                </div>
                                <div>
                                    <span class="block text-sm font-medium text-gray-900 dark:text-white">Sample Document.pdf</span>
                                    <span class="block text-xs text-gray-500 dark:text-gray-400">2 pages &middot; Letter &middot; Landscape</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Rate Limiting</h3>
                    <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                        <p class="text-gray-700 dark:text-gray-300 text-sm">30 requests per minute</p>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Try It Now</h3>
                    <a href="/pdf?pages=5&title=Hello+World" target="_blank"
                       class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors shadow-lg">
                        <x-heroicon-o-bolt class="w-5 h-5 mr-2" />
                        Generate PDF
                    </a>
                </section>
            </div>
        </div>
    </div>
</x-layout>
