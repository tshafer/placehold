<x-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">Usage Dashboard</h1>
            <p class="text-gray-600 dark:text-gray-400">Live API usage statistics across all endpoints</p>
        </div>

        <div x-data="statsBoard()" x-init="fetchStats()">
            <!-- Global summary -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Requests Today</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white" x-text="today.toLocaleString()">0</p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Active Endpoints</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white" x-text="endpoints.length">0</p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Last Updated</p>
                    <p class="text-lg font-semibold text-gray-900 dark:text-white" x-text="updatedAt">—</p>
                </div>
            </div>

            <!-- 7-day chart -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 mb-8">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Last 7 Days</h2>
                <div class="flex items-end gap-2 h-40">
                    <template x-for="(day, i) in daily" :key="i">
                        <div class="flex-1 flex flex-col items-center gap-1">
                            <span class="text-xs font-medium text-gray-600 dark:text-gray-400" x-text="day.count.toLocaleString()"></span>
                            <div class="w-full bg-primary-500 rounded-t-md transition-all duration-500"
                                 :style="'height:' + (maxDaily > 0 ? Math.max(day.count / maxDaily * 120, 4) : 4) + 'px'"></div>
                            <span class="text-xs text-gray-500 dark:text-gray-400" x-text="day.date.slice(5)"></span>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Per-endpoint table -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Endpoints</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700">
                                <th class="px-6 py-3 font-medium">Endpoint</th>
                                <th class="px-6 py-3 font-medium text-right">Today</th>
                                <th class="px-6 py-3 font-medium text-right">All Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(ep, i) in endpoints" :key="i">
                                <tr class="border-b border-gray-100 dark:border-gray-700/50 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                    <td class="px-6 py-3 font-mono text-gray-900 dark:text-white" x-text="ep.endpoint"></td>
                                    <td class="px-6 py-3 text-right text-gray-600 dark:text-gray-400" x-text="ep.today.toLocaleString()"></td>
                                    <td class="px-6 py-3 text-right font-medium text-gray-900 dark:text-white" x-text="ep.total.toLocaleString()"></td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
                <div x-show="endpoints.length === 0" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                    No API calls recorded yet. Start using the API to see stats here.
                </div>
            </div>

            <!-- Auto-refresh note -->
            <p class="text-center text-sm text-gray-400 dark:text-gray-500 mt-6">Auto-refreshes every 30 seconds</p>
        </div>
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
