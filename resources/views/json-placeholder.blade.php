<x-layout>
    <div class="mb-16">
        <span class="text-tertiary font-headline font-bold text-xs tracking-[0.3em] uppercase mb-4 block">API Documentation</span>
        <h1 class="text-5xl md:text-7xl font-headline font-extrabold tracking-tighter text-on-surface leading-none">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-tertiary">JSON</span> Placeholder
        </h1>
        <p class="text-on-surface-variant text-sm mt-4">Fake REST API for prototyping</p>
    </div>

    {{-- Live playground --}}
    <div class="bg-surface-container-low p-6 lg:p-8 mb-10">
        <h2 class="section-title mb-8 flex items-center gap-3">
            <span class="material-symbols-outlined text-primary">bolt</span>
            Try It Live
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
                <label class="flex flex-col gap-1 text-xs">
                    <span class="terminal-label">Resource</span>
                    <select x-model="endpoint" class="bg-surface-container-lowest border border-outline-variant/40 text-on-surface px-3 py-2 text-sm font-mono min-w-[10rem] focus:border-primary focus:outline-none">
                        <option value="users">users</option>
                        <option value="posts">posts</option>
                        <option value="comments">comments</option>
                        <option value="todos">todos</option>
                    </select>
                </label>
                <label class="flex flex-col gap-1 text-xs">
                    <span class="terminal-label">Count</span>
                    <input type="number" min="1" max="100" x-model.number="count" class="w-24 bg-surface-container-lowest border border-outline-variant/40 text-on-surface px-3 py-2 text-sm font-mono focus:border-primary focus:outline-none" />
                </label>
                <label class="flex flex-col gap-1 text-xs">
                    <span class="terminal-label">Page</span>
                    <input type="number" min="1" x-model.number="page" class="w-24 bg-surface-container-lowest border border-outline-variant/40 text-on-surface px-3 py-2 text-sm font-mono focus:border-primary focus:outline-none" />
                </label>
                <label class="flex items-center gap-2 text-xs pt-6">
                    <input type="checkbox" x-model="useSeed" class="accent-primary" />
                    <span class="text-outline text-xs uppercase tracking-wider">Use seed</span>
                </label>
                <label class="flex flex-col gap-1 text-xs" x-show="useSeed" x-cloak>
                    <span class="terminal-label">Seed</span>
                    <input type="number" x-model.number="seed" class="w-28 bg-surface-container-lowest border border-outline-variant/40 text-on-surface px-3 py-2 text-sm font-mono focus:border-primary focus:outline-none" />
                </label>
                <button
                    type="button"
                    @click="run()"
                    :disabled="loading"
                    class="liquid-chrome p-3 font-headline font-bold text-on-primary-container uppercase tracking-widest text-xs disabled:opacity-50"
                >
                    <span x-show="!loading">Fetch</span>
                    <span x-show="loading" x-cloak>Loading…</span>
                </button>
            </div>
            <p x-show="error" class="text-sm text-error" x-text="error"></p>
            <div class="code-block overflow-x-auto min-h-[12rem]">
                <pre class="whitespace-pre-wrap" x-text="output || (loading ? '…' : '')"></pre>
            </div>
        </div>
    </div>

    {{-- Documentation --}}
    <div class="bg-surface-container-low p-6 lg:p-8">
        <div class="space-y-10">
            <section>
                <h2 class="section-title mb-8 flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary">terminal</span>
                    Parameters
                </h2>
                <p class="text-on-surface-variant text-sm mb-4">These query parameters apply to every JSON placeholder endpoint.</p>
                <div class="space-y-1">
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">count</span>
                        <span class="text-outline text-xs">Number of items to return (1–100, default: 10)</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">seed</span>
                        <span class="text-outline text-xs">Optional. When set, output is deterministic and responses may be cached for one hour.</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">page</span>
                        <span class="text-outline text-xs">Pagination offset for <code class="text-on-surface font-mono">id</code> values (default: 1)</span>
                    </div>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Users</h3>
                <div class="code-block mb-4">
                    <code class="break-all">GET {{ url('/json/users') }}</code>
                </div>
                <div class="code-block overflow-x-auto">
                    <pre><code>{
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
                <h3 class="section-title mb-8">Posts</h3>
                <div class="code-block mb-4">
                    <code class="break-all">GET {{ url('/json/posts') }}</code>
                </div>
                <div class="code-block overflow-x-auto">
                    <pre><code>{
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
                <h3 class="section-title mb-8">Comments</h3>
                <div class="code-block mb-4">
                    <code class="break-all">GET {{ url('/json/comments') }}</code>
                </div>
                <div class="code-block overflow-x-auto">
                    <pre><code>{
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
                <h3 class="section-title mb-8">Todos</h3>
                <div class="code-block mb-4">
                    <code class="break-all">GET {{ url('/json/todos') }}</code>
                </div>
                <div class="code-block overflow-x-auto">
                    <pre><code>{
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
                <h3 class="section-title mb-8">Open in Browser</h3>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('json.placeholder.users', ['count' => 5, 'seed' => 1]) }}" target="_blank" rel="noopener noreferrer"
                       class="liquid-chrome p-3 font-headline font-bold text-on-primary-container uppercase tracking-widest text-xs inline-flex items-center gap-2">
                        <span class="material-symbols-outlined text-base">bolt</span>
                        Users
                    </a>
                    <a href="{{ route('json.placeholder.posts', ['count' => 3, 'seed' => 1]) }}" target="_blank" rel="noopener noreferrer"
                       class="text-outline border border-outline-variant/40 hover:text-primary hover:border-primary/40 px-4 py-2 font-headline font-bold text-xs uppercase tracking-widest transition-all inline-flex items-center gap-2">
                        <span class="material-symbols-outlined text-base">bolt</span>
                        Posts
                    </a>
                    <a href="{{ route('json.placeholder.comments', ['count' => 3, 'seed' => 1]) }}" target="_blank" rel="noopener noreferrer"
                       class="text-outline border border-outline-variant/40 hover:text-primary hover:border-primary/40 px-4 py-2 font-headline font-bold text-xs uppercase tracking-widest transition-all inline-flex items-center gap-2">
                        <span class="material-symbols-outlined text-base">bolt</span>
                        Comments
                    </a>
                    <a href="{{ route('json.placeholder.todos', ['count' => 5, 'seed' => 1]) }}" target="_blank" rel="noopener noreferrer"
                       class="text-outline border border-outline-variant/40 hover:text-primary hover:border-primary/40 px-4 py-2 font-headline font-bold text-xs uppercase tracking-widest transition-all inline-flex items-center gap-2">
                        <span class="material-symbols-outlined text-base">bolt</span>
                        Todos
                    </a>
                </div>
            </section>
        </div>
    </div>
</x-layout>
