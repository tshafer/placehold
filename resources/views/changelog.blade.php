@php
    $changelogPath = storage_path('app/changelog.json');
    $releases = file_exists($changelogPath)
        ? json_decode(file_get_contents($changelogPath), true) ?? []
        : [];

    $tagColors = [
        'New'      => 'bg-primary/10 text-primary',
        'Improved' => 'bg-secondary/10 text-secondary',
        'Fix'      => 'bg-error/10 text-error',
        'Launch'   => 'bg-on-surface/10 text-on-surface',
    ];
@endphp

<x-layout>
    <section class="mb-16">
        <span class="text-tertiary font-headline font-bold text-xs tracking-wide uppercase mb-4 block">Updates</span>
        <h1 class="text-5xl md:text-7xl font-headline font-extrabold tracking-tighter text-on-surface leading-none mb-4">
            Change<span class="text-on-surface">log</span>
        </h1>
        <p class="text-on-surface-variant text-sm max-w-xl">What's new and improved in placehold.cloud</p>
    </section>

    <div class="space-y-px bg-outline-variant/10">
        @forelse($releases as $release)
            <div class="bg-surface-container-low">
                <div class="px-6 lg:px-8 py-4 border-b border-outline-variant/20 flex items-center justify-between flex-wrap gap-3">
                    <div class="flex items-center gap-3">
                        <span class="font-mono text-sm font-bold text-on-surface">v{{ $release['version'] }}</span>
                        <span class="text-[10px] font-bold uppercase tracking-wide px-2 py-0.5 {{ $tagColors[$release['tag']] ?? $tagColors['New'] }}">{{ $release['tag'] }}</span>
                    </div>
                    <span class="text-outline text-xs">{{ $release['date'] }}</span>
                </div>
                <div class="px-6 lg:px-8 py-6">
                    <h3 class="text-sm font-headline font-bold text-on-surface mb-4">{{ $release['title'] }}</h3>
                    <ul class="space-y-2">
                        @foreach($release['items'] as $item)
                            <li class="flex items-start gap-3 text-on-surface-variant text-sm">
                                <span aria-hidden="true" class="shrink-0">•</span>
                                {{ $item }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @empty
            <div class="bg-surface-container-low p-8 text-center">
                <span class="text-outline text-sm">No changelog entries yet.</span>
            </div>
        @endforelse
    </div>
</x-layout>
