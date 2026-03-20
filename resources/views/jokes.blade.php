<x-layout>
    <div class="mb-16">
        <span class="text-tertiary font-headline font-bold text-xs tracking-[0.3em] uppercase mb-4 block">API Documentation</span>
        <h1 class="text-5xl md:text-7xl font-headline font-extrabold tracking-tighter text-on-surface leading-none">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-tertiary">Random</span> Jokes
        </h1>
        <p class="text-on-surface-variant text-sm mt-4">Lighten up your day with random jokes</p>
    </div>

    @php
        $jokeCount = \App\Models\Joke::count();
    @endphp

    @if($jokeCount > 0)
    <div class="bg-surface-container-low p-6 lg:p-8 mb-10 flex items-center gap-4">
        <span class="material-symbols-outlined text-4xl text-tertiary">lightbulb</span>
        <div>
            <div class="text-3xl font-headline font-extrabold text-on-surface">{{ number_format($jokeCount) }}</div>
            <div class="text-outline text-xs uppercase tracking-widest">Jokes in our database</div>
        </div>
    </div>
    @endif

    <div class="bg-surface-container-low p-6 lg:p-8">
        <div class="space-y-10">
            <section>
                <h3 class="section-title mb-8 flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary">terminal</span>
                    Basic Usage
                </h3>
                <div class="code-block">
                    <code class="break-all">GET {{ route('joke') }}</code>
                </div>
                <p class="text-on-surface-variant text-sm mt-3">Returns a random joke from our database.</p>
            </section>

            <section>
                <h3 class="section-title mb-8">Response Format</h3>
                <div class="code-block overflow-x-auto">
                    <pre><code>{
  "body": "Why did the scarecrow win an award?",
  "title": "Scarecrow Award",
  "category": "general",
  "rating": "PG"
}</code></pre>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Random Joke Example</h3>
                @php
                try {
                    $jokeService = app(\App\Services\JokeService::class);
                    $randomJoke = $jokeService->getRandomJoke();
                } catch (\Exception $e) {
                    $randomJoke = null;
                }
                @endphp
                @if($randomJoke)
                <div class="code-block overflow-x-auto">
                    <pre>@json($randomJoke, JSON_PRETTY_PRINT)</pre>
                </div>
                @else
                <div class="code-block">
                    <p>Run the jokes seeder to see an example!</p>
                </div>
                @endif
            </section>

            <section>
                <h3 class="section-title mb-8">Rate Limiting</h3>
                <div class="bg-surface-container-lowest p-4 border-l-2 border-tertiary">
                    <p class="text-on-surface-variant text-sm">120 requests per minute</p>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Try It Now</h3>
                <a href="{{ route('joke') }}" target="_blank"
                   class="liquid-chrome p-3 font-headline font-bold text-on-primary-container uppercase tracking-widest text-xs inline-flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">bolt</span>
                    Get a Random Joke
                </a>
            </section>
        </div>
    </div>
</x-layout>
