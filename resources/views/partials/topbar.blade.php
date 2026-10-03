<header class="sticky top-0 w-full bg-background z-30 border-b border-dashed border-on-surface/40 mt-14 lg:mt-0">
    <div class="flex flex-wrap items-center justify-between gap-x-6 gap-y-2 px-6 lg:px-12 py-3 text-sm">
        <span class="font-bold hidden sm:inline">PLACEHOLD(1)</span>

        <label class="flex items-center gap-2 text-outline">
            <span aria-hidden="true">$</span>
            <span class="sr-only">Jump to tool</span>
            <input type="text"
                   x-data
                   @keydown.enter.prevent="if ($el.value.trim()) window.location.href = '/' + $el.value.trim().toLowerCase().replace(/^\/+/, '').replace(/\s+/g, '-')"
                   class="bg-transparent border-0 border-b border-dashed border-outline focus:border-on-surface focus:ring-0 text-sm text-on-surface placeholder:text-outline w-48 lg:w-64 px-0 py-1"
                   placeholder="jump to tool…">
        </label>

        <nav aria-label="Secondary" class="flex items-center gap-4">
            <a href="/api" class="text-primary hover:underline">api</a>
            <a href="/changelog" class="text-primary hover:underline hidden sm:inline">changelog</a>
            <button type="button"
                    x-data="{ dark: document.documentElement.classList.contains('dark') }"
                    @theme-change.window="dark = $event.detail.dark"
                    @click="$dispatch('theme-toggle')"
                    class="text-primary hover:underline"
                    :aria-label="dark ? 'Switch to light mode' : 'Switch to dark mode'">
                <span x-text="dark ? '[light]' : '[dark]'">[dark]</span>
            </button>
            <span class="font-bold hidden sm:inline">PLACEHOLD(1)</span>
        </nav>
    </div>
</header>
