---
marp: true
theme: default
paginate: true
title: Chapter 04 - Pandas
---

# Pandas

Chapter 04 overview

Think Data Science & Management

---

## Chapter Roadmap

1. Pandas Series
2. Handling datasets
3. DataFrames
4. Missing data
5. Data operations

---

## Chapter Goals

- Explain how Series and DataFrames organize labeled business data
- Load CSV, Excel, HTML, and SQL data sources
- Inspect rows, columns, indexes, data types, shape, and summaries
- Select, filter, transform, sort, aggregate, and combine table values
- Detect, interpret, drop, and fill missing values

---

## Why Pandas

Pandas gives Python a practical table workflow.

- Rows represent records
- Columns represent variables
- Labels make code easier to read
- Methods support repeatable analysis

---

## Series

A Series is a one-dimensional labeled object.

Use a Series when one column or one measured quantity needs labels, data types, and pandas operations.

---

## DataFrames

A DataFrame is a two-dimensional table.

DataFrames are the main pandas object for management data because they can hold customer records, sales transactions, survey responses, and operational metrics.

---

## Loading Data

Pandas can read common business data sources.

- CSV files
- Excel files
- HTML tables
- SQL query results

---

## Inspecting Tables

Before analysis, inspect the data.

- `head()` and `tail()`
- `shape`
- `info()`
- `describe()`
- column names and data types

---

## Missing Data

Missing values need interpretation before treatment.

- `NaN` often marks missing numerical values
- `pd.NA` supports nullable pandas dtypes
- `isna()` detects missing values
- `dropna()` removes incomplete rows or columns
- `fillna()` replaces missing values

---

## Data Operations

Common analysis workflows combine smaller table operations.

- Select and filter rows
- Sort records
- Group and aggregate
- Concatenate compatible tables
- Merge or join related tables

---

## Chapter 4 Vocabulary

Series, DataFrame, Index, dtype, CSV file, Excel file, `read_csv()`, `head()`, `info()`, `describe()`, `loc`, `iloc`, Boolean indexing, missing data, `NaN`, `pd.NA`, `isna()`, `dropna()`, `fillna()`, `GroupBy`, aggregation, `merge()`.

---

## What To Carry Forward

Pandas turns raw table files into inspectable, cleanable, and analyzable data objects.

That workflow supports the visualization, statistics, and modeling chapters that follow.

---

## Carry Forward

- Use the section practice exercises to check runnable code skills.
