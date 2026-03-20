<x-layout>
    <section class="mb-16">
        <span class="text-tertiary font-headline font-bold text-xs tracking-[0.3em] uppercase mb-4 block">Document System</span>
        <h1 class="text-5xl md:text-7xl font-headline font-extrabold tracking-tighter text-on-surface leading-none mb-6">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-tertiary">PDF</span> Generator
        </h1>
        <p class="text-on-surface-variant text-sm max-w-2xl">Generate dummy PDF documents filled with lorem ipsum text. Perfect for testing uploads, previews, and document workflows.</p>
    </section>

    <div class="space-y-12">
        <section>
            <h3 class="section-title mb-8 flex items-center gap-3">
                <span class="material-symbols-outlined text-base">terminal</span>
                Endpoint
            </h3>
            <div class="code-block">
                <code class="break-all">GET /pdf?pages=5&title=My+Document</code>
            </div>
            <p class="text-on-surface-variant text-sm mt-4">Returns a PDF document with auto-generated headings and paragraphs of lorem ipsum on each page.</p>
        </section>

        <section>
            <h3 class="section-title mb-8">Parameters</h3>
            <div class="space-y-px">
                <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                    <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">pages</span>
                    <span class="text-outline text-xs">Number of pages (1–50, default: 3)</span>
                </div>
                <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                    <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">title</span>
                    <span class="text-outline text-xs">Document title (default: "Sample Document")</span>
                </div>
                <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                    <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">size</span>
                    <span class="text-outline text-xs">Page size: a4, letter, legal (default: a4)</span>
                </div>
                <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                    <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">orientation</span>
                    <span class="text-outline text-xs">portrait or landscape (default: portrait)</span>
                </div>
                <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                    <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">callback_url</span>
                    <span class="text-outline text-xs">Optional: we return 202 and POST the download URL here when ready (async)</span>
                </div>
                <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                    <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">job_id</span>
                    <span class="text-outline text-xs">Optional: echoed back in the callback payload</span>
                </div>
            </div>
        </section>

        <section>
            <h3 class="section-title mb-8">Example Usage</h3>
            <div class="space-y-8">
                <div>
                    <span class="terminal-label mb-2 block">Default 3-page A4 document</span>
                    <div class="code-block mb-4">
                        <code class="break-all">/pdf</code>
                    </div>
                    <a href="/pdf" target="_blank" class="bg-surface-container-low p-6 flex items-center gap-4 hover:bg-surface-container-lowest transition-colors group">
                        <div class="text-secondary">
                            <span class="material-symbols-outlined text-3xl">picture_as_pdf</span>
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-on-surface group-hover:text-primary transition-colors">Sample Document.pdf</span>
                            <span class="meta-label">3 pages &middot; A4 &middot; Portrait</span>
                        </div>
                    </a>
                </div>

                <div>
                    <span class="terminal-label mb-2 block">10-page project report</span>
                    <div class="code-block mb-4">
                        <code class="break-all">/pdf?pages=10&title=Project+Report</code>
                    </div>
                    <a href="/pdf?pages=10&title=Project+Report" target="_blank" class="bg-surface-container-low p-6 flex items-center gap-4 hover:bg-surface-container-lowest transition-colors group">
                        <div class="text-secondary">
                            <span class="material-symbols-outlined text-3xl">picture_as_pdf</span>
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-on-surface group-hover:text-primary transition-colors">Project Report.pdf</span>
                            <span class="meta-label">10 pages &middot; A4 &middot; Portrait</span>
                        </div>
                    </a>
                </div>

                <div>
                    <span class="terminal-label mb-2 block">Landscape letter-size</span>
                    <div class="code-block mb-4">
                        <code class="break-all">/pdf?pages=2&size=letter&orientation=landscape</code>
                    </div>
                    <a href="/pdf?pages=2&size=letter&orientation=landscape" target="_blank" class="bg-surface-container-low p-6 flex items-center gap-4 hover:bg-surface-container-lowest transition-colors group">
                        <div class="text-secondary">
                            <span class="material-symbols-outlined text-3xl">picture_as_pdf</span>
                        </div>
                        <div>
                            <span class="block text-sm font-bold text-on-surface group-hover:text-primary transition-colors">Sample Document.pdf</span>
                            <span class="meta-label">2 pages &middot; Letter &middot; Landscape</span>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <section>
            <h3 class="section-title mb-8">Rate Limiting</h3>
            <div class="bg-surface-container-low p-6 flex items-start gap-3">
                <span class="material-symbols-outlined text-secondary text-lg mt-0.5">speed</span>
                <p class="text-on-surface-variant text-sm"><span class="text-secondary font-bold">30 requests per minute</span></p>
            </div>
        </section>

        <section>
            <h3 class="section-title mb-8">Try It Now</h3>
            <a href="/pdf?pages=5&title=Hello+World" target="_blank"
               class="liquid-chrome p-3 font-headline font-bold text-on-primary-container uppercase tracking-widest text-xs inline-flex items-center gap-2">
                <span class="material-symbols-outlined text-base">bolt</span>
                Generate PDF
            </a>
        </section>
    </div>
</x-layout>
