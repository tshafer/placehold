<x-layout>
    <section class="mb-16">
        <span class="text-tertiary font-headline font-bold text-xs tracking-[0.3em] uppercase mb-4 block">WordPress Plugin</span>
        <h1 class="text-5xl md:text-7xl font-headline font-extrabold tracking-tighter text-on-surface leading-none mb-4">
            RadMonitor <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-tertiary">Error Reporter</span>
        </h1>
        <p class="text-on-surface-variant text-sm max-w-2xl mb-8">Official WordPress plugin for RadMonitor: Catch and track all WordPress errors in your RadMonitor dashboard</p>
        <div class="flex flex-wrap gap-4">
            <a href="https://wordpress.org/plugins/radmonitor" class="liquid-chrome p-3 font-headline font-bold text-on-primary-container uppercase tracking-widest text-xs inline-flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">download</span> Install Plugin
            </a>
            <a href="https://docs.radmonitor.live/plugins/error-reporter" class="text-outline border border-outline-variant/40 hover:text-primary hover:border-primary/40 px-4 py-2 font-headline font-bold text-xs uppercase tracking-widest transition-all inline-flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">menu_book</span> Documentation
            </a>
        </div>
        <p class="text-outline text-xs mt-4">Requires RadMonitor account &bull; Compatible with WordPress 5.0+</p>
    </section>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-px bg-outline-variant/10 mb-16">
        <div class="bg-surface-container-low p-6 border-l-2 border-primary/30">
            <span class="text-2xl font-headline font-extrabold text-on-surface">Simple</span>
            <span class="meta-label block mt-1">One-Click Install</span>
        </div>
        <div class="bg-surface-container-low p-6 border-l-2 border-primary/30">
            <span class="text-2xl font-headline font-extrabold text-on-surface">Real-time</span>
            <span class="meta-label block mt-1">Error Tracking</span>
        </div>
        <div class="bg-surface-container-low p-6 border-l-2 border-primary/30">
            <span class="text-2xl font-headline font-extrabold text-on-surface">Zero</span>
            <span class="meta-label block mt-1">Performance Impact</span>
        </div>
        <div class="bg-surface-container-low p-6 border-l-2 border-primary/30">
            <span class="text-2xl font-headline font-extrabold text-on-surface">Secure</span>
            <span class="meta-label block mt-1">End-to-End Encrypted</span>
        </div>
    </div>

    <div class="bg-surface-container-low p-6 lg:p-8 mb-16">
        <h2 class="section-title mb-8">See How It Works</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-surface-container-lowest p-6">
                <div class="flex items-center gap-2 mb-4">
                    <span class="w-3 h-3 bg-[#ff5f57]"></span>
                    <span class="w-3 h-3 bg-[#febc2e]"></span>
                    <span class="w-3 h-3 bg-[#28c840]"></span>
                </div>
                <div class="code-block">
                    <pre class="text-sm text-tertiary font-mono"><code>// Example WordPress Error
