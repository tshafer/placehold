<x-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl py-12">
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">CSV / Data Generator</h1>
        <p class="text-xl text-gray-600 dark:text-gray-400 mb-10">Generate fake tabular data with realistic names, emails, addresses, and more. Download as CSV or get JSON.</p>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 mb-8">
            <div class="flex items-center gap-3 mb-4">
                <x-heroicon-o-command-line class="w-6 h-6 text-gray-900 dark:text-white" />
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Basic Usage</h2>
            </div>
            <code class="block bg-gray-100 dark:bg-gray-900 rounded-lg px-4 py-3 text-sm text-gray-800 dark:text-gray-200 font-mono">GET /csv?rows=50&preset=users</code>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Parameters</h2>
            <div class="space-y-3 text-sm">
                <div class="flex gap-4"><span class="font-mono font-medium text-primary-600 dark:text-primary-400 w-28 shrink-0">rows</span><span class="text-gray-600 dark:text-gray-400">Number of rows (1-1000, default 25)</span></div>
                <div class="flex gap-4"><span class="font-mono font-medium text-primary-600 dark:text-primary-400 w-28 shrink-0">preset</span><span class="text-gray-600 dark:text-gray-400">Data preset: users, products, orders, employees, contacts</span></div>
                <div class="flex gap-4"><span class="font-mono font-medium text-primary-600 dark:text-primary-400 w-28 shrink-0">columns</span><span class="text-gray-600 dark:text-gray-400">Custom columns (comma-separated) when no preset is used</span></div>
                <div class="flex gap-4"><span class="font-mono font-medium text-primary-600 dark:text-primary-400 w-28 shrink-0">format</span><span class="text-gray-600 dark:text-gray-400">csv or json (default csv)</span></div>
                <div class="flex gap-4"><span class="font-mono font-medium text-primary-600 dark:text-primary-400 w-28 shrink-0">delimiter</span><span class="text-gray-600 dark:text-gray-400">Comma (default) or "tab" for TSV</span></div>
                <div class="flex gap-4"><span class="font-mono font-medium text-primary-600 dark:text-primary-400 w-28 shrink-0">seed</span><span class="text-gray-600 dark:text-gray-400">Seed for deterministic output</span></div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Presets</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm">
                <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-3"><span class="font-mono font-medium text-gray-900 dark:text-white">users</span><span class="block text-gray-500 dark:text-gray-400 mt-0.5">name, email, phone, city, country</span></div>
                <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-3"><span class="font-mono font-medium text-gray-900 dark:text-white">products</span><span class="block text-gray-500 dark:text-gray-400 mt-0.5">product_name, price, category, sku, stock</span></div>
                <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-3"><span class="font-mono font-medium text-gray-900 dark:text-white">orders</span><span class="block text-gray-500 dark:text-gray-400 mt-0.5">order_id, customer, email, total, date, status</span></div>
                <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-3"><span class="font-mono font-medium text-gray-900 dark:text-white">employees</span><span class="block text-gray-500 dark:text-gray-400 mt-0.5">name, email, department, job_title, salary, hire_date</span></div>
                <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-3"><span class="font-mono font-medium text-gray-900 dark:text-white">contacts</span><span class="block text-gray-500 dark:text-gray-400 mt-0.5">first_name, last_name, email, phone, company, address</span></div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Available Columns</h2>
            <div class="flex flex-wrap gap-2 text-xs font-mono">
                @foreach(['name','first_name','last_name','email','phone','address','city','state','country','zipcode','company','job_title','department','salary','date','datetime','url','ip','uuid','username','age','gender','product_name','price','category','sku','stock','order_id','customer','total','status','description','color'] as $col)
                    <span class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-2 py-1 rounded">{{ $col }}</span>
                @endforeach
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Examples</h2>
            <div class="space-y-3 text-sm">
                <a href="/csv?preset=users&rows=10" class="block bg-gray-50 dark:bg-gray-900 rounded-lg px-4 py-3 font-mono text-primary-600 dark:text-primary-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">/csv?preset=users&rows=10</a>
                <a href="/csv?columns=name,email,company,city&rows=50&seed=42" class="block bg-gray-50 dark:bg-gray-900 rounded-lg px-4 py-3 font-mono text-primary-600 dark:text-primary-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">/csv?columns=name,email,company,city&rows=50&seed=42</a>
                <a href="/csv?preset=products&format=json&rows=5" class="block bg-gray-50 dark:bg-gray-900 rounded-lg px-4 py-3 font-mono text-primary-600 dark:text-primary-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">/csv?preset=products&format=json&rows=5</a>
            </div>
        </div>

        <div class="text-center">
            <a href="/api" class="inline-flex items-center gap-2 text-primary-600 dark:text-primary-400 font-medium hover:underline">
                <x-heroicon-o-bolt class="w-5 h-5" />
                View full API documentation
            </a>
        </div>
    </div>
</x-layout>
