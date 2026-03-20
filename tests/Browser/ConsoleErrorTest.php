<?php

use Laravel\Dusk\Browser;

$pages = [
    '/' => 'home',
    '/image' => 'image',
    '/lorem-ipsum' => 'lorem ipsum',
    '/jokes' => 'jokes',
    '/quotes' => 'quotes',
    '/weather' => 'weather',
    '/recipes' => 'recipes',
    '/colors' => 'colors',
    '/holdicon' => 'holdicon',
    '/icons' => 'icons',
    '/avatar' => 'avatar',
    '/qrcode' => 'qr code',
    '/favicon-generator' => 'favicon',
    '/json-placeholder' => 'json placeholder',
    '/pdf-generator' => 'pdf',
    '/csv-generator' => 'csv',
    '/markdown-generator' => 'markdown',
    '/video-generator' => 'video',
    '/about-us' => 'about us',
    '/api' => 'api docs',
    '/contact' => 'contact',
    '/cookie-policy' => 'cookie policy',
    '/terms-of-service' => 'terms of service',
    '/privacy-policy' => 'privacy policy',
];

function collectJsErrors(Browser $browser): array
{
    $entries = $browser->driver->manage()->getLog('browser');

    return array_values(array_filter($entries, function ($entry) {
        if ($entry['level'] !== 'SEVERE') {
            return false;
        }
        // Network errors (500s, 404s, failed fetches) are server-side, not JS bugs
        if (($entry['source'] ?? '') === 'network') {
            return false;
        }
        $msg = $entry['message'] ?? '';
        if (str_contains($msg, 'favicon.ico')) {
            return false;
        }
        return true;
    }));
}

foreach ($pages as $url => $name) {
    test("{$name} page has no JS console errors", function () use ($url) {
        $this->browse(function (Browser $browser) use ($url) {
            $browser->visit($url)->pause(1500);

            $jsErrors = collectJsErrors($browser);

            expect($jsErrors)->toBeEmpty(
                "JS errors on {$url}: " . json_encode($jsErrors, JSON_PRETTY_PRINT)
            );
        });
    });
}

test('cookie banner closes when clicking accept', function () {
    $this->browse(function (Browser $browser) {
        // Clear localStorage so the banner shows
        $browser->visit('/');
        $browser->script("localStorage.removeItem('cookieConsent')");
        $browser->visit('/')
            ->pause(500)
            ->assertVisible('#cookie-consent')
            ->press('Accept')
            ->pause(500)
            ->assertMissing('#cookie-consent');
    });
});

test('dark mode toggle works without JS errors', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/')
            ->pause(500);

        // Drain any pre-existing log entries
        $browser->driver->manage()->getLog('browser');

        $browser->script("document.querySelector('form[action*=\"toggle-dark-mode\"] button')?.click()");
        $browser->pause(1500);

        $jsErrors = collectJsErrors($browser);
        expect($jsErrors)->toBeEmpty();
    });
});

test('icons page search filters without JS errors', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/icons')
            ->pause(1000);

        // Drain pre-existing log entries
        $browser->driver->manage()->getLog('browser');

        $browser->type('input[x-model="searchQuery"]', 'zoom')
            ->pause(500);

        $jsErrors = collectJsErrors($browser);
        expect($jsErrors)->toBeEmpty();
    });
});

test('mobile menu opens without JS errors', function () {
    $this->browse(function (Browser $browser) {
        $browser->resize(375, 812)
            ->visit('/')
            ->pause(500);

        $browser->driver->manage()->getLog('browser');

        $browser->script("document.querySelector('[\\\\@click*=mobileMenuOpen]')?.click()");
        $browser->pause(500);

        $jsErrors = collectJsErrors($browser);
        expect($jsErrors)->toBeEmpty();
    });
});

test('nav dropdowns open without JS errors', function () {
    $this->browse(function (Browser $browser) {
        $browser->resize(1920, 1080)
            ->visit('/')
            ->pause(500);

        $browser->driver->manage()->getLog('browser');

        // Hover over the Generators dropdown trigger
        $browser->script("document.querySelectorAll('nav button')[0]?.dispatchEvent(new Event('mouseenter'))");
        $browser->pause(500);

        $jsErrors = collectJsErrors($browser);
        expect($jsErrors)->toBeEmpty();
    });
});
