<x-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">JSON Placeholder API</h1>
            <p class="text-gray-600 dark:text-gray-400">Fake REST API for prototyping</p>
        </div>

        <div class="bg-primary-50 dark:bg-primary-900/20 border border-primary-200 dark:border-primary-800 rounded-xl p-6 mb-8">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                <x-heroicon-o-bolt class="w-5 h-5" />
                Try it live
            </h2>
            <div
                class="space-y-4"
                x-data="{
                    endpoint: 'users',
                    count: 3,
                    page: 1,
                    seed: 42,
                    useSeed: true,
                    loading: false,
                    error: '',
                    output: '',
                    async run() {
                        this.loading = true;
                        this.error = '';
                        this.output = '';
                        try {
                            const params = new URLSearchParams({ count: String(this.count), page: String(this.page) });
                            if (this.useSeed) params.set('seed', String(this.seed));
                            const res = await fetch(`/json/${this.endpoint}?` + params.toString());
                            if (!res.ok) throw new Error('HTTP ' + res.status);
                            const data = await res.json();
                            this.output = JSON.stringify(data, null, 2);
                        } catch (e) {
                            this.error = e.message || 'Request failed';
                        } finally {
                            this.loading = false;
                        }
                    }
                }"
                x-init="run()"
            >
                <div class="flex flex-wrap gap-3 items-end">
                    <label class="flex flex-col gap-1 text-sm">
                        <span class="text-gray-600 dark:text-gray-400">Resource</span>
                        <select x-model="endpoint" class="rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white px-3 py-2 text-sm min-w-[10rem]">
                            <option value="users">users</option>
                            <option value="posts">posts</option>
                            <option value="comments">comments</option>
                            <option value="todos">todos</option>
                        </select>
                    </label>
                    <label class="flex flex-col gap-1 text-sm">
                        <span class="text-gray-600 dark:text-gray-400">count</span>
                        <input type="number" min="1" max="100" x-model.number="count" class="w-24 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white px-3 py-2 text-sm" />
                    </label>
                    <label class="flex flex-col gap-1 text-sm">
                        <span class="text-gray-600 dark:text-gray-400">page</span>
                        <input type="number" min="1" x-model.number="page" class="w-24 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white px-3 py-2 text-sm" />
                    </label>
                    <label class="flex items-center gap-2 text-sm pt-6">
                        <input type="checkbox" x-model="useSeed" class="rounded border-gray-300 dark:border-gray-600" />
                        <span class="text-gray-700 dark:text-gray-300">Use seed</span>
                    </label>
                    <label class="flex flex-col gap-1 text-sm" x-show="useSeed" x-cloak>
                        <span class="text-gray-600 dark:text-gray-400">seed</span>
                        <input type="number" x-model.number="seed" class="w-28 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white px-3 py-2 text-sm" />
                    </label>
                    <button
                        type="button"
                        @click="run()"
                        :disabled="loading"
                        class="inline-flex items-center px-4 py-2 rounded-lg bg-primary-600 hover:bg-primary-700 disabled:opacity-50 text-white text-sm font-medium transition-colors"
                    >
                        <span x-show="!loading">Fetch</span>
                        <span x-show="loading" x-cloak>Loading…</span>
                    </button>
                </div>
                <p x-show="error" class="text-sm text-red-600 dark:text-red-400" x-text="error"></p>
                <div class="bg-gray-900 rounded-lg p-4 overflow-x-auto min-h-[12rem]">
                    <pre class="text-green-400 text-xs sm:text-sm font-mono whitespace-pre-wrap" x-text="output || (loading ? '…' : '')"></pre>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-8">
            <div class="space-y-10">
                <section>
                    <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white flex items-center">
                        <x-heroicon-o-command-line class="w-6 h-6 mr-2 text-gray-900 dark:text-white" />
                        Parameters
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">These query parameters apply to every JSON placeholder endpoint.</p>
                    <div class="space-y-2">
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">count</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Number of items to return (1–100, default: 10)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">seed</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Optional. When set, output is deterministic and responses may be cached for one hour.</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">page</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Pagination offset for <code class="text-gray-900 dark:text-white">id</code> values (default: 1)</span>
                        </div>
                    </div>
                </section>

                <section>
                    <h3 class="text-lg font-semibold mb-3 text-gray-900 dark:text-white">Users</h3>
                    <div class="bg-gray-900 p-4 rounded-lg mb-4">
                        <code class="text-green-400 text-sm break-all font-mono">GET {{ url('/json/users') }}</code>
                    </div>
                    <div class="bg-gray-900 p-4 rounded-lg overflow-x-auto">
                        <pre class="text-green-400 text-xs font-mono"><code>{
  "status": "success",
  "count": 1,
  "data": [
    {
      "id": 1,
      "name": "Leanne Graham",
      "username": "Bret",
      "email": "Sincere@april.biz",
      "phone": "1-770-736-8031",
      "website": "hildegard.org",
      "company": { "name": "...", "catchPhrase": "..." },
      "address": {
        "street": "...",
        "suite": "...",
        "city": "...",
        "zipcode": "...",
        "geo": { "lat": 0.0, "lng": 0.0 }
      }
    }
  ],
  "meta": { "page": 1, "seed": 42, "timestamp": "2025-03-20T12:00:00+00:00" }
}</code></pre>
                    </div>
                </section>

                <section>
                    <h3 class="text-lg font-semibold mb-3 text-gray-900 dark:text-white">Posts</h3>
                    <div class="bg-gray-900 p-4 rounded-lg mb-4">
                        <code class="text-green-400 text-sm break-all font-mono">GET {{ url('/json/posts') }}</code>
                    </div>
                    <div class="bg-gray-900 p-4 rounded-lg overflow-x-auto">
                        <pre class="text-green-400 text-xs font-mono"><code>{
  "status": "success",
  "count": 1,
  "data": [
    {
      "id": 1,
      "userId": 3,
      "title": "Ea voluptatem vero qui et.",
      "body": "Paragraph one...\n\nParagraph two..."
    }
  ],
  "meta": { "page": 1, "seed": null, "timestamp": "..." }
}</code></pre>
                    </div>
                </section>

                <section>
                    <h3 class="text-lg font-semibold mb-3 text-gray-900 dark:text-white">Comments</h3>
                    <div class="bg-gray-900 p-4 rounded-lg mb-4">
                        <code class="text-green-400 text-sm break-all font-mono">GET {{ url('/json/comments') }}</code>
                    </div>
                    <div class="bg-gray-900 p-4 rounded-lg overflow-x-auto">
                        <pre class="text-green-400 text-xs font-mono"><code>{
  "status": "success",
  "count": 1,
  "data": [
    {
      "id": 1,
      "postId": 12,
      "name": "Id quia corrupti et.",
      "email": "user@example.test",
      "body": "..."
    }
  ],
  "meta": { "page": 1, "seed": null, "timestamp": "..." }
}</code></pre>
                    </div>
                </section>

                <section>
                    <h3 class="text-lg font-semibold mb-3 text-gray-900 dark:text-white">Todos</h3>
                    <div class="bg-gray-900 p-4 rounded-lg mb-4">
                        <code class="text-green-400 text-sm break-all font-mono">GET {{ url('/json/todos') }}</code>
                    </div>
                    <div class="bg-gray-900 p-4 rounded-lg overflow-x-auto">
                        <pre class="text-green-400 text-xs font-mono"><code>{
  "status": "success",
  "count": 1,
  "data": [
    {
      "id": 1,
      "userId": 7,
      "title": "Aut qui rerum quia.",
      "completed": false
    }
  ],
  "meta": { "page": 1, "seed": null, "timestamp": "..." }
}</code></pre>
                    </div>
                </section>

                <section>
                    <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Open in browser</h3>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('json.placeholder.users', ['count' => 5, 'seed' => 1]) }}" target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors shadow-lg">
                            <x-heroicon-o-bolt class="w-5 h-5 mr-2" />
                            Users
                        </a>
                        <a href="{{ route('json.placeholder.posts', ['count' => 3, 'seed' => 1]) }}" target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center px-6 py-3 bg-gray-900 dark:bg-gray-700 hover:bg-gray-800 dark:hover:bg-gray-600 text-white font-medium rounded-lg transition-colors">
                            <x-heroicon-o-bolt class="w-5 h-5 mr-2" />
                            Posts
                        </a>
                        <a href="{{ route('json.placeholder.comments', ['count' => 3, 'seed' => 1]) }}" target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center px-6 py-3 bg-gray-900 dark:bg-gray-700 hover:bg-gray-800 dark:hover:bg-gray-600 text-white font-medium rounded-lg transition-colors">
                            <x-heroicon-o-bolt class="w-5 h-5 mr-2" />
                            Comments
                        </a>
                        <a href="{{ route('json.placeholder.todos', ['count' => 5, 'seed' => 1]) }}" target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center px-6 py-3 bg-gray-900 dark:bg-gray-700 hover:bg-gray-800 dark:hover:bg-gray-600 text-white font-medium rounded-lg transition-colors">
                            <x-heroicon-o-bolt class="w-5 h-5 mr-2" />
                            Todos
                        </a>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-layout>
