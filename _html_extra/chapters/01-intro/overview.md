---
marp: true
theme: default
paginate: true
style: |
  section {
    font-family: 'Segoe UI', system-ui, sans-serif;
    font-size: 20px;
    color: #1a1a1a;
    padding: 30px 50px 60px 50px;
    background: white;
  }
  h1 { color: #2a6b37; font-size: 1.8em; border-bottom: 3px solid #b8860b; padding-bottom: 8px; margin-bottom: 16px; }
  h2 { color: #2a6b37; font-size: 1.35em; margin-bottom: 10px; }
  h3 { color: #b8860b; font-size: 1.05em; margin-bottom: 6px; }
  ul { margin-left: 1.2em; }
  li { margin-bottom: 4px; line-height: 1.4; }
  section.title {
    background: #2a6b37;
    color: white;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }
  section.title h1 { color: white; border: none; font-size: 2.2em; }
  section.title p { color: #c8e6c9; font-size: 0.95em; }
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
  section.section p { color: #c8e6c9; font-size: 0.95em; }
  .cols { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; align-items: start; }
  .callout { background: #e8f5eb; border-left: 4px solid #2a6b37; border-radius: 4px; padding: 8px 12px; margin: 8px 0; font-size: 0.78em; line-height: 1.35; }
  table { font-size: 0.68em; border-collapse: collapse; width: 100%; }
  th { background: #2a6b37; color: white; padding: 5px 8px; text-align: left; }
  td { padding: 5px 8px; border-bottom: 1px solid #e0e0e0; }
  tr:nth-child(even) td { background: #f7faf7; }
  code { color: #c7254e; background: #f6f8fa; border: 1px solid #e0e0e0; border-radius: 3px; padding: 1px 4px; }
  section::after { color: #aaa; font-size: 0.7em; }
---

<!-- _class: title -->

# Chapter 1: Introduction

Data Science and Programming Foundations

*Sections: Data Science · Programming Concepts*

*← → or Space to navigate · F for fullscreen*

---

<!-- _class: section -->

## Why This Chapter Matters

Data science is a business decision practice and a technical workflow.

---

## Two Big Ideas

<div class="cols">
<div>

**Data science**

- starts from practical questions
- connects data to decisions
- uses statistics, computing, and domain expertise
- communicates results for action

</div>
<div>

**Programming**

- expresses repeatable instructions
- requires precise syntax
- depends on execution models
- represents values as data

</div>
</div>

<div class="callout">

Chapter 1 sets the vocabulary for both the business side and the technical side of the course.

</div>

---

<!-- _class: section -->

## Section 1

Data Science

---

## What Is Data Science?

Data science uses data, computing, statistics, and domain knowledge to answer questions and support decisions.

- **Data**: recorded facts, measurements, or observations
- **Computing**: tools for storing, transforming, and analyzing data
- **Statistics**: reasoning under uncertainty
- **Domain expertise**: knowledge of the business or management context

---

## Data Science Process

Common process models, such as CRISP-DM, organize data science work into phases:

1. Business understanding
2. Data understanding
3. Data preparation
4. Modeling
5. Evaluation
6. Deployment

<div class="callout">

The process starts with a business problem, not with a dataset or a tool.

</div>

---

## Data Science Roles

| Role | Typical Focus |
|---|---|
| Data analyst | Reports, summaries, dashboards, exploratory analysis |
| Data engineer | Data collection, pipelines, storage, and quality |
| Machine learning engineer | Model training, deployment, and monitoring |
| Data scientist | End-to-end analysis, modeling, interpretation, and communication |

---

<!-- _class: section -->

## Section 2

Programming Concepts

---

## Why Programming Is Technical

Programming languages are formal languages.

- They are designed for precise instructions.
- Small syntax differences can change meaning.
- Programs must run through an execution model.
- Values must be represented in computer-readable form.

<div class="callout">

Programming is not just typing commands. It is a structured way to express computation.

</div>

---

## Execution Models

| Model | Basic Idea | Examples |
|---|---|---|
| Interpreted | Run code through an interpreter | Python, JavaScript |
| Compiled | Translate source code before execution | C, C++, Rust |
| Hybrid | Compile to bytecode, then run on a virtual machine | Python, Java, C# |

---

## Programming Constructs

Most programs combine a small set of core constructs:

- **Sequence**: run instructions in order
- **Selection**: choose between alternatives
- **Iteration**: repeat instructions
- **Variables**: store values by name
- **Data types**: define what operations values support
- **Operators**: perform operations on values
- **Arrays or collections**: store multiple values together

---

## Data Representation

Computers store and process data as numeric patterns.

- **Binary** uses 0s and 1s.
- **Bytes** group bits into addressable units.
- **ASCII** maps common English characters to numbers.
- **UTF-8** supports text across many writing systems.

<div class="callout">

Later Python work will be easier if you know that code, numbers, and text all have representations underneath.

</div>

---

## What To Carry Forward

After this chapter, you should be able to:

- frame data science as a decision workflow
- connect roles and tools to stages of that workflow
- explain why programming requires precision
- identify the basic constructs that appear across programming languages
- recognize that computers need formal data representations

---

<!-- _class: title -->

# End of Chapter 1

Next: Chapter 2 — Python Basics
