# Python Data Collections

Python’s data collections are the built‑in container types you use to store, organize, and operate on groups of values. The four main collection types are: 
- lists, which are ordered, changeable, and allow duplicates; 
- tuples, which are ordered and unchangeable, making them useful for fixed data; 
- sets, which are unordered, do not allow duplicates, and are great for membership testing; and 
- dictionaries, which store data as key–value pairs, allowing fast lookups and flexible data mapping.

```{list-table} Python Data Collections
:header-rows: 1
:name: python-data-collections
:header-rows: 1

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
```
*Since Python 3.6+, dictionaries preserve insertion order, but logically unordered.

Python data collections let you: 
- model data naturally (ordered records, lookup tables, unique elements), 
- support iteration and common algorithms,
- use methods for adding, removing, searching, and transforming data. 

