<x-layout>
    <div class="mb-16">
        <span class="text-tertiary font-headline font-bold text-xs tracking-[0.3em] uppercase mb-4 block">API Documentation</span>
        <h1 class="text-5xl md:text-7xl font-headline font-extrabold tracking-tighter text-on-surface leading-none">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-tertiary">Recipe</span> API
        </h1>
        <p class="text-on-surface-variant text-sm mt-4">Discover delicious recipes from around the world</p>
    </div>

    <div class="bg-surface-container-low p-6 lg:p-8">
        <div class="space-y-10">
            <section>
                <h3 class="section-title mb-8 flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary">menu_book</span>
                    Basic Usage
                </h3>
                <div class="code-block">
                    <code class="break-all">GET {{ route('recipe') }}</code>
                </div>
                <p class="text-on-surface-variant text-sm mt-3">Returns random recipes from our database.</p>
            </section>

            <section>
                <h3 class="section-title mb-8">Query Parameters</h3>
                <div class="space-y-1">
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">query</span>
                        <span class="text-outline text-xs">Search query for recipes (optional)</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">category</span>
                        <span class="text-outline text-xs">Recipe category (optional)</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">number</span>
                        <span class="text-outline text-xs">Number of recipes (1-25, default: 10) (optional)</span>
                    </div>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Example Usage</h3>
                <div class="code-block mb-4">
                    <code class="break-all">GET {{ route('recipe', ['number' => 5, 'category' => 'Dessert']) }}</code>
                </div>
                <p class="text-on-surface-variant text-sm">Returns 5 random dessert recipes.</p>
            </section>

            <section>
                <h3 class="section-title mb-8">Rate Limiting</h3>
                <div class="bg-surface-container-lowest p-4 border-l-2 border-tertiary">
                    <p class="text-on-surface-variant text-sm">60 requests per minute, 1000 requests per day</p>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Try It Now</h3>
                <a href="{{ route('recipe') }}" target="_blank"
                   class="liquid-chrome p-3 font-headline font-bold text-on-primary-container uppercase tracking-widest text-xs inline-flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">bolt</span>
                    Get Random Recipes
                </a>
            </section>
        </div>
    </div>
</x-layout>
