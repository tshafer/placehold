<x-layout>
    <div class="mb-16">
        <span class="text-tertiary font-headline font-bold text-xs tracking-[0.3em] uppercase mb-4 block">API Documentation</span>
        <h1 class="text-5xl md:text-7xl font-headline font-extrabold tracking-tighter text-on-surface leading-none">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-tertiary">Weather</span> API
        </h1>
        <p class="text-on-surface-variant text-sm mt-4">Get accurate weather data for any location</p>
    </div>

    <div class="bg-surface-container-low p-6 lg:p-8">
        <div class="space-y-10">
            <section>
                <h3 class="section-title mb-8 flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary">cloud</span>
                    Basic Usage
                </h3>
                <div class="code-block">
                    <code class="break-all">GET {{ route('weather', ['city' => 'London', 'country' => 'GB']) }}</code>
                </div>
                <p class="text-on-surface-variant text-sm mt-3">Returns weather data for London, UK.</p>
            </section>

            <section>
                <h3 class="section-title mb-8">Query Parameters</h3>
                <div class="space-y-1">
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">city</span>
                        <span class="text-outline text-xs">Name of the city (required)</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">country</span>
                        <span class="text-outline text-xs">Two-letter country code (required)</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">units</span>
                        <span class="text-outline text-xs">Units (metric, imperial, standard) (optional)</span>
                    </div>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Example Usage</h3>
                <div class="code-block mb-4">
                    <code class="break-all">GET {{ route('weather', ['city' => 'London', 'country' => 'GB', 'units' => 'metric', 'forecast_days' => 3]) }}</code>
                </div>
                <p class="text-on-surface-variant text-sm">Returns weather data for London, UK, in metric units with 3-day forecast.</p>
            </section>

            <section>
                <h3 class="section-title mb-8">Rate Limiting</h3>
                <div class="bg-surface-container-lowest p-4 border-l-2 border-tertiary">
                    <p class="text-on-surface-variant text-sm">To ensure fair usage:</p>
                    <ul class="list-disc list-inside mt-3 space-y-2 text-on-surface-variant text-sm ml-4">
                        <li><span class="font-bold text-on-surface">60 requests</span> per minute</li>
                        <li><span class="font-bold text-on-surface">1000 requests</span> per day</li>
                    </ul>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Try It Now</h3>
                <a href="{{ route('weather', ['city' => 'London', 'country' => 'GB']) }}" target="_blank"
                   class="liquid-chrome p-3 font-headline font-bold text-on-primary-container uppercase tracking-widest text-xs inline-flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">bolt</span>
                    Get Weather Data
                </a>
            </section>
        </div>
    </div>
</x-layout>
