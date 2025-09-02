---
jupytext:
#   cell_metadata_filter: -all
  formats: md:myst
  text_representation:
    extension: .md
    format_name: myst
    format_version: 0.13
    jupytext_version: 1.17.2
  formats: md:myst
kernelspec:
  name: python3
  language: python
display_name: Python (ipykernel)
---

# Control Structures

The three fundamental control structures in computer programming, dictating the order in which instructions are executed within a program are:

1. Sequence logic (sequential flow)
2. Selection logic (conditional flow)
3. Iteration logic (repetitive flow)

As a fundamental concept, programming languages executes statements sequentially by default. Lines of instructions are executed in defined order unless control structures (conditional statements), loops (for, while), or flow controls (break, continue, return, and exceptions) alter the sequential processing flow. 

Functions encapsulate reusable behavior, accept positional and keyword parameters, return values, and create local scope 
and modular design; 

Together, sequential execution, control structures, and functions let you decompose problems, control when and how operations run, avoid repetition, and express complex logic clearly and testably.



## for Loops

```{code-cell} ipython3
seq = [1,2,3,4,5]
```

```{code-cell} ipython3
for item in seq:
    print(item)
```

```{code-cell} ipython3
for item in seq:
    print('Yep')
```

```{code-cell} ipython3
for jelly in seq:
    print(jelly+jelly)
```

## while Loops

```{code-cell} ipython3
i = 1
while i < 5:
    print('i is: {}'.format(i))
    i = i+1
```

```{code-cell} ipython3

```

```{bibliography}

```
