<x-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">Video Placeholder</h1>
            <p class="text-gray-600 dark:text-gray-400">Generate static-color MP4 video files at any resolution and duration. Great for testing video players, uploads, and streaming.</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-8">
            <div class="space-y-8">
                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white flex items-center">
                        <x-heroicon-o-command-line class="w-6 h-6 mr-2 text-gray-900 dark:text-white" />
                        Endpoint
                    </h3>
                    <div class="bg-gray-900 p-4 rounded-lg">
                        <code class="text-green-400 text-sm break-all font-mono">GET /video?w=1280&h=720&duration=10</code>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 mt-3">Returns an MP4 video with a solid color background and optional text overlay showing the dimensions.</p>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Parameters</h3>
                    <div class="space-y-2">
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">w</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Width in pixels (16–1920, default: 640)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">h</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Height in pixels (16–1080, default: 360)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">duration</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Duration in seconds (1–30, default: 5)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">bg</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Background hex color without # (default: 374151)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">fg</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Text hex color without # (default: ffffff)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">fps</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Frames per second (1–60, default: 24)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">text</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Overlay text (default: "WxH")</span>
                        </div>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Example Usage</h3>
                    <div class="space-y-6">
                        <div>
                            <p class="text-gray-700 dark:text-gray-300 mb-2 font-medium">Default 640x360, 5 seconds:</p>
                            <div class="bg-gray-900 p-4 rounded-lg mb-3">
                                <code class="text-green-400 text-sm break-all font-mono">/video</code>
                            </div>
                            <div class="rounded-lg overflow-hidden shadow-md inline-block">
                                <div class="bg-gray-700 flex items-center justify-center text-white font-mono text-sm" style="width:320px;height:180px">
                                    <div class="text-center">
                                        <x-heroicon-o-film class="w-8 h-8 mx-auto mb-2 opacity-60" />
                                        640 × 360 &middot; 5s
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <p class="text-gray-700 dark:text-gray-300 mb-2 font-medium">1080p, 3 seconds, indigo background:</p>
                            <div class="bg-gray-900 p-4 rounded-lg mb-3">
                                <code class="text-green-400 text-sm break-all font-mono">/video?w=1920&h=1080&duration=3&bg=6366f1</code>
                            </div>
                            <div class="rounded-lg overflow-hidden shadow-md inline-block">
                                <div class="flex items-center justify-center text-white font-mono text-sm" style="width:384px;height:216px;background:#6366f1">
                                    <div class="text-center">
                                        <x-heroicon-o-film class="w-8 h-8 mx-auto mb-2 opacity-60" />
                                        1920 × 1080 &middot; 3s
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <p class="text-gray-700 dark:text-gray-300 mb-2 font-medium">Small, 10 seconds, custom text:</p>
                            <div class="bg-gray-900 p-4 rounded-lg mb-3">
                                <code class="text-green-400 text-sm break-all font-mono">/video?w=320&h=240&duration=10&text=Loading...&bg=059669</code>
                            </div>
                            <div class="rounded-lg overflow-hidden shadow-md inline-block">
                                <div class="flex items-center justify-center text-white font-mono text-sm" style="width:320px;height:240px;background:#059669">
                                    <div class="text-center">
                                        <x-heroicon-o-film class="w-8 h-8 mx-auto mb-2 opacity-60" />
                                        Loading... &middot; 10s
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Rate Limiting</h3>
                    <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                        <p class="text-gray-700 dark:text-gray-300 text-sm">10 requests per minute. Video encoding is CPU-intensive; please keep requests reasonable.</p>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Try It Now</h3>
                    <a href="/video?w=640&h=360&duration=3" target="_blank"
                       class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors shadow-lg">
                        <x-heroicon-o-bolt class="w-5 h-5 mr-2" />
                        Download Sample Video
                    </a>
                </section>
            </div>
        </div>
    </div>
</x-layout>
