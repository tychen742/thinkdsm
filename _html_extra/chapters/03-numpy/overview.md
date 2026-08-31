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

# Chapter 3: NumPy Arrays

Numerical arrays for efficient data science work

*Sections: Array basics · Array computation · Random number generation*

*Use arrow keys or Space to navigate · Press F for fullscreen*

---

## Chapter Roadmap

| Part | Main Question | Core Vocabulary |
|---|---|---|
| Array basics | How does NumPy store numerical collections? | array, ndarray, shape, dtype |
| Array computation | How do arrays compute without manual loops? | vectorized operation, ufunc, aggregation |
| Random generation | How can arrays model uncertainty? | generator, seed, sampling, simulation |

<div class="callout">

This chapter bridges basic Python and table-oriented data work by making numerical collections faster and easier to compute with.

</div>

---

## Chapter Goals

By the end of this chapter, you will be able to:

1. Create NumPy arrays and inspect their shape, size, dimension, and data type.
2. Select and reshape array values with indexing, slicing, masks, and shape methods.
3. Apply vectorized operations and universal functions across arrays.
4. Summarize and compare arrays with aggregation, axes, broadcasting, sorting, and fancy indexing.
5. Use random generators for reproducible samples and simple simulations.

---

<!-- _class: section -->

## Array Basics

Creating, inspecting, indexing, and reshaping arrays

---

## Why Arrays?

NumPy arrays are compact numerical collections.

| Python Lists | NumPy Arrays |
|---|---|
| Flexible containers for general objects | Homogeneous containers for numerical work |
| Often require explicit loops | Support whole-array operations |
| Good for mixed small collections | Better for large numerical datasets |

```python
sales = np.array([340, 280, 410])
sales.shape
```

---

<!-- _class: section -->

## Array Computation

Vectorized operations, ufuncs, aggregation, and broadcasting

---

## Computing With Whole Arrays

Vectorized operations move repetitive work into NumPy's optimized layer.

```python
prices = np.array([10, 12, 15])
quantities = np.array([4, 3, 2])
revenue = prices * quantities
```

- Element-wise operations apply to corresponding values.
- Universal functions provide fast reusable operations.
- Aggregations summarize arrays into totals, averages, or extrema.
- Broadcasting combines compatible shapes without manual repetition.

---

<!-- _class: section -->

## Random Number Generation

Sampling and simulation with reproducible random values

---

## Modeling Uncertainty

Random generators help analysts explore possible outcomes.

```python
rng = np.random.default_rng(42)
daily_demand = rng.normal(120, 15, size=30)
daily_demand.mean()
```

| Concept | Why It Matters |
|---|---|
| Seed | Makes a random sequence reproducible. |
| Generator | Keeps random state explicit and local. |
| Sampling | Draws values from data or a distribution. |
| Simulation | Repeats random draws to study uncertainty. |

---

## Chapter 3 Vocabulary

| # | Term | Short Meaning |
|---:|---|---|
| 1 | ndarray | NumPy's N-dimensional array object. |
| 2 | Shape | Length along each array axis. |
| 3 | dtype | Data type used to store array values. |
| 4 | Vectorized operation | Whole-array computation without explicit Python loops. |
| 5 | Universal function | Fast NumPy function applied element by element. |
| 6 | Broadcasting | Combining compatible arrays with different shapes. |
| 7 | Boolean mask | True/False array used to filter another array. |
| 8 | Aggregation | Summary calculation over many values. |
| 9 | Seed | Starting value for reproducible random output. |
| 10 | Simulation | Random modeling of possible outcomes. |

---

## What To Carry Forward

After this chapter, students should be ready to:

- Recognize when numerical data should become an array.
- Replace simple Python loops with vectorized array operations.
- Use random samples to reason about uncertainty.
- Bring NumPy habits into pandas, visualization, and statistics chapters.

---

## Carry Forward

- Use the section practice exercises to check runnable code skills.
