<x-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">CSV / Data Generator</h1>
            <p class="text-gray-600 dark:text-gray-400">Generate fake tabular data with realistic names, emails, addresses, and more. Download as CSV or get JSON.</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-8">
            <div class="space-y-8">
                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white flex items-center">
                        <x-heroicon-o-command-line class="w-6 h-6 mr-2 text-gray-900 dark:text-white" />
                        Endpoint
                    </h3>
                    <div class="bg-gray-900 p-4 rounded-lg">
                        <code class="text-green-400 text-sm break-all font-mono">GET /csv?rows=50&preset=users</code>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 mt-3">Returns CSV (or JSON) with the requested number of rows. Use a preset for common schemas or specify custom columns.</p>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Parameters</h3>
                    <div class="space-y-2">
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">rows</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Number of rows (1–1000, default: 25)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">preset</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Data preset: users, products, orders, employees, contacts</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">columns</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Comma-separated column names (used when no preset is set)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">format</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">csv or json (default: csv)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">delimiter</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Comma (default) or "tab" for TSV</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-40">seed</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm flex-1">Integer seed for deterministic output</span>
                        </div>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Presets</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                        @foreach([
                            'users' => 'name, email, phone, city, country',
                            'products' => 'product_name, price, category, sku, stock',
                            'orders' => 'order_id, customer, email, total, date, status',
                            'employees' => 'name, email, department, job_title, salary, hire_date',
                            'contacts' => 'first_name, last_name, email, phone, company, address',
                        ] as $preset => $cols)
                            <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-4">
                                <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white">{{ $preset }}</span>
                                <span class="block text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $cols }}</span>
                            </div>
                        @endforeach
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Example Usage</h3>
                    <div class="space-y-6">
                        <div>
                            <p class="text-gray-700 dark:text-gray-300 mb-2 font-medium">5 users as CSV:</p>
                            <div class="bg-gray-900 p-4 rounded-lg mb-3">
                                <code class="text-green-400 text-sm break-all font-mono">/csv?preset=users&rows=5&seed=42</code>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg overflow-x-auto">
                                <table class="text-xs font-mono w-full">
                                    <thead><tr class="border-b border-gray-200 dark:border-gray-700 text-left text-gray-500 dark:text-gray-400">
                                        <th class="px-3 py-2">name</th><th class="px-3 py-2">email</th><th class="px-3 py-2">phone</th><th class="px-3 py-2">city</th><th class="px-3 py-2">country</th>
                                    </tr></thead>
                                    <tbody class="text-gray-700 dark:text-gray-300">
                                        <tr class="border-b border-gray-100 dark:border-gray-800"><td class="px-3 py-2">Prof. Kaya Abshire</td><td class="px-3 py-2">kaya@example.net</td><td class="px-3 py-2">(555) 123-4567</td><td class="px-3 py-2">New York</td><td class="px-3 py-2">USA</td></tr>
                                        <tr class="border-b border-gray-100 dark:border-gray-800"><td class="px-3 py-2">Maria Chen</td><td class="px-3 py-2">maria.chen@example.com</td><td class="px-3 py-2">(555) 987-6543</td><td class="px-3 py-2">London</td><td class="px-3 py-2">UK</td></tr>
                                        <tr><td class="px-3 py-2 text-gray-400">…</td><td class="px-3 py-2 text-gray-400">…</td><td class="px-3 py-2 text-gray-400">…</td><td class="px-3 py-2 text-gray-400">…</td><td class="px-3 py-2 text-gray-400">…</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div>
                            <p class="text-gray-700 dark:text-gray-300 mb-2 font-medium">Products as JSON:</p>
                            <div class="bg-gray-900 p-4 rounded-lg mb-3">
                                <code class="text-green-400 text-sm break-all font-mono">/csv?preset=products&format=json&rows=3</code>
                            </div>
                            <div class="bg-gray-900 p-4 rounded-lg">
<pre class="text-green-400 text-xs font-mono overflow-x-auto">{
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
                            <p class="text-gray-700 dark:text-gray-300 mb-2 font-medium">Custom columns:</p>
                            <div class="bg-gray-900 p-4 rounded-lg">
                                <code class="text-green-400 text-sm break-all font-mono">/csv?columns=first_name,last_name,email,company,city&rows=100</code>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Available Columns</h3>
                    <div class="flex flex-wrap gap-2 text-xs font-mono">
                        @foreach(['name','first_name','last_name','email','phone','address','city','state','country','zipcode','company','job_title','department','salary','date','datetime','url','ip','uuid','username','age','gender','product_name','price','category','sku','stock','order_id','customer','total','status','description','color'] as $col)
                            <span class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-2 py-1 rounded">{{ $col }}</span>
                        @endforeach
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Rate Limiting</h3>
                    <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                        <p class="text-gray-700 dark:text-gray-300 text-sm">120 requests per minute</p>
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Try It Now</h3>
                    <a href="/csv?preset=users&rows=25&seed=1" target="_blank"
                       class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors shadow-lg">
                        <x-heroicon-o-bolt class="w-5 h-5 mr-2" />
                        Download Sample CSV
                    </a>
                </section>
            </div>
        </div>
    </div>
</x-layout>
