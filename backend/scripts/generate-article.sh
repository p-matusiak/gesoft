#!/usr/bin/env bash
# Codzienny generator artykułu: ten sam Grok co TUI (OAuth w ~/.grok), bez XAI_API_KEY.
set -euo pipefail

ROOT="/var/www/gesoft2"
LOG="$ROOT/backend/storage/logs/articles-generate.log"
PROMPT_BASE="$ROOT/backend/resources/prompts/generate-article.md"
GROK_BIN="${GROK_BIN:-$HOME/.local/bin/grok}"
export HOME="${HOME:-/home/pawel}"
export PATH="$HOME/.local/bin:$PATH"
export TZ="Europe/Warsaw"

mkdir -p "$(dirname "$LOG")" "$ROOT/backend/storage/app/generated"

if ! command -v grok >/dev/null 2>&1 && [[ ! -x "$GROK_BIN" ]]; then
  echo "Brak binarki grok ($GROK_BIN). Uruchom ten skrypt na hoście, na koncie zalogowanym do Grok TUI." | tee -a "$LOG"
  exit 1
fi
[[ -x "$GROK_BIN" ]] || GROK_BIN="$(command -v grok)"

{
  echo "===== $(date -Iseconds) start ====="
  echo "grok=$GROK_BIN topic=${ARTICLE_TOPIC:-auto}"

  CATALOG="$(docker exec gesoft-app php artisan articles:catalog)"
  COMBINED="$(mktemp)"
  {
    cat "$PROMPT_BASE"
    echo
    echo "## Katalog z bazy (artykuły, branże, ostatnie tematy)"
    echo
    echo '```json'
    echo "$CATALOG"
    echo '```'
    if [[ -n "${ARTICLE_TOPIC:-}" ]]; then
      echo
      echo "ARTICLE_TOPIC=$ARTICLE_TOPIC — użyj tej branży."
    fi
  } > "$COMBINED"

  "$GROK_BIN" \
    --cwd "$ROOT" \
    --prompt-file "$COMBINED" \
    --yolo \
    --no-auto-update \
    --max-turns 120 \
    --output-format json

  rm -f "$COMBINED"
  echo "===== $(date -Iseconds) koniec ====="
} >>"$LOG" 2>&1