try {
    throw new Exception('Database connection failed');
} catch (Exception $e) {
    radmonitor_report($e);
}</code></pre>
                </div>
            </div>
            <div class="bg-surface-container-lowest p-6 flex items-center justify-center">
                <img src="/images/dashboard-preview.png" alt="RadMonitor Dashboard" class="max-w-full">
            </div>
        </div>
    </div>

    <section class="mb-16">
        <h2 class="section-title mb-10">Quick Installation</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-px bg-outline-variant/10">
            <div class="bg-surface-container-low p-6 lg:p-8 relative">
                <span class="text-tertiary font-headline font-extrabold text-2xl mb-3 block">01</span>
                <h3 class="font-headline font-bold text-on-surface text-sm uppercase tracking-widest mb-3">Install Plugin</h3>
                <p class="text-outline text-xs">Download and install the RadMonitor plugin from WordPress.org</p>
            </div>
            <div class="bg-surface-container-low p-6 lg:p-8 relative">
                <span class="text-tertiary font-headline font-extrabold text-2xl mb-3 block">02</span>
                <h3 class="font-headline font-bold text-on-surface text-sm uppercase tracking-widest mb-3">Add API Key</h3>
                <p class="text-outline text-xs">Enter your RadMonitor API key in the plugin settings</p>
            </div>
            <div class="bg-surface-container-low p-6 lg:p-8 relative">
                <span class="text-tertiary font-headline font-extrabold text-2xl mb-3 block">03</span>
                <h3 class="font-headline font-bold text-on-surface text-sm uppercase tracking-widest mb-3">Start Monitoring</h3>
                <p class="text-outline text-xs">That's it! Your errors will now be tracked in RadMonitor</p>
            </div>
        </div>
    </section>

    <section class="mb-16">
        <h2 class="section-title mb-4">Key Features</h2>
        <p class="text-on-surface-variant text-sm mb-10">Everything you need to monitor and improve your WordPress site</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-px bg-outline-variant/10">
            @foreach([
                ['icon' => 'warning', 'title' => 'Error Monitoring', 'items' => ['PHP Error Tracking', 'WordPress Error Logging', 'Exception Handling', 'Custom Error Reporting']],
                ['icon' => 'monitoring', 'title' => 'Analytics', 'items' => ['Error Frequency', 'Impact Analysis', 'Error Patterns', 'Custom Reports']],
                ['icon' => 'shield', 'title' => 'Security', 'items' => ['Secure Data Transfer', 'API Authentication', 'Data Encryption', 'Access Control']],
                ['icon' => 'extension', 'title' => 'Integration', 'items' => ['RadMonitor Dashboard', 'Email Notifications', 'Slack Alerts', 'Webhook Support']],
                ['icon' => 'tune', 'title' => 'Configuration', 'items' => ['Easy Setup', 'Flexible Options', 'Error Filtering', 'Custom Rules']],
                ['icon' => 'support', 'title' => 'Support', 'items' => ['24/7 Support', 'Documentation', 'Video Tutorials', 'Community Help']],
                ['icon' => 'database', 'title' => 'Automated Backups', 'items' => ['Daily Backups', 'Secure Storage', 'One-Click Restore', 'Version History']],
                ['icon' => 'code', 'title' => 'API Integration', 'items' => ['RESTful API', 'Custom Endpoints', 'Webhooks', 'API Documentation']],
            ] as $feature)
                <div class="bg-surface-container-low p-6 lg:p-8 hover:bg-surface-container-lowest transition-colors">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="material-symbols-outlined text-primary">{{ $feature['icon'] }}</span>
                        <h3 class="font-headline font-bold text-on-surface text-xs uppercase tracking-widest">{{ $feature['title'] }}</h3>
                    </div>
                    <ul class="space-y-2">
                        @foreach($feature['items'] as $item)
                            <li class="flex items-center gap-2 text-on-surface-variant text-sm">
                                <span class="material-symbols-outlined text-tertiary text-sm">check</span>
                                {{ $item }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </section>

    <div class="bg-surface-container-low p-6 lg:p-8 border-l-2 border-primary/30 mb-16">
        <div class="text-center">
            <h2 class="text-2xl font-headline font-extrabold text-on-surface mb-3">Ready to Add Error Reporting?</h2>
            <p class="text-on-surface-variant text-sm mb-8">Install the plugin and connect to your RadMonitor account in minutes</p>
            <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                <a href="https://wordpress.org/plugins/radmonitor" class="liquid-chrome p-3 font-headline font-bold text-on-primary-container uppercase tracking-widest text-xs inline-flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">download</span> Install Plugin
                </a>
                <a href="https://docs.radmonitor.live/plugins/error-reporter" class="text-outline border border-outline-variant/40 hover:text-primary hover:border-primary/40 px-4 py-2 font-headline font-bold text-xs uppercase tracking-widest transition-all inline-flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">menu_book</span> View Documentation
                </a>
            </div>
        </div>
    </div>

    <section class="mb-16">
        <h2 class="section-title mb-8">What RadMonitor Users Say</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-px bg-outline-variant/10">
            @foreach([
                ['quote' => 'The error reporting plugin has been a game-changer. It integrates perfectly with RadMonitor and catches every issue.', 'name' => 'Sarah Johnson', 'role' => 'WordPress Developer', 'img' => 'https://i.pravatar.cc/40?img=1'],
                ['quote' => 'Setup was incredibly simple. Just installed the plugin, entered my RadMonitor API key, and it was working instantly.', 'name' => 'Michael Chen', 'role' => 'Site Administrator', 'img' => 'https://i.pravatar.cc/40?img=2'],
                ['quote' => 'The error analytics in RadMonitor have helped us identify and fix issues we didn\'t even know existed.', 'name' => 'Emma Wilson', 'role' => 'Lead Developer', 'img' => 'https://i.pravatar.cc/40?img=3'],
            ] as $testimonial)
                <div class="bg-surface-container-low p-6 lg:p-8">
                    <div class="text-secondary mb-4">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                    <p class="text-on-surface-variant text-sm mb-6">"{{ $testimonial['quote'] }}"</p>
                    <div class="flex items-center gap-3">
                        <img src="{{ $testimonial['img'] }}" class="w-10 h-10" alt="{{ $testimonial['name'] }}">
                        <div>
                            <div class="font-headline font-bold text-on-surface text-xs">{{ $testimonial['name'] }}</div>
                            <div class="text-outline text-xs">{{ $testimonial['role'] }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="mb-16">
        <h2 class="section-title mb-8">Frequently Asked Questions</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-px bg-outline-variant/10">
            @foreach([
                ['q' => 'Will this slow down my site?', 'a' => 'No, RadMonitor is designed to have minimal impact on your site\'s performance. Error reporting happens asynchronously.'],
                ['q' => 'Do I need a RadMonitor account?', 'a' => 'Yes, you\'ll need a RadMonitor account to use this plugin. You can sign up for free at radmonitor.live.'],
                ['q' => 'What PHP versions are supported?', 'a' => 'The plugin supports PHP 7.2 and above, including PHP 8.x versions.'],
                ['q' => 'How secure is the error reporting?', 'a' => 'All data is encrypted in transit using TLS 1.3 and we never store sensitive information like passwords or API keys.'],
            ] as $faq)
                <div class="bg-surface-container-low p-6 lg:p-8">
                    <h3 class="font-headline font-bold text-on-surface text-sm mb-3">{{ $faq['q'] }}</h3>
                    <p class="text-on-surface-variant text-sm">{{ $faq['a'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <div class="flex flex-wrap justify-center items-center gap-8 py-8">
        <img src="/images/wordpress-verified.svg" alt="WordPress Verified" class="h-16 opacity-50 hover:opacity-100 transition">
        <img src="/images/php-compatible.svg" alt="PHP Compatible" class="h-16 opacity-50 hover:opacity-100 transition">
        <img src="/images/gdpr-compliant.svg" alt="GDPR Compliant" class="h-16 opacity-50 hover:opacity-100 transition">
        <img src="/images/ssl-secure.svg" alt="SSL Secure" class="h-16 opacity-50 hover:opacity-100 transition">
        <img src="/images/soc2-certified.svg" alt="SOC2 Certified" class="h-16 opacity-50 hover:opacity-100 transition">
    </div>
</x-layout>
