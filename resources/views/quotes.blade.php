<x-layout>
    <div class="mb-16">
        <span class="text-tertiary font-headline font-bold text-xs tracking-[0.3em] uppercase mb-4 block">API Documentation</span>
        <h1 class="text-5xl md:text-7xl font-headline font-extrabold tracking-tighter text-on-surface leading-none">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-tertiary">Random</span> Quotes
        </h1>
        <p class="text-on-surface-variant text-sm mt-4">Get inspiring quotes with our free API</p>
    </div>

    <div class="bg-surface-container-low p-6 lg:p-8">
        <div class="space-y-10">
            <section>
                <h3 class="section-title mb-8 flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary">terminal</span>
                    Basic Usage
                </h3>
                <div class="code-block">
                    <code class="break-all">GET {{ route('quote') }}</code>
                </div>
                <p class="text-on-surface-variant text-sm mt-3">Returns a random quote from the Quotable API.</p>
            </section>

            <section>
                <h3 class="section-title mb-8">Response Format</h3>
                <div class="code-block overflow-x-auto">
                    <pre><code>{
  "status": "success",
  "data": [
    {
      "_id": "IARxwjpiXK",
      "content": "I had three chairs in my house; one for solitude, two for friendship, three for society.",
      "author": "Henry David Thoreau",
      "tags": ["Friendship"],
      "authorSlug": "henry-david-thoreau",
      "length": 88,
      "dateAdded": "2019-08-08",
      "dateModified": "2023-04-14"
    }
  ],
  "timestamp": "YYYY-MM-DD HH:MM:SS"
}</code></pre>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Rate Limiting</h3>
                <div class="bg-surface-container-lowest p-4 border-l-2 border-tertiary">
                    <p class="text-on-surface-variant text-sm">To ensure fair usage, this API is rate-limited:</p>
                    <ul class="list-disc list-inside mt-3 space-y-2 text-on-surface-variant text-sm ml-4">
                        <li><span class="font-bold text-on-surface">5 requests</span> per second</li>
                        <li><span class="font-bold text-on-surface">3600 requests</span> per hour</li>
                    </ul>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Error Handling</h3>
                <p class="text-on-surface-variant text-sm mb-4">In case of an error, the API returns a JSON response with an error message:</p>
                <div class="code-block overflow-x-auto">
                    <pre><code>{
  "status": "error",
  "message": "An error occurred while fetching the quote"
}</code></pre>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Try It Now</h3>
                <a href="{{ route('quote') }}" target="_blank"
                   class="liquid-chrome p-3 font-headline font-bold text-on-primary-container uppercase tracking-widest text-xs inline-flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">bolt</span>
                    Test the API
                </a>
            </section>
        </div>
    </div>
</x-layout>
