#!/usr/bin/env bash
set -euo pipefail

SOURCE_BRANCH="${1:-main}"
TARGET_BRANCH="${BINDER_BRANCH:-binder}"
REMOTE="${REMOTE:-origin}"
WORKTREE_PARENT="${TMPDIR:-/tmp}"

BINDER_PATHS=(
  binder
  requirements.txt
  data
  chapters
  shared
)

ROOT="$(git rev-parse --show-toplevel)"
cd "$ROOT"

if [[ "$(git branch --show-current)" != "$SOURCE_BRANCH" ]]; then
  echo "Run this from the ${SOURCE_BRANCH} branch." >&2
  exit 1
fi

if [[ -n "$(git status --porcelain)" ]]; then
  echo "Working tree has uncommitted changes. Commit or stash them first." >&2
  git status --short >&2
  exit 1
fi

if ! git show-ref --verify --quiet "refs/heads/${TARGET_BRANCH}"; then
  git fetch "$REMOTE" "$TARGET_BRANCH"
  git branch "$TARGET_BRANCH" "${REMOTE}/${TARGET_BRANCH}"
fi

git fetch "$REMOTE" "$SOURCE_BRANCH" "$TARGET_BRANCH"

LOCAL_SOURCE="$(git rev-parse "$SOURCE_BRANCH")"
REMOTE_SOURCE="$(git rev-parse "${REMOTE}/${SOURCE_BRANCH}")"
if [[ "$LOCAL_SOURCE" != "$REMOTE_SOURCE" ]]; then
  echo "${SOURCE_BRANCH} has commits that are not pushed to ${REMOTE}/${SOURCE_BRANCH}." >&2
  echo "Push ${SOURCE_BRANCH} first, then rerun this script." >&2
  exit 1
fi

git branch --force "$TARGET_BRANCH" "${REMOTE}/${TARGET_BRANCH}"

WORKTREE="$(mktemp -d "${WORKTREE_PARENT%/}/dsm-binder.XXXXXX")"
cleanup() {
  git worktree remove --force "$WORKTREE" >/dev/null 2>&1 || true
}
trap cleanup EXIT

git worktree add "$WORKTREE" "$TARGET_BRANCH"

cd "$WORKTREE"

git rm -r --ignore-unmatch . >/dev/null
git checkout "$SOURCE_BRANCH" -- "${BINDER_PATHS[@]}"

if [[ -z "$(git status --porcelain)" ]]; then
  echo "Binder branch is already up to date."
  exit 0
fi

git add "${BINDER_PATHS[@]}"
git commit -m "Update Binder runtime from ${SOURCE_BRANCH}"
git push "$REMOTE" "$TARGET_BRANCH"

echo "Updated ${TARGET_BRANCH} from ${SOURCE_BRANCH}."
