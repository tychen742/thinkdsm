# AGENTS.md — thinkdsm.org (Data Science & Management)

## Base

Skill: `book-authoring` (from ai_shared)
Style: `guidelines/STYLE_GUIDE.md` in ai_shared

## Project Context

- College-level introductory textbook for data science and management students
- Audience: students with no assumed programming or data science background
- Application context: business and management; CS concepts are secondary
- Published at thinkdsm.org as a Jupyter Book

## Read First

1. `README.md` for repository structure
2. `authoring/BOOK_PLAN.md` for audience, scope, and chapter sequence
3. `_toc.yml` for the current notebook order
4. The target chapter's `MATERIALS.md` and `ORGANIZATION.md` before editing that chapter

## Working Rules

### Content

- Business and management cases are the primary context for examples
- Prefer simple datasets (fruits, names, nums) when the topic doesn't require real data
- Reuse the same datasets across chapters for consistency
- Always show diffs when proposing changes to existing content

### Chapter Planning

- Every numbered chapter directory must contain `MATERIALS.md` and `ORGANIZATION.md`.
- Review both planning files before editing chapter content or chapter assignments. If either file is missing, create or restore it as part of the chapter edit.

### Exercises

- Create one exercise per `###` section that has substantial content
- Short or non-essential `###` sections do not require an exercise
- Place each exercise at the end of its `###` section
- Lab questions should extend or combine the section exercises, not introduce unrelated skills
- Two code cells per exercise: question cell (`thebe-interactive`), solution cell (`hide-input`)
- Starting with Chapter 02 labs, answer cells should be tagged `hide-input` and `lab-answer`; include answers in the notebook source, but reveal the "Show code cell source" toggle only after the due date by setting a page-level `data-lab-answers-release-at` timestamp.
- Auto-graded assignment feedback must not reveal correct answers before the due date. Before the due date, students may see their submission status, score, and retry guidance. After the due date, student review may show submitted answers and correct answers together.
- Auto-graded assignment submission panels should keep instructional headings, explanatory copy, and feedback/result rows hidden before submission. Show only the input fields and controls students need to submit. Reveal per-question feedback/results only after a submission returns, and allow multiple submissions by re-enabling the submit control after each attempt.

### Student Portal UI

- Put student portal navigation tabs in a top nav row above the page title, close to the top of the browser tab. Do not place tab-like navigation buttons inside the page header on scores or account pages.
- Keep the scores page compact: left-align the shell, avoid excess top padding, use tight section spacing, and keep table rows dense enough for scanning many attempts.
- In the book sidebar account menu, open `Account` and `My Scores` in new tabs using `target="_blank"` with `rel="noopener"`; keep `Log Out` in the current tab.

## Semester Constraints

Update each semester. Example entries: -->
- Spring 2026: chapters 1–8 are frozen; only chapters 9–12 are in scope
- Do not restructure existing chapter headings without discussion
