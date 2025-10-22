# Data Collections

Python’s data collections are the built‑in container types you use to store, organize, and operate on groups of values. The four main collection types are: `list`, `tuple`, `dictionary`, and `set`. 

Also, strings are considered a sequence type (a kind of collection) because they behave like collections of characters, although conceptually, strings are considered primitives, not collections, in many languages other than Python. 

`range`, is debatable as a "collection"; it's really a lazy sequence generator, not a traditional data structure. It does like a sequence, so Python treats it as one. Note that `range` stores a formula, not data; it computes values on-demand. Therefore, `range` is a sequence protocol implementer, not a data container. 

## Collection Types

Here is a summary of the commonly used data collection types.

| Type      | Literal           | Mutable   | Ordered | Usage                                   |
| --------- | -----------       | --------: | ------: | --------------------------------------- |
| **list**  | `[1, 2, 3]`       | Yes       | Yes     | General, grow/shrink, index/slice.      |
| **tuple** | `(1, 2, 3)`       | No        | Yes     | Fixed records; hashable if elements are.|
| **dict**  | `{"a": 1, "b": 2}`| Yes (3.7+)| Yes     | Key-value mapping.                      |
| **set**   | `{1, 2, 3}`       | Yes       | No      | Unique items, math set ops.             |
| **frozenset** | `frozenset({1,2})` | No   | No      | Hashable set (e.g., dict keys).         |
| **range** | `range(10)`       | No        | Yes     | Lazy integer sequence.                  |
| **str**   | `"hi"`            | No        | Yes     | Text                       |


## Sequence Types

There are three basic sequence types: `list`, `tuple`, and `range` objects. 

<!-- ```{list-table} Python Data Collections
:header-rows: 1
:name: python-data-collections
:header-rows: 1
``` -->
<!-- 
* - Collection
  - Ordered
  - Mutable
  - Allows Duplicates
  - Key–Value Pairs
* - **List**
  - Yes
  - Yes
  - Yes
  - No
* - **Tuple**
  - Yes
  - No
  - Yes
  - No
* - **Set**
  - No
  - Yes
  - No
  - No
* - **Dictionary**
  - No<sup>*</sup>
  - Yes
  - Keys: No  
    Values: Yes
  - Yes
``` -->

*Since Python 3.7+, dictionaries preserve insertion order, but logically unordered.

Python data collections let you: 
- model data naturally (ordered records, lookup tables, unique elements), 
- support iteration and common algorithms,
- use methods for adding, removing, searching, and transforming data. 

