<x-layout>
    <div class="mb-16">
        <span class="text-tertiary font-headline font-bold text-xs tracking-[0.3em] uppercase mb-4 block">Media Generation</span>
        <h1 class="text-5xl md:text-7xl font-headline font-extrabold tracking-tighter text-on-surface leading-none mb-4">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-tertiary">Video</span> Placeholder
        </h1>
        <p class="text-on-surface-variant text-sm max-w-2xl">Generate static-color MP4 video files at any resolution and duration. Great for testing video players, uploads, and streaming.</p>
    </div>

    <div class="bg-surface-container-low p-6 lg:p-8">
        <div class="space-y-10">
            <section>
                <h3 class="section-title mb-8 flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">terminal</span>
                    Endpoint
                </h3>
                <div class="code-block">
                    <code class="break-all">GET /video?w=1280&h=720&duration=10</code>
                </div>
                <p class="text-on-surface-variant text-sm mt-4">Returns an MP4 video with a solid color background and optional text overlay showing the dimensions.</p>
            </section>

            <section>
                <h3 class="section-title mb-8">Parameters</h3>
                <div class="space-y-1">
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">w</span>
                        <span class="text-outline text-xs">Width in pixels (16–1920, default: 640)</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">h</span>
                        <span class="text-outline text-xs">Height in pixels (16–1080, default: 360)</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">duration</span>
                        <span class="text-outline text-xs">Duration in seconds (1–30, default: 5)</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">bg</span>
                        <span class="text-outline text-xs">Background hex color without # (default: 374151)</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">fg</span>
                        <span class="text-outline text-xs">Text hex color without # (default: ffffff)</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">fps</span>
                        <span class="text-outline text-xs">Frames per second (1–60, default: 24)</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">text</span>
                        <span class="text-outline text-xs">Overlay text (default: "WxH")</span>
                    </div>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Example Usage</h3>
                <div class="space-y-8">
                    <div>
                        <span class="terminal-label mb-2 block">Default 640x360, 5 seconds</span>
                        <div class="code-block mb-4">
                            <code class="break-all">/video</code>
                        </div>
                        <div class="overflow-hidden inline-block">
                            <div class="bg-surface-container-lowest flex items-center justify-center text-on-surface font-mono text-sm" style="width:320px;height:180px">
                                <div class="text-center">
                                    <span class="material-symbols-outlined text-3xl opacity-60 mb-2 block">movie</span>
                                    640 × 360 &middot; 5s
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <span class="terminal-label mb-2 block">1080p, 3 seconds, indigo background</span>
                        <div class="code-block mb-4">
                            <code class="break-all">/video?w=1920&h=1080&duration=3&bg=6366f1</code>
                        </div>
                        <div class="overflow-hidden inline-block">
                            <div class="flex items-center justify-center text-white font-mono text-sm" style="width:384px;height:216px;background:#6366f1">
                                <div class="text-center">
                                    <span class="material-symbols-outlined text-3xl opacity-60 mb-2 block">movie</span>
                                    1920 × 1080 &middot; 3s
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <span class="terminal-label mb-2 block">Small, 10 seconds, custom text</span>
                        <div class="code-block mb-4">
                            <code class="break-all">/video?w=320&h=240&duration=10&text=Loading...&bg=059669</code>
                        </div>
                        <div class="overflow-hidden inline-block">
                            <div class="flex items-center justify-center text-white font-mono text-sm" style="width:320px;height:240px;background:#059669">
                                <div class="text-center">
                                    <span class="material-symbols-outlined text-3xl opacity-60 mb-2 block">movie</span>
                                    Loading... &middot; 10s
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Rate Limiting</h3>
                <div class="bg-surface-container-lowest border-t-2 border-secondary p-4 flex items-center gap-3">
                    <span class="w-2 h-2 rounded-full bg-secondary animate-beacon-pulse"></span>
                    <p class="text-on-surface-variant text-sm">10 requests per minute. Video encoding is CPU-intensive; please keep requests reasonable.</p>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Try It Now</h3>
                <a href="/video?w=640&h=360&duration=3" target="_blank"
                   class="liquid-chrome p-3 font-headline font-bold text-on-primary-container uppercase tracking-widest text-xs inline-flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">bolt</span>
                    Download Sample Video
                </a>
            </section>
        </div>
    </div>
</x-layout>
