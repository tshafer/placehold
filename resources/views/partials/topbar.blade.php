<header class="sticky top-0 right-0 w-full h-14 lg:h-16 bg-surface/70 glass-panel flex items-center justify-between px-6 lg:px-8 z-30 shadow-[0_4px_20px_rgba(7,14,29,0.5)] border-b border-outline-variant/15 mt-14 lg:mt-0">
    <div class="flex items-center gap-6">
        <div class="hidden sm:flex relative items-center bg-surface-container-lowest px-4 py-1.5 border-b-2 border-outline-variant focus-within:border-tertiary transition-all">
            <span class="material-symbols-outlined text-outline text-sm mr-2">search</span>
            <input type="text"
                   x-data
                   @keydown.enter.prevent="if ($el.value.trim()) window.location.href = '/' + $el.value.trim().toLowerCase().replace(/\s+/g, '-')"
                   class="bg-transparent border-none focus:ring-0 text-xs font-headline uppercase tracking-widest text-on-surface placeholder:text-outline/50 w-48 lg:w-64 p-0"
                   placeholder="JUMP TO TOOL...">
        </div>
    </div>

    <div class="flex items-center gap-4 lg:gap-6">
        <div class="flex items-center gap-3 text-outline">
            <a href="/playground" class="hover:text-primary transition-all" title="Playground">
                <span class="material-symbols-outlined text-[20px]">terminal</span>
            </a>
            <a href="/stats" class="hover:text-primary transition-all" title="Usage Stats">
                <span class="material-symbols-outlined text-[20px]">monitoring</span>
            </a>
            <a href="/api" class="hover:text-primary transition-all" title="API Docs">
                <span class="material-symbols-outlined text-[20px]">api</span>
            </a>
            <a href="/ai-docs" class="hover:text-primary transition-all" title="AI Docs">
                <span class="material-symbols-outlined text-[20px]">smart_toy</span>
            </a>
        </div>
        <div class="h-6 w-[1px] bg-outline-variant/30 hidden sm:block"></div>
        <div class="flex items-center gap-3" x-data="{ dark: document.documentElement.classList.contains('dark') }" x-init="dark = document.documentElement.classList.contains('dark')" @theme-change.window="dark = $event.detail.dark">
            <button type="button" @click="$dispatch('theme-toggle')"
                class="flex items-center rounded-full p-1 w-14 h-8 bg-surface-container-high border border-outline-variant/30 transition-all duration-200 hover:border-outline/50 focus:outline-none focus:ring-2 focus:ring-tertiary/40 focus:ring-offset-2 focus:ring-offset-surface"
                :class="dark ? 'justify-start' : 'justify-end'"
                :title="dark ? 'Switch to light mode' : 'Switch to dark mode'"
                aria-label="Toggle theme">
                <span class="flex h-6 w-6 items-center justify-center rounded-full bg-surface-container-lowest border border-outline-variant/40 shadow-sm transition-transform duration-200"
                    :class="dark ? 'text-outline' : 'text-primary'">
                    <span class="material-symbols-outlined text-[18px]" x-show="dark" x-transition>dark_mode</span>
                    <span class="material-symbols-outlined text-[18px]" x-show="!dark" x-transition x-cloak>light_mode</span>
                </span>
            </button>
            <div class="items-center gap-2 hidden sm:flex">
                <span class="w-2 h-2 rounded-full bg-tertiary animate-beacon-pulse"></span>
                <span class="meta-label text-tertiary">Online</span>
            </div>
        </div>
    </div>
</header>
