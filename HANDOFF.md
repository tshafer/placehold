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
- **MCP** — Route `GET|POST /mcp` implements the MCP protocol in PHP (`McpController` + `McpService`). No Node process required; `https://placehold.cloud/mcp` works as soon as the Laravel app is deployed. Tools: placehold_image, placehold_quote, placehold_joke, placehold_lorem, placehold_uuid, placehold_colors. CSRF excluded for `mcp`. **If you get 404 on /mcp locally:** run `php artisan route:clear` then restart Octane (`php artisan octane:stop` then `php artisan octane:start`) so workers pick up the route.

### Tests

- **Pest** feature tests for: placeholder, avatar, favicon, QR, PDF, video, stats, health, JSON placeholder, lorem, quotes, jokes, weather, recipe, CSV, markdown, colors, color converter, base64, hash, UUID, contact, playground, changelog, sitemap, rate limit headers, OpenAPI, dark mode, pages. Plus Dusk/browser tests (home, console errors).
- Run: `php artisan test` (or filter by `StatsTest`, `VideoTest`, etc.).

### Docs

- **API docs** at `/api` (Blade) — quick start, auth, base URL, endpoints with params/examples, rate limits.
- **README.md** — project overview, quick start, endpoints, use cases. (Badge says Laravel 12; app is Laravel 13 — update when touching README.)

---

## What’s left / ideas for next time (3+ months)

### Documentation

- **README** — Laravel version badge is 13; usage dashboard, webhooks, cache headers, and MCP are documented in Features.

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
| MCP               | `app/Http/Controllers/McpController.php`, `app/Services/McpService.php`, `resources/views/ai-docs.blade.php` |

---

## Commands

```bash
composer install
cp .env.example .env && php artisan key:generate
php artisan octane:start          # or octane:start --watch
php artisan queue:work            # if using async video/PDF callbacks
php artisan test                  # full test suite
```

## Release & deploy

**Script:** `./scripts/release.sh <version>` — generates changelog (from conventional commits), commits changelog, tags `v<version>`, pushes branch and tag. Optional: `--skip-changelog`, `--since=v1.6.0` to only include commits since that tag.

**GitHub Actions:** `.github/workflows/release.yml` runs on tag push (`v*`). It checks out the tag, runs `composer install` and `php artisan test`; if tests pass, it POSTs to the Ploi deploy webhook. Add secret **PLOI_DEPLOY_WEBHOOK** in repo Settings → Secrets with the Ploi Quick Deploy URL. Flow: run `./scripts/release.sh 1.7.0`; workflow runs tests on that tag, then triggers Ploi.

**Ploi:** By default Ploi deploys from a **branch** (e.g. `main`). When you run the release script you push to that branch and push the tag; the same commit is on both, so triggering a deploy deploys the tagged code. In Ploi: Site → Repository → set branch to `main` (or your default). To trigger deploy from the script, set `PLOI_DEPLOY_WEBHOOK_URL` in `.env` (copy the “Quick Deploy” webhook from Ploi → Repository tab). Then `./scripts/release.sh 1.7.0` will tag, push, and hit the webhook.

**Deploy from a specific tag on the server:** If you want the server to always run a specific tag (e.g. `v1.7.0`) instead of the branch tip, use a custom deploy script in Ploi. In Ploi → Site → Deployment Script, you can add after “Pull from repository” something like: `git fetch --tags && git checkout v1.7.0` (or pass the tag from an env var). To have the server run the tagged release (not just branch tip), in Ploi deploy script use: `git fetch --tags` then `git checkout $(git tag -l 'v*' --sort=-version:refname | head -1)` so each deploy checks out the newest tag. Then `composer install`, `php artisan migrate --force`, restart Octane as usual.

---

*Revisit this file when you return in ~3 months; update “Last reviewed” and add/remove items as you ship.*
