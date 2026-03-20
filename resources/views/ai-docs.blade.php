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
            <ul class="space-y-2 text-on-surface-variant text-sm columns-1 sm:columns-2 gap-x-6 list-disc list-inside">
                <li><code class="font-mono text-xs text-primary bg-surface-container-lowest px-1 py-0.5">placehold_image</code> — Placeholder image URL</li>
                <li><code class="font-mono text-xs text-primary bg-surface-container-lowest px-1 py-0.5">placehold_quote</code> — Random quote</li>
                <li><code class="font-mono text-xs text-primary bg-surface-container-lowest px-1 py-0.5">placehold_joke</code> — Random joke</li>
                <li><code class="font-mono text-xs text-primary bg-surface-container-lowest px-1 py-0.5">placehold_lorem</code> — Lorem ipsum text</li>
                <li><code class="font-mono text-xs text-primary bg-surface-container-lowest px-1 py-0.5">placehold_uuid</code> — UUID(s)</li>
                <li><code class="font-mono text-xs text-primary bg-surface-container-lowest px-1 py-0.5">placehold_colors</code> — Color palettes / hex / named</li>
                <li><code class="font-mono text-xs text-primary bg-surface-container-lowest px-1 py-0.5">placehold_weather</code> — Weather (city, country)</li>
                <li><code class="font-mono text-xs text-primary bg-surface-container-lowest px-1 py-0.5">placehold_recipe</code> — Random recipe(s)</li>
                <li><code class="font-mono text-xs text-primary bg-surface-container-lowest px-1 py-0.5">placehold_holdicon</code> — Holdicon URL (text/cat/dog/robot)</li>
                <li><code class="font-mono text-xs text-primary bg-surface-container-lowest px-1 py-0.5">placehold_avatar</code> — Identicon avatar URL</li>
                <li><code class="font-mono text-xs text-primary bg-surface-container-lowest px-1 py-0.5">placehold_qr</code> — QR code URL</li>
                <li><code class="font-mono text-xs text-primary bg-surface-container-lowest px-1 py-0.5">placehold_pdf</code> — PDF document URL</li>
                <li><code class="font-mono text-xs text-primary bg-surface-container-lowest px-1 py-0.5">placehold_csv</code> — CSV/JSON data</li>
                <li><code class="font-mono text-xs text-primary bg-surface-container-lowest px-1 py-0.5">placehold_markdown</code> — Markdown placeholder</li>
                <li><code class="font-mono text-xs text-primary bg-surface-container-lowest px-1 py-0.5">placehold_video</code> — MP4 video URL</li>
                <li><code class="font-mono text-xs text-primary bg-surface-container-lowest px-1 py-0.5">placehold_base64</code> — Encode/decode base64</li>
                <li><code class="font-mono text-xs text-primary bg-surface-container-lowest px-1 py-0.5">placehold_hash</code> — Hash string</li>
                <li><code class="font-mono text-xs text-primary bg-surface-container-lowest px-1 py-0.5">placehold_color_convert</code> — Hex to RGB/complement/contrast</li>
                <li><code class="font-mono text-xs text-primary bg-surface-container-lowest px-1 py-0.5">placehold_json_users</code> — Fake users</li>
                <li><code class="font-mono text-xs text-primary bg-surface-container-lowest px-1 py-0.5">placehold_json_posts</code> — Fake posts</li>
                <li><code class="font-mono text-xs text-primary bg-surface-container-lowest px-1 py-0.5">placehold_json_comments</code> — Fake comments</li>
                <li><code class="font-mono text-xs text-primary bg-surface-container-lowest px-1 py-0.5">placehold_json_todos</code> — Fake todos</li>
            </ul>
        </div>
        <p class="text-on-surface-variant text-sm font-headline font-bold mb-2">Connect by URL</p>
        <p class="text-on-surface-variant text-sm mb-4">Point Cursor or Claude at <code class="font-mono text-xs bg-surface-container-lowest px-1">https://placehold.cloud/mcp</code>. No install required. Use the JSON below in your MCP settings.</p>

        <p class="text-on-surface-variant text-sm font-headline font-bold mb-2 mt-6">Cursor — copy into MCP settings (e.g. Settings → MCP)</p>
        <pre class="code-block overflow-x-auto text-tertiary text-xs font-mono p-4 mb-4 select-all" role="button" tabindex="0" title="Click to select, then copy">{ "mcpServers": {
  "placehold": {
    "url": "https://placehold.cloud/mcp"
  }
}}</pre>

        <p class="text-on-surface-variant text-sm font-headline font-bold mb-2 mt-6">Claude Desktop — add to <code class="font-mono text-xs bg-surface-container-lowest px-1">claude_desktop_config.json</code></p>
        <pre class="code-block overflow-x-auto text-tertiary text-xs font-mono p-4 mb-4 select-all" role="button" tabindex="0" title="Click to select, then copy">{ "mcpServers": {
  "placehold": {
    "url": "https://placehold.cloud/mcp"
  }
}}</pre>

        <p class="text-outline text-xs">Paste into your config, save, and restart the app. The <code class="font-mono text-xs">placehold</code> tools will then be available.</p>
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
