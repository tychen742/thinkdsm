# Chapter 02 Materials

## Purpose

Chapter 02 introduces Python basics for students who are new to programming. It covers syntax, values, variables, control flow, core collections, dictionaries, and functions as preparation for data work in later chapters.

## Source Notebooks

- `0200-intro-py.ipynb` - chapter landing page for Python Basics, with title, overview, video, learning goals, chapter flow, glossary, and overview slide link.
- `0201-py-syntax.ipynb` - input and output, comments, variables, objects, type conversion, keywords, operators, built-in data types, data structures, modules, and packages.
- `0202-control-structures.ipynb` - conditionals, Boolean expressions, `while` loops, `for` loops, sequence iteration, `range()`, `enumerate()`, nested loops, and loop control.
- `0203-lists.ipynb` - list creation, indexing, slicing, modification, operations, functions, methods, strings, objects and values, aliasing, and reading word lists.
- `0206-dictionaries.ipynb` - dictionaries as mappings, dictionary creation, membership, counters, dictionary iteration, lists and dictionaries, and accumulation patterns.
- `0208-functions.ipynb` - built-in functions, user-defined functions, parameters and arguments, function composition, return values, docstrings, repetition, list arguments, scope, stack diagrams, and tracebacks.
- `0204-tuples.ipynb` - tuple material currently present in the folder but not listed in `_toc.yml`.

## Student Assignments

- `assignments/index.ipynb` - assignment landing page.
- `assignments/preview.ipynb` - Chapter 02 server-graded preview quiz (`ch02-preview`) covering glossary and core terms in multiple-choice form.
- `assignments/lab.ipynb` - Chapter 02 server-graded lab (`ch02-lab`) with Python practice on expressions, conditionals, loops, dictionaries, and functions.
- `assignments/homework.ipynb` - Chapter 02 server-graded homework (`ch02-homework`) with five true/false questions and five coding questions.

## Figures And Media

- `../../figures/python-cheat-sheet-365.jpg`
- `../../figures/knowledge-experience-creativity.jpg`
- `../../figures/python-data-types-2.png`
- `../../figures/list-indexing.png`
- `../../figures/python-builtin-functions.png`

## External References And Downloads

- Python documentation for built-in functions, standard types, expressions, keywords, and the tutorial.
- PEP 8 for Python naming and indentation conventions.
- `words.txt` examples draw from Allen Downey's Think Python word-list examples.
- Some dormant tuple material downloads `structshape.py` and Project Gutenberg text.

## Slide Deck

- `_html_extra/chapters/02-python/overview.md` - Marp source for the Chapter 02 overview slides.
- `_html_extra/chapters/02-python/overview.html` - rendered by the deploy script from `overview.md`.

## Supporting Code And Data

- `chapters/02-python/diagram.py` is currently stored in the chapter directory.
- `chapters/02-python/words.txt` is currently stored in the chapter directory.
- These files are tracked as a project TODO in `authoring/PROGRESS.md` because runnable/source/data files should eventually live under `materials/02/`.
- No Chapter 02 directory exists under `materials/02/`.

## Maintenance Notes

- `0204-tuples.ipynb` exists but is not part of the current table of contents. Do not add it to the live sequence without a separate structure decision.
- Keep Chapter 02 assignments aligned with the assignment release and answer-visibility rules in `AGENTS.md`.
- Keep the Chapter 02 preview, lab, and homework submit widgets aligned with the PHP assignment endpoints under `_html_extra/api/v1/`.
