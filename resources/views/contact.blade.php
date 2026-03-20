<x-layout>
    <section class="mb-16">
        <span class="text-tertiary font-headline font-bold text-xs tracking-[0.3em] uppercase mb-4 block">Support</span>
        <h1 class="text-5xl md:text-7xl font-headline font-extrabold tracking-tighter text-on-surface leading-none mb-4">
            Contact <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-tertiary">Us</span>
        </h1>
        <p class="text-on-surface-variant text-sm max-w-xl">We'd love to hear from you</p>
    </section>

    <div class="max-w-3xl">
        <div class="bg-surface-container-low p-6 lg:p-8">
            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="name" class="terminal-label mb-2 block">Name</label>
                    <input type="text" name="name" id="name" required class="terminal-input w-full">
                </div>
                <div>
                    <label for="email" class="terminal-label mb-2 block">Email</label>
                    <input type="email" name="email" id="email" required class="terminal-input w-full">
                </div>
                <div>
                    <label for="message" class="terminal-label mb-2 block">Message</label>
                    <textarea name="message" id="message" rows="6" required class="terminal-input w-full resize-none"></textarea>
                </div>
                <div>
                    <button type="submit" class="liquid-chrome p-3 font-headline font-bold text-on-primary-container uppercase tracking-widest text-xs w-full">
                        Send Message
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-8 text-center">
            <p class="text-outline text-xs mb-4">You can also reach us at:</p>
            <a href="mailto:support@placehold.cloud" class="text-primary hover:text-tertiary transition-colors inline-flex items-center gap-2 font-headline font-bold text-xs uppercase tracking-widest">
                <span class="material-symbols-outlined text-sm">mail</span>
                support@placehold.cloud
            </a>
        </div>
    </div>
</x-layout>
