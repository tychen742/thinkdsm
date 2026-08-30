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

## Shared Book Rules

Follow `book-authoring` for shared Jupyter Book conventions: landing page format, content notebook structure, glossary/index rules, assignment order, standard assignment descriptions, preview/lab/homework formats, submit panel behavior, student portal links, and chapter overview slides.

## Working Rules

### Content

- Business and management cases are the primary context for examples.
- Prefer simple datasets (fruits, names, nums) when the topic does not require real data.
- Reuse the same datasets across chapters for consistency.
- Always show diffs when proposing changes to existing content.

### Landing Pages

- Landing pages (first notebook in each chapter) are named `NNNN-topic.ipynb` without "intro" suffix
  - Example: `0100-data-science.ipynb`, `0200-python.ipynb`, `0300-numpy.ipynb`
  - Landing pages introduce chapter scope and learning outcomes only
  - Landing pages do not contain exercises

### Sidebar Navigation

- Menu expand/collapse arrows must sit on the same visual baseline as the corresponding menu entry text. Do not leave arrows on a separate lower line or vertically offset from the entry they control.

### Chapter Planning

- Every numbered chapter directory must contain `MATERIALS.md` and `ORGANIZATION.md`.
- Review both planning files before editing chapter content or chapter assignments. If either file is missing, create or restore it as part of the chapter edit.

### Exercises

- Create one exercise per `###` section that has substantial content.
- Short or non-essential `###` sections do not require an exercise.
- Place each exercise at the end of its `###` section.
- Two code cells per exercise: question cell (`thebe-interactive`), solution cell (`hide-input`).

### DSM Assignment Overrides

- Auto-graded assignment IDs must use `chNN-preview`, `chNN-lab`, and `chNN-homework`, where `NN` is the two-digit chapter number. Do not use assignment-first IDs such as `preview02`, `lab02`, or `homework02` for new assignment records.
- Starting with Chapter 02 labs, answer cells should be tagged `hide-input` and `lab-answer`; include answers in the notebook source, but reveal the "Show code cell source" toggle only after the due date by setting a page-level `data-lab-answers-release-at` timestamp.
- Auto-graded assignment feedback must not reveal correct answers before the due date. Before the due date, students may see their submission status, score, and retry guidance. After the due date, student review may show submitted answers and correct answers together.
- Authentication events are research data for later research projects. Keep historical login timestamps for each user in a login-event table; do not rely only on an overwritten `last_login_at` field.

## Semester Constraints

Update each semester. Example entries: -->
- Spring 2026: chapters 1–8 are frozen; only chapters 9–12 are in scope
- Do not restructure existing chapter headings without discussion
