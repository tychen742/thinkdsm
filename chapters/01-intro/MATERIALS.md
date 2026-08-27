# Chapter 01 Materials

## Purpose

Chapter 01 introduces data science, the data science workflow, and basic programming concepts. It orients students to the course before Chapter 02 begins Python basics.

## Source Notebooks

- `0100-intro.ipynb` - chapter landing page with overview, video, learning goals, table of contents, glossary, and slide link.
- `0101-introds.ipynb` - data science overview, domain context, workflow, tools, and roles.
- `0102-programming.ipynb` - programming languages, abstraction, interpreted and compiled execution, expressions, statements, number systems, and character encoding.

## Student Assignments

- `assignments/index.ipynb` - assignment landing page.
- `assignments/preview.ipynb` - Chapter 01 glossary preview quiz with server-side submission.
- `assignments/lab.ipynb` - Chapter 01 applied lab with server-side code-cell submission.
- `assignments/homework.ipynb` - Chapter 01 post-class homework with five concept checks and five short coding questions.

## Figures And Media

- `../../figures/what-is-data-science_conway-2013.png`
- `../../figures/data-science-fields.png`
- `../../figures/CRISP-DM_process_diagram.png`
- `../../figures/general-data-science-lifecycle.png`
- `../../figures/data-science-workflow-and-jobs.png`
- `../../figures/data-science-tools.jpeg`
- `../../figures/expression.jpg`
- `../../figures/ascii-code-chart.png`
- Landing video: `https://www.youtube-nocookie.com/embed/N6BghzuFLIg`
- Programming section video: `https://www.youtube-nocookie.com/embed/-uleG_Vecis`

## Slide Deck

- Source: `_html_extra/chapters/01-intro/overview.md`
- Rendered HTML: `_html_extra/chapters/01-intro/overview.html`

## Supporting Code And Data

- `chapters/01-intro/thinkpython.py` is currently stored in the chapter directory and imported by the programming notebook. This does not match the book-authoring rule that runnable source code belongs under `materials/`, so it should be moved in a separate cleanup with import paths updated and tested.
- No Chapter 01 data directory exists under `materials/01/`.

## Maintenance Notes

- Keep the Chapter 01 preview and lab submit widgets aligned with the PHP endpoints under `_html_extra/api/v1/`.
- Canvas-authenticated submissions should not show the manual SIS Login ID block.
- The lab submit widget collects the first five `thebe-interactive` code cells and posts them to `_html_extra/api/v1/lab-attempts.php`; the backend grades those cells with `_html_extra/api/lib/python_lab_runner.py`.
