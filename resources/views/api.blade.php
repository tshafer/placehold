<x-layout>
    <section class="mb-16">
        <span class="text-tertiary font-headline font-bold text-xs tracking-[0.3em] uppercase mb-4 block">Reference</span>
        <h1 class="text-5xl md:text-7xl font-headline font-extrabold tracking-tighter text-on-surface leading-none mb-4">
            API <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-tertiary">Documentation</span>
        </h1>
        <p class="text-on-surface-variant text-sm max-w-xl">Comprehensive guide to our placeholder APIs</p>
    </section>

    <div class="bg-surface-container-low p-6 lg:p-8 mb-10 border-l-2 border-tertiary/40">
        <div class="flex items-center gap-3 mb-3">
            <span class="material-symbols-outlined text-tertiary">bolt</span>
            <h2 class="font-headline font-bold text-on-surface text-lg">Quick Start</h2>
        </div>
        <p class="text-on-surface-variant text-sm mb-4">Generate your first placeholder image in seconds:</p>
        <div class="space-y-2 mb-4">
            <div class="code-block">
                <code class="text-tertiary text-sm font-mono">GET https://placehold.cloud/640x320?text=Hello</code>
            </div>
            <div class="code-block">
                <code class="text-tertiary text-sm font-mono">GET https://placehold.cloud/p/500x300/FF5733/FFFFFF</code>
            </div>
        </div>
        <p class="text-outline text-xs">No API key required &bull; Free forever &bull; 9 image formats &bull; Production-ready</p>
    </div>

    <div class="bg-surface-container-low p-6 lg:p-8">
        <section class="mb-12">
            <h2 class="section-title mb-8">Introduction</h2>
            <p class="text-on-surface-variant text-sm">
                Welcome to the placehold.cloud API documentation. Our API allows you to generate custom placeholder images (9 formats), lorem ipsum text, quotes, jokes, weather information, recipes, colors, and holdicons programmatically. This comprehensive guide will help you integrate our services into your applications with ease.
            </p>
        </section>

        <section class="mb-12">
            <h2 class="section-title mb-8">Authentication</h2>
            <p class="text-on-surface-variant text-sm">
                No authentication is required to use our API. However, please be mindful of our rate limits and fair usage policy. We recommend including your application name in the User-Agent header for better request tracking and support.
            </p>
        </section>

        <section class="mb-12">
            <h2 class="section-title mb-8">Base URL</h2>
            <p class="text-on-surface-variant text-sm mb-4">All API requests should be made to:</p>
            <div class="code-block mb-4">
                <code class="text-tertiary text-sm font-mono">https://placehold.cloud</code>
            </div>
            <div class="bg-surface-container-lowest p-4 border-l-2 border-secondary/40 flex items-start gap-3">
                <span class="material-symbols-outlined text-secondary text-base mt-0.5 shrink-0">info</span>
                <span class="text-on-surface-variant text-sm">All endpoints are public and can be accessed directly via GET requests. No authentication required!</span>
            </div>
        </section>

        <section class="mb-12">
            <h2 class="section-title mb-10">Endpoints</h2>

            <div class="space-y-10">
                <div>
                    <h3 class="font-headline font-bold text-on-surface text-sm uppercase tracking-widest mb-4">1. Placeholder Images</h3>
                    <p class="text-on-surface-variant text-sm mb-2"><strong class="text-on-surface">Endpoints:</strong> <code class="font-mono text-xs text-primary">/p/{size}/{background}/{text_color}</code> or <code class="font-mono text-xs text-primary">/{size}</code></p>
                    <p class="text-on-surface-variant text-sm mb-2"><strong class="text-on-surface">Method:</strong> GET</p>
                    <p class="text-on-surface-variant text-sm mb-3"><strong class="text-on-surface">Parameters:</strong></p>
                    <div class="space-y-0 mb-4">
                        <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors"><span class="font-mono text-xs font-bold text-primary w-24 shrink-0">size</span><span class="text-outline text-xs">Dimensions (e.g., 500x300 or just 640x320)</span></div>
                        <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors"><span class="font-mono text-xs font-bold text-primary w-24 shrink-0">format</span><span class="text-outline text-xs">png, jpg, jpeg, webp, gif, avif, bmp, ico, svg</span></div>
                        <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors"><span class="font-mono text-xs font-bold text-primary w-24 shrink-0">text</span><span class="text-outline text-xs">Custom text</span></div>
                        <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors"><span class="font-mono text-xs font-bold text-primary w-24 shrink-0">bg</span><span class="text-outline text-xs">Background color (short alias)</span></div>
                        <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors"><span class="font-mono text-xs font-bold text-primary w-24 shrink-0">fg</span><span class="text-outline text-xs">Text color (short alias)</span></div>
                    </div>
                    <p class="text-on-surface-variant text-sm mb-3"><strong class="text-on-surface">Examples:</strong></p>
                    <div class="space-y-2">
                        <div class="code-block"><code class="text-tertiary text-sm font-mono break-all">/p/500x300/FF5733/FFFFFF?text=Hello+World</code></div>
                        <div class="code-block"><code class="text-tertiary text-sm font-mono break-all">/640x320?text=Case+Study&bg=efefef&fg=374151</code></div>
                        <div class="code-block"><code class="text-tertiary text-sm font-mono break-all">/500x300?text=Preview&format=webp</code></div>
                    </div>
                </div>

                <div>
                    <h3 class="font-headline font-bold text-on-surface text-sm uppercase tracking-widest mb-4">2. Lorem Ipsum</h3>
                    <p class="text-on-surface-variant text-sm mb-2"><strong class="text-on-surface">Endpoint:</strong> <code class="font-mono text-xs text-primary">GET /l</code></p>
                    <div class="space-y-0 mb-4">
                        <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors"><span class="font-mono text-xs font-bold text-primary w-24 shrink-0">paragraphs</span><span class="text-outline text-xs">Number of paragraphs (1-100)</span></div>
                        <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors"><span class="font-mono text-xs font-bold text-primary w-24 shrink-0">format</span><span class="text-outline text-xs">json, html, text</span></div>
                    </div>
                    <p class="text-on-surface-variant text-sm mb-3"><strong class="text-on-surface">Example:</strong></p>
                    <div class="code-block"><code class="text-tertiary text-sm font-mono break-all">/l?paragraphs=3&format=json</code></div>
                </div>

                <div>
                    <h3 class="font-headline font-bold text-on-surface text-sm uppercase tracking-widest mb-4">3. Quotes</h3>
                    <p class="text-on-surface-variant text-sm mb-2"><strong class="text-on-surface">Endpoint:</strong> <code class="font-mono text-xs text-primary">GET /q</code></p>
                    <p class="text-on-surface-variant text-sm">Returns a random inspirational quote.</p>
                    <div class="code-block mt-4"><code class="text-tertiary text-sm font-mono break-all">/q</code></div>
                </div>

                <div>
                    <h3 class="font-headline font-bold text-on-surface text-sm uppercase tracking-widest mb-4">4. Jokes</h3>
                    <p class="text-on-surface-variant text-sm mb-2"><strong class="text-on-surface">Endpoint:</strong> <code class="font-mono text-xs text-primary">GET /j</code></p>
                    <p class="text-on-surface-variant text-sm">Returns a random joke from our database.</p>
                    <div class="code-block mt-4"><code class="text-tertiary text-sm font-mono break-all">/j</code></div>
                </div>

                <div>
                    <h3 class="font-headline font-bold text-on-surface text-sm uppercase tracking-widest mb-4">5. Weather</h3>
                    <p class="text-on-surface-variant text-sm mb-2"><strong class="text-on-surface">Endpoint:</strong> <code class="font-mono text-xs text-primary">GET /w</code></p>
                    <div class="space-y-0 mb-4">
                        <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors"><span class="font-mono text-xs font-bold text-primary w-24 shrink-0">city</span><span class="text-outline text-xs">City name (required)</span></div>
                        <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors"><span class="font-mono text-xs font-bold text-primary w-24 shrink-0">country</span><span class="text-outline text-xs">Country code (required)</span></div>
                    </div>
                    <div class="code-block"><code class="text-tertiary text-sm font-mono break-all">/w?city=London&country=GB</code></div>
                </div>

                <div>
                    <h3 class="font-headline font-bold text-on-surface text-sm uppercase tracking-widest mb-4">6. Recipes</h3>
                    <p class="text-on-surface-variant text-sm mb-2"><strong class="text-on-surface">Endpoint:</strong> <code class="font-mono text-xs text-primary">GET /r</code></p>
                    <p class="text-on-surface-variant text-sm">Returns random recipes from TheMealDB API.</p>
                    <div class="code-block mt-4"><code class="text-tertiary text-sm font-mono break-all">/r</code></div>
                </div>

                <div>
                    <h3 class="font-headline font-bold text-on-surface text-sm uppercase tracking-widest mb-4">7. Colors</h3>
                    <p class="text-on-surface-variant text-sm mb-2"><strong class="text-on-surface">Endpoint:</strong> <code class="font-mono text-xs text-primary">GET /c</code></p>
                    <p class="text-on-surface-variant text-sm mb-3">Generate color palettes, hex codes, and named colors.</p>
                    <div class="space-y-0 mb-4">
                        <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors"><span class="font-mono text-xs font-bold text-primary w-24 shrink-0">type</span><span class="text-outline text-xs">palette, hex, or named (default: palette)</span></div>
                        <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors"><span class="font-mono text-xs font-bold text-primary w-24 shrink-0">count</span><span class="text-outline text-xs">Number of results (1-10, default: 5)</span></div>
                    </div>
                    <div class="code-block"><code class="text-tertiary text-sm font-mono break-all">/c?type=palette&count=3</code></div>
                </div>

                <div>
                    <h3 class="font-headline font-bold text-on-surface text-sm uppercase tracking-widest mb-4">8. Holdicons</h3>
                    <p class="text-on-surface-variant text-sm mb-2"><strong class="text-on-surface">Endpoint:</strong> <code class="font-mono text-xs text-primary">GET /h</code></p>
                    <p class="text-on-surface-variant text-sm">Generate placeholder icons with text, cats, dogs, or robots.</p>
                    <div class="code-block mt-4"><code class="text-tertiary text-sm font-mono break-all">/h?width=128&height=128&text=Hi</code></div>
                </div>
            </div>
        </section>

        <section class="mb-12">
            <h2 class="section-title mb-8">Rate Limits</h2>
            <p class="text-on-surface-variant text-sm">
                To ensure fair usage, we limit requests to 100 per hour per IP address. If you exceed this limit, you'll receive a 429 Too Many Requests response. The response will include a Retry-After header indicating how long to wait before making another request.
            </p>
        </section>

        <section class="mb-12">
            <h2 class="section-title mb-8">Error Handling</h2>
            <p class="text-on-surface-variant text-sm mb-4">
                Our API uses conventional HTTP response codes to indicate the success or failure of an API request. In general:
            </p>
            <ul class="space-y-2 ml-4">
                <li class="text-on-surface-variant text-sm flex items-start gap-2"><span class="text-tertiary">&bull;</span> 2xx range indicate success</li>
                <li class="text-on-surface-variant text-sm flex items-start gap-2"><span class="text-tertiary">&bull;</span> 4xx range indicate an error that failed given the information provided</li>
                <li class="text-on-surface-variant text-sm flex items-start gap-2"><span class="text-tertiary">&bull;</span> 5xx range indicate an error with our servers</li>
            </ul>
        </section>

        <section>
            <h2 class="section-title mb-8">Support</h2>
            <p class="text-on-surface-variant text-sm">
                If you have any questions or need assistance with our API, please don't hesitate to contact our support team at
                <a href="mailto:support@placehold.cloud" class="text-primary hover:text-tertiary transition-colors">support@placehold.cloud</a>. We're here to help you integrate our services seamlessly into your applications.
            </p>
        </section>
    </div>
</x-layout>
