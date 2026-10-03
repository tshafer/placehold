<x-layout>
    <div class="max-w-4xl text-[15px] leading-relaxed">
        <span class="text-tertiary font-headline font-bold text-xs tracking-wide uppercase mb-4 block">LOREM-IPSUM(1)</span>
        <h1 class="sr-only">Lorem Ipsum Generator</h1>

        <x-man-section title="Name">
            <p>l — generate lorem ipsum placeholder text</p>
        </x-man-section>

        <x-man-section title="Synopsis">
            <div class="code-block break-all">GET {{ url('/l') }} [?paragraphs=<u>n</u>] [&amp;minWords=<u>n</u>] [&amp;maxWords=<u>n</u>] [&amp;format=json|html|text] [&amp;seed=<u>n</u>]</div>
        </x-man-section>

        <x-man-section title="Description">
            <p class="max-w-2xl">Returns paragraphs of lorem ipsum. With no options you get 3 paragraphs as JSON. Pass a <b>seed</b> to get the same text every time.</p>
        </x-man-section>

        <x-man-section title="Options">
            <dl class="space-y-3">
                <div><dt class="font-bold text-primary">paragraphs</dt><dd class="ml-6">Number of paragraphs, 1–100. Default 3.</dd></div>
                <div><dt class="font-bold text-primary">minWords</dt><dd class="ml-6">Minimum words per paragraph, 1–100. Default 5.</dd></div>
                <div><dt class="font-bold text-primary">maxWords</dt><dd class="ml-6">Maximum words per paragraph, 1–100. Default 20.</dd></div>
                <div><dt class="font-bold text-primary">format</dt><dd class="ml-6">json, html or text. Default json.</dd></div>
                <div><dt class="font-bold text-primary">seed</dt><dd class="ml-6">Seed for repeatable output. Optional.</dd></div>
                <div><dt class="font-bold text-primary">capitalize</dt><dd class="ml-6">Capitalize the first word of each sentence. Default true.</dd></div>
                <div><dt class="font-bold text-primary">addPunctuation</dt><dd class="ml-6">Add commas and periods inside paragraphs. Default false.</dd></div>
                <div><dt class="font-bold text-primary">startWithLoremIpsum</dt><dd class="ml-6">Begin with “Lorem ipsum dolor sit amet”. Default true.</dd></div>
            </dl>
        </x-man-section>

        <x-man-section title="Examples">
            <div class="space-y-4 break-all">
                <div><p class="text-outline">Three paragraphs as JSON:</p><p class="ml-6"><span class="text-outline">$</span> curl {{ url('/l') }}</p></div>
                <div><p class="text-outline">Two 10–15 word paragraphs as HTML, with punctuation:</p><p class="ml-6"><span class="text-outline">$</span> curl "{{ url('/l') }}?paragraphs=2&amp;minWords=10&amp;maxWords=15&amp;format=html&amp;addPunctuation=true"</p></div>
                <div><p class="text-outline">Plain text that never changes:</p><p class="ml-6"><span class="text-outline">$</span> curl "{{ url('/l') }}?format=text&amp;seed=42"</p></div>
            </div>
        </x-man-section>

        <x-man-section title="Output">
            <pre class="code-block">{
  "status": "success",
  "data": [ ... ],
  "metadata": {
    "paragraphs": 3,
    "minWords": 5,
    "maxWords": 20,
    "totalWords": 45,
    "format": "json",
    "seed": 12345
  }
}</pre>
        </x-man-section>

        <x-man-section title="Try it">
            <a href="{{ url('/l') }}" target="_blank" rel="noopener"
               class="liquid-chrome text-on-primary-container px-5 py-3 font-bold text-sm inline-block hover:opacity-80 transition-opacity">Open {{ url('/l') }}</a>
        </x-man-section>

        <x-man-section title="Limits">
            <p>120 requests per minute per IP.</p>
        </x-man-section>
    </div>
</x-layout>
