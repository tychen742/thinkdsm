---
marp: true
theme: default
paginate: true
style: |
  section {
    font-family: 'Segoe UI', system-ui, sans-serif;
    font-size: 22px;
    color: #1a1a1a;
    padding: 34px 48px 58px 48px;
    background: white;
  }
  h1 { color: #2a6b37; font-size: 1.8em; border-bottom: 3px solid #b8860b; padding-bottom: 8px; margin-bottom: 14px; }
  h2 { color: #2a6b37; font-size: 1.28em; margin-bottom: 10px; }
  ul, ol { margin-left: 1.15em; }
  li { margin-bottom: 6px; line-height: 1.35; }
  p { line-height: 1.35; }
  section.title {
    background: #2a6b37;
    color: white;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }
  section.title h1 { color: white; border: none; font-size: 2.15em; }
  section.title p { color: #d7ecd9; font-size: 0.95em; }
  section.section {
    background: #2a6b37;
    color: white;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }
  section.section h2 { color: white; border: none; font-size: 1.9em; }
  section.section p { color: #d7ecd9; font-size: 0.95em; }
  .callout { background: #e8f5eb; border-left: 4px solid #2a6b37; border-radius: 4px; padding: 8px 12px; margin: 8px 0; font-size: 0.84em; line-height: 1.35; }
  table { display: table; font-size: 0.78em; border-collapse: collapse; width: 100%; }
  th { background: #2a6b37; color: white; padding: 6px 8px; text-align: left; }
  td { padding: 6px 8px; border-bottom: 1px solid #e0e0e0; vertical-align: top; }
  tr:nth-child(even) td { background: #f7faf7; }
  code { color: #c7254e; background: #f6f8fa; border: 1px solid #e0e0e0; border-radius: 3px; padding: 1px 4px; }
---

<!-- _class: title -->

# Chapter 2: Python Basics

Practical programming foundations for data science and management

*Sections: Syntax · Control structures · Lists · Dictionaries · Functions*

*Use arrow keys or Space to navigate · Press F for fullscreen*

---

## Chapter Roadmap

| Part | Main Question | Core Vocabulary |
|---|---|---|
| Syntax | How do you write valid Python statements? | value, variable, object, type, operator |
| Control | How do programs choose and repeat actions? | Boolean expression, conditional, loop |
| Collections | How do you organize many related values? | list, index, slice, dictionary, key |
| Functions | How do you make work reusable? | function, parameter, argument, return value |

<div class="callout">

This chapter gives you the Python vocabulary and mechanics needed before NumPy, pandas, visualization, and statistical simulations.

</div>

---

## Chapter Goals

By the end of this chapter, you will be able to:

1. Write and run simple Python statements with correct syntax, variables, objects, types, and operators.
2. Use conditionals and Boolean expressions to represent business rules.
3. Use `while` and `for` loops to repeat work over counts, conditions, and collections.
4. Work with lists and dictionaries to organize, access, modify, and count data values.
5. Define, call, and debug functions with parameters, return values, docstrings, scope, and tracebacks.

---

<!-- _class: section -->

## Python Syntax

Values, variables, types, operators, and collections

---

## Syntax For Data Work

Python syntax lets you express small management calculations clearly:

- Store values with variable names.
- Combine numbers and text with operators and functions.
- Convert values when imported data arrives as the wrong type.
- Use comments and names to make code readable.

```python
revenue = 1250
cost = 875
margin = revenue - cost
```

---

<!-- _class: section -->

## Control Structures

Conditionals and loops

---

## Decisions And Repetition

Control structures let Python apply business rules repeatedly.

| Structure | Use It When |
|---|---|
| `if` statement | A decision depends on a condition. |
| `while` loop | Work repeats until a condition changes. |
| `for` loop | Work repeats once for each item in a collection. |
| `break` or `continue` | A loop needs explicit control. |

---

<!-- _class: section -->

## Lists And Dictionaries

Collections for repeated values and mappings

---

## Organizing Business Values

Lists keep ordered values. Dictionaries connect keys to values.

```python
sales = [340, 280, 410]
region_counts = {"East": 12, "West": 9}
```

- Use lists for ordered sequences such as daily sales, survey ratings, or customer names.
- Use dictionaries for mappings such as department counts, product prices, or employee records.
- Use loops to accumulate totals, counts, and summaries.

---

<!-- _class: section -->

## Functions

Reusable work with clear inputs and outputs

---

## Why Functions Matter

Functions help analysts avoid repeated code and make calculations easier to inspect.

```python
def calculate_margin(revenue, cost):
    return revenue - cost
```

Good functions:

- Have clear names.
- Use parameters for inputs.
- Return useful results.
- Include docstrings when the purpose is not obvious.

---

## Reading Errors

Python error messages are part of the workflow, not a sign that analysis has failed.

| Error Signal | What To Check |
|---|---|
| `NameError` | Was the variable assigned before it was used? |
| `TypeError` | Did the operation receive the wrong kind of value? |
| `IndexError` | Did the code ask for a list position that does not exist? |
| Traceback | Which line caused the exception? |

<div class="callout">

Debugging starts with reading the traceback from the bottom up, then checking the line where Python reported the error.

</div>
