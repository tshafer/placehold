<x-layout>
    <div x-data="statsBoard()" x-init="fetchStats()">
        <section class="mb-16">
            <span class="text-tertiary font-headline font-bold text-xs tracking-[0.3em] uppercase mb-4 block">Analytics</span>
            <h1 class="text-5xl md:text-7xl font-headline font-extrabold tracking-tighter text-on-surface leading-none mb-4">
                Usage <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-tertiary">Dashboard</span>
            </h1>
            <p class="text-on-surface-variant text-sm max-w-xl">Live API usage statistics across all endpoints</p>
        </section>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-px bg-outline-variant/10 mb-10">
            <div class="bg-surface-container-low p-6 border-l-2 border-primary/30">
                <span class="meta-label">Requests Today</span>
                <p class="text-2xl font-headline font-extrabold text-on-surface mt-2" x-text="today.toLocaleString()">0</p>
            </div>
            <div class="bg-surface-container-low p-6 border-l-2 border-primary/30">
                <span class="meta-label">Active Endpoints</span>
                <p class="text-2xl font-headline font-extrabold text-on-surface mt-2" x-text="endpoints.length">0</p>
            </div>
            <div class="bg-surface-container-low p-6 border-l-2 border-primary/30">
                <span class="meta-label">Last Updated</span>
                <p class="text-lg font-headline font-bold text-on-surface mt-2" x-text="updatedAt">&mdash;</p>
            </div>
        </div>

        <div class="bg-surface-container-low p-6 lg:p-8 mb-10">
            <h2 class="section-title mb-8">Last 7 Days</h2>
            <div class="flex items-end gap-2 h-40">
                <template x-for="(day, i) in daily" :key="i">
                    <div class="flex-1 flex flex-col items-center gap-1">
                        <span class="text-outline text-xs font-mono" x-text="day.count.toLocaleString()"></span>
                        <div class="w-full bg-primary transition-all duration-500"
                             :style="'height:' + (maxDaily > 0 ? Math.max(day.count / maxDaily * 120, 4) : 4) + 'px'"></div>
                        <span class="text-outline text-xs" x-text="day.date.slice(5)"></span>
                    </div>
                </template>
            </div>
        </div>

        <div class="bg-surface-container-low">
            <div class="px-6 lg:px-8 py-4 border-b border-outline-variant/20">
                <h2 class="section-title mb-0">Endpoints</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left border-b border-outline-variant/20">
                            <th class="px-6 lg:px-8 py-3 meta-label">Endpoint</th>
                            <th class="px-6 lg:px-8 py-3 meta-label text-right">Today</th>
                            <th class="px-6 lg:px-8 py-3 meta-label text-right">All Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="(ep, i) in endpoints" :key="i">
                            <tr class="border-b border-outline-variant/10 hover:bg-surface-container-lowest transition-colors">
                                <td class="px-6 lg:px-8 py-3 font-mono text-xs font-bold text-primary" x-text="ep.endpoint"></td>
                                <td class="px-6 lg:px-8 py-3 text-right text-outline text-xs" x-text="ep.today.toLocaleString()"></td>
                                <td class="px-6 lg:px-8 py-3 text-right font-headline font-bold text-on-surface text-xs" x-text="ep.total.toLocaleString()"></td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
            <div x-show="endpoints.length === 0" class="px-6 lg:px-8 py-12 text-center text-outline text-xs">
                No API calls recorded yet. Start using the API to see stats here.
            </div>
        </div>

        <p class="text-center text-outline text-xs mt-8">Auto-refreshes every 30 seconds</p>
    </div>

    <script>
        function statsBoard() {
            return {
                today: 0,
                endpoints: [],
                daily: [],
                maxDaily: 0,
                updatedAt: '—',
                async fetchStats() {
                    try {
                        const res = await fetch('/api-stats');
                        const data = await res.json();
                        this.today = data.today;
                        this.endpoints = data.endpoints;
                        this.daily = data.daily;
                        this.maxDaily = Math.max(...data.daily.map(d => d.count), 1);
                        this.updatedAt = new Date(data.generated_at).toLocaleTimeString();
                    } catch (e) {}
                    setTimeout(() => this.fetchStats(), 30000);
                }
            }
        }
    </script>
</x-layout>
