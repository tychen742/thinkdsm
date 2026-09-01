# Chapter 02 Materials

## Purpose

Chapter 02 introduces Python basics for students who are new to programming. It covers syntax, values, variables, control flow, core collections, dictionaries, and functions as preparation for data work in later chapters.

## Source Notebooks

- `0200-python.ipynb` - chapter landing page for Python Basics, with title, overview, video, learning goals, chapter flow, glossary, and overview slide link.
- `0201-py-syntax.ipynb` - input and output, comments, variables, built-in data types, operators, Python keywords, data structures, objects/references/mutability, modules, and packages.
- `0202-control-structures.ipynb` - conditionals, Boolean expressions, `while` loops, `for` loops, sequence iteration, `range()`, `enumerate()`, nested loops, and loop control.
- `0203-lists.ipynb` - list creation, indexing, slicing, modification, operations, functions, methods, strings, objects and values, aliasing, and reading word lists.
- `0206-dictionaries.ipynb` - dictionaries as mappings, dictionary creation, membership, counters, dictionary iteration, lists and dictionaries, and accumulation patterns.
- `0208-functions.ipynb` - built-in functions, user-defined functions, parameters and arguments, function composition, return values, docstrings, repetition, list arguments, scope, stack diagrams, and tracebacks.
- `0204-tuples.ipynb` - tuple material currently present in the folder but not listed in `_toc.yml`.

## Student Assignments

- `assignments/index.ipynb` - assignment landing page.
- `assignments/preview.ipynb` - Chapter 02 server-graded preview quiz (`ch02-preview`) covering glossary and core terms in multiple-choice form.
- `assignments/lab.ipynb` - Chapter 02 server-graded lab (`ch02-lab`) with Python practice on expressions, conditionals, list methods and indexing, loops, dictionaries, and functions.
- `assignments/homework.ipynb` - Chapter 02 server-graded homework (`ch02-homework`) with five true/false questions and five coding questions covering type conversion, lists, conditionals, loops, dictionaries, and functions.

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

- Reusable diagram helpers are imported from `shared/diagram.py`.
- Reusable notebook helpers are imported from `shared/thinkpython.py` and `shared/jupyturtle.py` where needed.
- Word-list examples read `data/words.txt` from the project root.
- Chapter 02 does not require chapter-local runnable source files or data files.

## Maintenance Notes

- `0204-tuples.ipynb` exists but is not part of the current table of contents. Do not add it to the live sequence without a separate structure decision.
- Keep Chapter 02 assignments aligned with the assignment release and answer-visibility rules in `AGENTS.md`.
- Keep the Chapter 02 preview, lab, and homework submit widgets aligned with the PHP assignment endpoints under `_html_extra/api/v1/`.
