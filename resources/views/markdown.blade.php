<x-layout>
    <div class="mb-16">
        <span class="text-tertiary font-headline font-bold text-xs tracking-[0.3em] uppercase mb-4 block">Content Generation</span>
        <h1 class="text-5xl md:text-7xl font-headline font-extrabold tracking-tighter text-on-surface leading-none mb-4">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-tertiary">Markdown</span> Placeholder
        </h1>
        <p class="text-on-surface-variant text-sm max-w-2xl">Generate realistic Markdown documents with headings, lists, code blocks, tables, and more. Ideal for testing parsers and CMS content.</p>
    </div>

    <div class="bg-surface-container-low p-6 lg:p-8">
        <div class="space-y-10">
            <section>
                <h3 class="section-title mb-8 flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">terminal</span>
                    Endpoint
                </h3>
                <div class="code-block">
                    <code class="break-all">GET /md?sections=5&title=My+Article</code>
                </div>
                <p class="text-on-surface-variant text-sm mt-4">Returns a Markdown document with randomized sections containing paragraphs, lists, code blocks, tables, and more.</p>
            </section>

            <section>
                <h3 class="section-title mb-8">Parameters</h3>
                <div class="space-y-1">
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">sections</span>
                        <span class="text-outline text-xs">Number of sections (1–20, default: 5)</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">title</span>
                        <span class="text-outline text-xs">Document title (auto-generated if empty)</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">seed</span>
                        <span class="text-outline text-xs">Integer seed for deterministic output</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">features</span>
                        <span class="text-outline text-xs">"all" or comma-separated list of features to include</span>
                    </div>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Available Features</h3>
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
                        <div class="bg-surface-container-lowest/50 p-3">
                            <span class="font-mono text-xs font-bold text-primary">{{ $feat }}</span>
                            <span class="block text-outline text-xs mt-0.5">{{ $desc }}</span>
                        </div>
                    @endforeach
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Example Usage</h3>
                <div class="space-y-8">
                    <div>
                        <span class="terminal-label mb-2 block">Default document (all features)</span>
                        <div class="code-block mb-4">
                            <code class="break-all">/md</code>
                        </div>
                        <div class="bg-surface-container-lowest p-4 font-mono text-xs text-on-surface-variant overflow-x-auto border-t-2 border-outline-variant">
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
                        <span class="terminal-label mb-2 block">Code & tables only</span>
                        <div class="code-block">
                            <code class="break-all">/md?sections=3&features=paragraph,code,table&seed=42</code>
                        </div>
                    </div>

                    <div>
                        <span class="terminal-label mb-2 block">Long technical doc</span>
                        <div class="code-block">
                            <code class="break-all">/md?sections=10&title=Technical+Documentation&features=all</code>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Rate Limiting</h3>
                <div class="bg-surface-container-lowest border-t-2 border-secondary p-4 flex items-center gap-3">
                    <span class="w-2 h-2 rounded-full bg-secondary animate-beacon-pulse"></span>
                    <p class="text-on-surface-variant text-sm">120 requests per minute</p>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Try It Now</h3>
                <a href="/md?sections=5&seed=1" target="_blank"
                   class="liquid-chrome p-3 font-headline font-bold text-on-primary-container uppercase tracking-widest text-xs inline-flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">bolt</span>
                    Generate Markdown
                </a>
            </section>
        </div>
    </div>
</x-layout>
