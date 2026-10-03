@props(['title'])

<section {{ $attributes->merge(['class' => 'mt-8 first:mt-0']) }}>
    <h2 class="font-extrabold uppercase">{{ $title }}</h2>
    <div class="ml-6 sm:ml-12 mt-2">{{ $slot }}</div>
</section>
