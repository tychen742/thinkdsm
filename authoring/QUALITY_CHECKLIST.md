# Chapter Quality Checklist

Use before finalizing any chapter. Adapted from `rubrics/chapter-quality.md` in ai_shared.

## Structure

- [ ] Sections are well organized and logically sequenced
- [ ] All important topics for this chapter are included
- [ ] No topics that belong in another chapter

## Landing Page (`xx00*.ipynb`)

- [ ] Intro paragraph with 3–5 bullet points of the most essential concepts
- [ ] Embedded video for the most important concept
- [ ] Numbered learning goals (measurable outcomes, no "understand" or "learn about")
- [ ] Chapter table of contents (`{tableofcontents}`)
- [ ] Chapter glossary

## Content Notebooks

- [ ] Each `###` section with substantial content has one exercise
- [ ] Short or non-essential `###` sections may skip the exercise
- [ ] Exercises use two cells: `thebe-interactive` (question) and `hide-input` (solution)
- [ ] All code cells run correctly top-to-bottom

## Assignments

- [ ] `assignments/` folder exists with `preview.ipynb`, `homework.ipynb`, `lab.ipynb`
- [ ] All three appear in the Jupyter Book left menu under Assignments
- [ ] Chapter 02+ lab answer cells use `hide-input` and `lab-answer`, with a page-level `data-lab-answers-release-at` timestamp so answers unlock only after the due date

## Prose

- [ ] Second person ("you"), active voice
- [ ] Short paragraphs; breaks at concept boundaries
- [ ] No filler openers
- [ ] No unexplained jargon on first use

## Datasets

- [ ] Business and management datasets used as the primary context
- [ ] Simple datasets (fruits, names, nums) used when the topic doesn't require real data
- [ ] Same datasets reused across chapters for consistency
