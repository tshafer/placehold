<x-layout>
    <div class="mb-16">
        <span class="text-tertiary font-headline font-bold text-xs tracking-[0.3em] uppercase mb-4 block">Data Generation</span>
        <h1 class="text-5xl md:text-7xl font-headline font-extrabold tracking-tighter text-on-surface leading-none mb-4">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-tertiary">CSV</span> Generator
        </h1>
        <p class="text-on-surface-variant text-sm max-w-2xl">Generate fake tabular data with realistic names, emails, addresses, and more. Download as CSV or get JSON.</p>
    </div>

    <div class="bg-surface-container-low p-6 lg:p-8">
        <div class="space-y-10">
            <section>
                <h3 class="section-title mb-8 flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">terminal</span>
                    Endpoint
                </h3>
                <div class="code-block">
                    <code class="break-all">GET /csv?rows=50&preset=users</code>
                </div>
                <p class="text-on-surface-variant text-sm mt-4">Returns CSV (or JSON) with the requested number of rows. Use a preset for common schemas or specify custom columns.</p>
            </section>

            <section>
                <h3 class="section-title mb-8">Parameters</h3>
                <div class="space-y-1">
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">rows</span>
                        <span class="text-outline text-xs">Number of rows (1–1000, default: 25)</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">preset</span>
                        <span class="text-outline text-xs">Data preset: users, products, orders, employees, contacts</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">columns</span>
                        <span class="text-outline text-xs">Comma-separated column names (used when no preset is set)</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">format</span>
                        <span class="text-outline text-xs">csv or json (default: csv)</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">delimiter</span>
                        <span class="text-outline text-xs">Comma (default) or "tab" for TSV</span>
                    </div>
                    <div class="flex gap-4 px-4 py-2 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-colors">
                        <span class="font-mono text-xs font-bold text-primary w-24 shrink-0">seed</span>
                        <span class="text-outline text-xs">Integer seed for deterministic output</span>
                    </div>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Presets</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                    @foreach([
                        'users' => 'name, email, phone, city, country',
                        'products' => 'product_name, price, category, sku, stock',
                        'orders' => 'order_id, customer, email, total, date, status',
                        'employees' => 'name, email, department, job_title, salary, hire_date',
                        'contacts' => 'first_name, last_name, email, phone, company, address',
                    ] as $preset => $cols)
                        <div class="bg-surface-container-lowest/50 p-4">
                            <span class="font-mono text-xs font-bold text-primary">{{ $preset }}</span>
                            <span class="block text-outline text-xs mt-1">{{ $cols }}</span>
                        </div>
                    @endforeach
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Example Usage</h3>
                <div class="space-y-8">
                    <div>
                        <span class="terminal-label mb-2 block">5 users as CSV</span>
                        <div class="code-block mb-4">
                            <code class="break-all">/csv?preset=users&rows=5&seed=42</code>
                        </div>
                        <div class="bg-surface-container-lowest overflow-x-auto">
                            <table class="text-xs font-mono w-full">
                                <thead><tr class="border-b border-outline-variant/20 text-left text-outline">
                                    <th class="px-3 py-2">name</th><th class="px-3 py-2">email</th><th class="px-3 py-2">phone</th><th class="px-3 py-2">city</th><th class="px-3 py-2">country</th>
                                </tr></thead>
                                <tbody class="text-on-surface-variant">
                                    <tr class="border-b border-outline-variant/10"><td class="px-3 py-2">Prof. Kaya Abshire</td><td class="px-3 py-2">kaya@example.net</td><td class="px-3 py-2">(555) 123-4567</td><td class="px-3 py-2">New York</td><td class="px-3 py-2">USA</td></tr>
                                    <tr class="border-b border-outline-variant/10"><td class="px-3 py-2">Maria Chen</td><td class="px-3 py-2">maria.chen@example.com</td><td class="px-3 py-2">(555) 987-6543</td><td class="px-3 py-2">London</td><td class="px-3 py-2">UK</td></tr>
                                    <tr><td class="px-3 py-2 text-outline">…</td><td class="px-3 py-2 text-outline">…</td><td class="px-3 py-2 text-outline">…</td><td class="px-3 py-2 text-outline">…</td><td class="px-3 py-2 text-outline">…</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div>
                        <span class="terminal-label mb-2 block">Products as JSON</span>
                        <div class="code-block mb-4">
                            <code class="break-all">/csv?preset=products&format=json&rows=3</code>
                        </div>
                        <div class="code-block">
<pre class="overflow-x-auto">{
  "status": "success",
  "columns": ["product_name", "price", "category", "sku", "stock"],
  "count": 3,
  "data": [
    {"product_name": "wireless headphones", "price": "49.99", ...},
    ...
  ]
}</pre>
                        </div>
                    </div>

                    <div>
                        <span class="terminal-label mb-2 block">Custom columns</span>
                        <div class="code-block">
                            <code class="break-all">/csv?columns=first_name,last_name,email,company,city&rows=100</code>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <h3 class="section-title mb-8">Available Columns</h3>
                <div class="flex flex-wrap gap-2 text-xs font-mono">
                    @foreach(['name','first_name','last_name','email','phone','address','city','state','country','zipcode','company','job_title','department','salary','date','datetime','url','ip','uuid','username','age','gender','product_name','price','category','sku','stock','order_id','customer','total','status','description','color'] as $col)
                        <span class="bg-surface-container-lowest text-tertiary px-2 py-1">{{ $col }}</span>
                    @endforeach
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
                <a href="/csv?preset=users&rows=25&seed=1" target="_blank"
                   class="liquid-chrome p-3 font-headline font-bold text-on-primary-container uppercase tracking-widest text-xs inline-flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">bolt</span>
                    Download Sample CSV
                </a>
            </section>
        </div>
    </div>
</x-layout>
