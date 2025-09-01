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


## if,elif, else Statements

```{code-cell} ipython3
if 1 < 2:
    print('Yep!')
```

```{code-cell} ipython3
if 1 < 2:
    print('yep!')
```

```{code-cell} ipython3
if 1 < 2:
    print('first')
else:
    print('last')
```

```{code-cell} ipython3
if 1 > 2:
    print('first')
else:
    print('last')
```

```{code-cell} ipython3
if 1 == 2:
    print('first')
elif 3 == 3:
    print('middle')
else:
    print('Last')
```

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