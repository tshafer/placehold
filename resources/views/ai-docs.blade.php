<x-layout>
    <section class="mb-16">
        <span class="text-tertiary font-headline font-bold text-xs tracking-[0.3em] uppercase mb-4 block">AI &amp; LLMs</span>
        <h1 class="text-5xl md:text-7xl font-headline font-extrabold tracking-tighter text-on-surface leading-none mb-4">
            AI <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-tertiary">Documentation</span>
        </h1>
        <p class="text-on-surface-variant text-sm max-w-xl">Use placehold.cloud from AI assistants, agents, and LLM-powered apps — via direct API or MCP.</p>
    </section>

    <div class="bg-surface-container-low p-6 lg:p-8 mb-10 border-l-2 border-tertiary/40">
        <div class="flex items-center gap-3 mb-3">
            <span class="material-symbols-outlined text-tertiary">smart_toy</span>
            <h2 class="font-headline font-bold text-on-surface text-lg">For AI / LLM use</h2>
        </div>
        <p class="text-on-surface-variant text-sm mb-4">No API keys. No auth. GET-only for most endpoints. Ideal for agents that need placeholder images, mock text, quotes, UUIDs, or colors.</p>
        <div class="code-block mb-4">
            <code class="text-tertiary text-sm font-mono">Base URL: https://placehold.cloud</code>
        </div>
        <p class="text-outline text-xs">Rate limits apply per IP; use User-Agent to identify your agent if you need support.</p>
    </div>

    <div class="bg-surface-container-low p-6 lg:p-8 mb-10">
        <h2 class="section-title mb-6">Direct API (HTTP)</h2>
        <p class="text-on-surface-variant text-sm mb-6">Any LLM or agent that can perform HTTP GET can call these endpoints. Return types: images (binary), JSON (quotes, jokes, lorem, UUIDs, colors), or plain text.</p>
        <div class="space-y-4">
            <div class="flex flex-col gap-1">
                <span class="font-mono text-xs font-bold text-primary">GET /640x320?text=...&bg=...&fg=...</span>
                <span class="text-outline text-xs">Placeholder image. Optional: text, bg, fg (hex), format=png|jpg|webp|svg|...</span>
            </div>
            <div class="flex flex-col gap-1">
                <span class="font-mono text-xs font-bold text-primary">GET /q</span>
                <span class="text-outline text-xs">Random quote (JSON).</span>
            </div>
            <div class="flex flex-col gap-1">
                <span class="font-mono text-xs font-bold text-primary">GET /j</span>
                <span class="text-outline text-xs">Random joke (JSON).</span>
            </div>
            <div class="flex flex-col gap-1">
                <span class="font-mono text-xs font-bold text-primary">GET /l?paragraphs=3&format=json|text|html</span>
                <span class="text-outline text-xs">Lorem ipsum placeholder text.</span>
            </div>
            <div class="flex flex-col gap-1">
                <span class="font-mono text-xs font-bold text-primary">GET /uuid?count=1</span>
                <span class="text-outline text-xs">UUID(s) (JSON: uuids array).</span>
            </div>
            <div class="flex flex-col gap-1">
                <span class="font-mono text-xs font-bold text-primary">GET /c?type=palette|hex|named&count=5</span>
                <span class="text-outline text-xs">Color palettes or hex codes (JSON).</span>
            </div>
        </div>
        <p class="text-outline text-xs mt-6">Full reference: <a href="/api" class="text-primary hover:text-tertiary transition-colors">API Documentation</a>.</p>
    </div>

    <div class="bg-surface-container-low p-6 lg:p-8 mb-10">
        <h2 class="section-title mb-6">MCP server (recommended for Cursor / Claude)</h2>
        <p class="text-on-surface-variant text-sm mb-6">We provide an <strong class="text-on-surface">MCP (Model Context Protocol)</strong> server so AI assistants can call placehold.cloud as tools — no need to construct URLs or parse responses yourself.</p>
        <div class="space-y-4 mb-6">
            <p class="text-on-surface-variant text-sm font-headline font-bold">Tools exposed:</p>
            <ul class="space-y-2 text-on-surface-variant text-sm">
                <li><code class="font-mono text-xs text-primary bg-surface-container-lowest px-1 py-0.5">placehold_image</code> — Generate placeholder image URL (size, text, bg, fg, format).</li>
                <li><code class="font-mono text-xs text-primary bg-surface-container-lowest px-1 py-0.5">placehold_quote</code> — Random quote.</li>
                <li><code class="font-mono text-xs text-primary bg-surface-container-lowest px-1 py-0.5">placehold_joke</code> — Random joke.</li>
                <li><code class="font-mono text-xs text-primary bg-surface-container-lowest px-1 py-0.5">placehold_lorem</code> — Lorem ipsum (paragraphs, format).</li>
                <li><code class="font-mono text-xs text-primary bg-surface-container-lowest px-1 py-0.5">placehold_uuid</code> — Generate UUID(s).</li>
                <li><code class="font-mono text-xs text-primary bg-surface-container-lowest px-1 py-0.5">placehold_colors</code> — Color palettes / hex / named.</li>
            </ul>
        </div>
        <p class="text-on-surface-variant text-sm font-headline font-bold mb-2">Easiest: connect by URL</p>
        <p class="text-on-surface-variant text-sm mb-4">If we host the MCP server on our side, you can point Cursor or Claude at a URL (e.g. <code class="font-mono text-xs bg-surface-container-lowest px-1">https://placehold.cloud/mcp</code>) and use the tools with no install. Add the server by URL in your MCP settings instead of by command.</p>
        <p class="text-outline text-xs">Add the server by URL in your MCP settings; no install or local setup required.</p>
    </div>

    <div class="bg-surface-container-low p-6 lg:p-8 mb-10">
        <h2 class="section-title mb-6">Example use cases for AI</h2>
        <ul class="space-y-3 text-on-surface-variant text-sm">
            <li class="flex items-start gap-2"><span class="text-tertiary mt-0.5">•</span> <strong class="text-on-surface">Mockups:</strong> “Generate a 800×600 placeholder image with text ‘Coming soon’ and use it in this HTML.”</li>
            <li class="flex items-start gap-2"><span class="text-tertiary mt-0.5">•</span> <strong class="text-on-surface">Demos:</strong> “Add three placeholder images to this gallery component using placehold.cloud.”</li>
            <li class="flex items-start gap-2"><span class="text-tertiary mt-0.5">•</span> <strong class="text-on-surface">Content:</strong> “Fill this section with 2 paragraphs of lorem ipsum and a random quote.”</li>
            <li class="flex items-start gap-2"><span class="text-tertiary mt-0.5">•</span> <strong class="text-on-surface">IDs:</strong> “Generate 5 UUIDs for use as temporary entity IDs.”</li>
            <li class="flex items-start gap-2"><span class="text-tertiary mt-0.5">•</span> <strong class="text-on-surface">Themes:</strong> “Get a 5-color palette and suggest CSS variables from it.”</li>
        </ul>
    </div>

    <div class="bg-surface-container-low p-6 lg:p-8">
        <h2 class="section-title mb-6">Rate limits &amp; errors</h2>
        <p class="text-on-surface-variant text-sm mb-4">Endpoints are rate-limited per IP (e.g. 100–120 requests per minute depending on endpoint). On 429, respect the <code class="font-mono text-xs bg-surface-container-lowest px-1">Retry-After</code> header. 4xx/5xx responses indicate client or server error; do not retry indefinitely.</p>
        <p class="text-on-surface-variant text-sm">For full API details and all endpoints, see <a href="/api" class="text-primary hover:text-tertiary transition-colors">API Documentation</a>.</p>
    </div>
</x-layout>
