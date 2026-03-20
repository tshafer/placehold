#!/usr/bin/env bash
# Release script: changelog, tag, push, optionally trigger Ploi deploy.
# Usage: ./scripts/release.sh 1.7.0 [--skip-changelog] [--since=v1.6.0]
# Requires: git, php, composer (for artisan). Set PLOI_DEPLOY_WEBHOOK_URL in .env to trigger deploy.

set -e
VERSION="${1:?Usage: $0 <version> (e.g. 1.7.0)}"
SKIP_CHANGELOG=""
SINCE=""
for arg in "$@"; do
  case "$arg" in
    --skip-changelog) SKIP_CHANGELOG=1 ;;
    --since=*) SINCE="$arg" ;;
  esac
done

ROOT="$(cd "$(dirname "$0")/.." && pwd)"
cd "$ROOT"

# Load optional webhook from .env
if [[ -f .env ]]; then
  val="$(grep -E '^PLOI_DEPLOY_WEBHOOK_URL=' .env 2>/dev/null | cut -d= -f2- | tr -d '"' | tr -d "'" | xargs)"
  [[ -n "$val" ]] && export PLOI_DEPLOY_WEBHOOK_URL="$val"
fi

echo "==> Release v${VERSION}"

if [[ -z "$SKIP_CHANGELOG" ]]; then
  echo "==> Generating changelog entry..."
  if [[ -n "$SINCE" ]]; then
    php artisan changelog:generate "$VERSION" "$SINCE"
  else
    php artisan changelog:generate "$VERSION"
  fi
  if git diff --quiet storage/app/changelog.json; then
    echo "    (no changelog changes)"
  else
    git add storage/app/changelog.json
    git commit -m "chore: update changelog for v${VERSION}"
  fi
else
  echo "==> Skipping changelog (--skip-changelog)"
fi

echo "==> Creating tag v${VERSION}"
git tag -a "v${VERSION}" -m "Release v${VERSION}"

BRANCH="$(git branch --show-current)"
echo "==> Pushing ${BRANCH} and v${VERSION}"
git push origin "$BRANCH"
git push origin "v${VERSION}"

if [[ -n "$PLOI_DEPLOY_WEBHOOK_URL" ]]; then
  echo "==> Triggering Ploi deploy..."
  curl -sS -X POST "$PLOI_DEPLOY_WEBHOOK_URL" || true
else
  echo "==> Set PLOI_DEPLOY_WEBHOOK_URL in .env to trigger Ploi deploy automatically."
fi

echo "==> Done. v${VERSION} tagged and pushed."
