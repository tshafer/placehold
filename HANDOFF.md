# Placehold.cloud — Handoff for Future Work

**Last reviewed:** March 2026  
**Come back to:** add features, polish, and scale. Use this as a quick re-orientation.

---

## What the site is

**placehold.cloud** — placeholder API and generator hub:

- **Image placeholders** — `/640x320`, `/p/500x300/bg/fg`, many params (format, text, blur, watermark, cat/dog/robot, etc.).
- **Generators:** Avatars, favicons, QR codes, holdicons, PDF, video, CSV, markdown, base64, hash, UUID, color converter.
- **Data APIs:** Lorem ipsum (`/l`), quotes (`/q`), jokes (`/j`), weather (`/w`), recipes (`/r`), colors (`/c`), JSON placeholder (users/posts/comments/todos).
- **Pages:** Home, playground, usage stats dashboard, API docs, changelog, contact, legal (cookie, terms, privacy), about.

Stack: **Laravel 13**, PHP 8.3+, Octane (RoadRunner), Tailwind, Vite, Alpine.js. No auth; rate limits and throttling per route.

---

## What’s in place (current state)

### Core

- All routes in `routes/web.php`; most API routes use `throttle`, `track.api`, `ratelimit.headers`.
- **PlaceholderController** — main image API (sizes, formats, effects, watermarks).
- **Usage tracking** — `TrackApiUsage` middleware; counts and response times stored in Cache; dashboard at `/stats`, JSON at `/api-stats`.
- **Response time tracking** — rolling average ms per endpoint; shown in stats dashboard and in API stats as `avg_response_ms`.
- **CDN cache headers** — `config/cache_headers.php` maps route names to `Cache-Control`; `AddCacheHeaders` middleware (in web group) sets them.
- **Webhook/callback for long-running** — Video and PDF accept `callback_url` (and optional `job_id`). If set, return 202 and queue `GenerateVideoJob` / `GeneratePdfJob`; on completion POST to callback with `job_id`, `status`, `url` (one-time download), `expires_in`. One-time download routes: `/generated/video/{id}`, `/generated/pdf/{id}`.
- **Theme toggle** — Light/dark mode in topbar; preference in `localStorage`; inline script in layout to avoid flash.
- **Changelog** — driven by `storage/app/changelog.json`; structure: version, tag, date, title, items.

### Tests

- **Pest** feature tests for: placeholder, avatar, favicon, QR, PDF, video, stats, health, JSON placeholder, lorem, quotes, jokes, weather, recipe, CSV, markdown, colors, color converter, base64, hash, UUID, contact, playground, changelog, sitemap, rate limit headers, OpenAPI, dark mode, pages. Plus Dusk/browser tests (home, console errors).
- Run: `php artisan test` (or filter by `StatsTest`, `VideoTest`, etc.).

### Docs

- **API docs** at `/api` (Blade) — quick start, auth, base URL, endpoints with params/examples, rate limits.
- **README.md** — project overview, quick start, endpoints, use cases. (Badge says Laravel 12; app is Laravel 13 — update when touching README.)

---

## What’s left / ideas for next time (3+ months)

### Documentation

- **API docs** — add sections for: response time in stats API, webhook/callback for video & PDF (`callback_url`, `job_id`, 202 response, callback payload), and CDN/cache behavior (or link to `config/cache_headers.php`).
- **Video/PDF tool pages** — document `callback_url` and `job_id` on the generator UI (e.g. video-generator, pdf-generator views).
- **README** — add: Usage dashboard & response times, webhooks for video/PDF, per-endpoint cache headers; fix Laravel version badge to 13.

### Product / UX

- **Changelog content** — add a real release (e.g. v1.4 or v1.5) to `storage/app/changelog.json` for: response time tracking, webhooks, CDN headers, theme toggle.
- **Stats dashboard** — optional: p95 response time, or filter by date range; ensure “Avg (ms)” is clear for new users.
- **Queue** — if using async callbacks in production, ensure queue worker runs and consider failed-job handling (e.g. `queue:failed` table, retries, or notifications).
- **Generated files cleanup** — `storage/app/generated/` holds video/PDF until downloaded (one-time URL). Optional: scheduled job to delete files older than 1 hour.

### Technical / Ops

- **Cache** — stats and response times use Cache (default driver). If moving to Redis or multi-instance, ensure same store is used for `api_stats:*` keys.
- **Octane** — state file for RoadRunner; if “rpcPort” or reload issues reappear, stop/start Octane to regenerate state; consider upstream Octane fix or a composer patch.
- **Rate limits** — defined per route in `web.php`; adjust throttle values if traffic or abuse patterns change.
- **New endpoints** — when adding routes that should be tracked and cached, add them to `config/cache_headers.php` and use `track.api` (and optionally `ratelimit.headers`) middleware.

### Ideas for new features (when you return)

- More generators (e.g. placeholder audio, placeholder spreadsheets).
- API keys or optional auth for higher limits or billing.
- Webhook retries (with backoff) for failed callback POSTs.
- OpenAPI/Swagger export (there is an OpenApiTest; confirm it’s wired to a route if you want public spec).
- A simple status page (e.g. health + last errors) for ops.

---

## Key files (quick ref)

| Area              | Path |
|-------------------|------|
| Routes            | `routes/web.php` |
| Image API         | `app/Http/Controllers/PlaceholderController.php` |
| Usage + response   | `app/Http/Middleware/TrackApiUsage.php`, `app/Http/Controllers/ApiStatsController.php` |
| Stats UI          | `resources/views/stats.blade.php` |
| Cache headers     | `config/cache_headers.php`, `app/Http/Middleware/AddCacheHeaders.php` |
| Video/PDF sync    | `app/Http/Controllers/VideoController.php`, `app/Http/Controllers/PdfController.php` |
| Video/PDF async   | `app/Jobs/GenerateVideoJob.php`, `app/Jobs/GeneratePdfJob.php` |
| Generated files   | `app/Http/Controllers/GeneratedFileController.php` |
| Theme             | `resources/views/components/layout.blade.php`, `partials/topbar.blade.php`, `resources/css/app.css` (light overrides) |
| Changelog         | `storage/app/changelog.json`, `resources/views/changelog.blade.php` |
| API docs          | `resources/views/api.blade.php` |

---

## Commands

```bash
composer install
cp .env.example .env && php artisan key:generate
php artisan octane:start          # or octane:start --watch
php artisan queue:work            # if using async video/PDF callbacks
php artisan test                  # full test suite
```

---

*Revisit this file when you return in ~3 months; update “Last reviewed” and add/remove items as you ship.*
