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

### Exercises

- Create one exercise per `###` section that has substantial content
- Short or non-essential `###` sections do not require an exercise
- Place each exercise at the end of its `###` section
- Lab questions should extend or combine the section exercises, not introduce unrelated skills
- Two code cells per exercise: question cell (`thebe-interactive`), solution cell (`hide-input`)
- Starting with Chapter 02 labs, answer cells should be tagged `hide-input` and `lab-answer`; include answers in the notebook source, but reveal the "Show code cell source" toggle only after the due date by setting a page-level `data-lab-answers-release-at` timestamp.

## Semester Constraints

Update each semester. Example entries: -->
- Spring 2026: chapters 1–8 are frozen; only chapters 9–12 are in scope
- Do not restructure existing chapter headings without discussion
