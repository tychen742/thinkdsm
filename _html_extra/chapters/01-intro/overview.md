---
marp: true
theme: default
paginate: true
style: |
  section {
    font-family: 'Segoe UI', system-ui, sans-serif;
    font-size: 20px;
    color: #1a1a1a;
    padding: 28px 46px 58px 46px;
    background: white;
  }
  h1 { color: #2a6b37; font-size: 1.75em; border-bottom: 3px solid #b8860b; padding-bottom: 8px; margin-bottom: 14px; }
  h2 { color: #2a6b37; font-size: 1.28em; margin-bottom: 10px; }
  h3 { color: #b8860b; font-size: 1em; margin-bottom: 6px; }
  ul, ol { margin-left: 1.15em; }
  li { margin-bottom: 4px; line-height: 1.35; }
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
  .cols { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; align-items: start; }
  .wide-cols { display: grid; grid-template-columns: 1.15fr 0.85fr; gap: 20px; align-items: center; }
  .callout { background: #e8f5eb; border-left: 4px solid #2a6b37; border-radius: 4px; padding: 8px 12px; margin: 8px 0; font-size: 0.78em; line-height: 1.35; }
  .small { font-size: 0.78em; }
  .figure { display: block; max-width: 100%; max-height: 450px; margin: 8px auto; object-fit: contain; }
  .figure-tight { display: block; max-width: 100%; max-height: 380px; margin: 6px auto; object-fit: contain; }
  .figure-tall { display: block; max-width: 82%; max-height: 500px; margin: 6px auto; object-fit: contain; }
  table { display: table; font-size: 0.64em; border-collapse: collapse; width: 100%; position: relative; z-index: 2; }
  th { background: #2a6b37; color: white; padding: 5px 7px; text-align: left; }
  td { padding: 5px 7px; border-bottom: 1px solid #e0e0e0; vertical-align: top; }
  tr:nth-child(even) td { background: #f7faf7; }
  code { color: #c7254e; background: #f6f8fa; border: 1px solid #e0e0e0; border-radius: 3px; padding: 1px 4px; }
  pre { font-size: 0.58em; line-height: 1.22; }
  section::after { color: #999; font-size: 0.68em; }
---

<!-- _class: title -->

# Chapter 1: Introduction

Data Science and Programming Foundations

*Sections: Data Science · On Programming*

*Use arrow keys or Space to navigate · Press F for fullscreen*

---

## Chapter Roadmap

| Part | Main Question | Core Vocabulary |
|---|---|---|
| Data Science | How do organizations turn data into decisions? | data, domain expertise, workflow, analytics, AI |
| Programming | How do people give precise instructions to computers? | formal language, syntax, interpreter, compiler, variable |
| Representation | How do computers store numbers and text? | binary, byte, ASCII, UTF-8 |

<div class="callout">

This chapter gives students the vocabulary needed before they start writing Python programs in Chapter 2.

</div>

---

<!-- _class: section -->

## Section 1

Data Science

---

## Why Data Science?

Data science matters because organizations increasingly make decisions through data-backed processes.

| Reason | What It Means for Management Students |
|---|---|
| Job market demand | Data roles appear across technology, health care, finance, retail, and government. |
| Transferable skills | Statistical reasoning, coding, and problem solving move across industries. |
| Better decisions | Data analysis reduces guesswork and supports evidence-based management. |
| Foundation for AI | Machine learning and generative AI build on data science workflows. |

---

## What Is Data Science?

<div class="wide-cols">
<div>

Data science combines multiple areas of expertise:

- **Data**: recorded facts, measurements, or observations.
- **Computing**: tools for storage, transformation, and analysis.
- **Statistics**: reasoning under uncertainty.
- **Domain expertise**: knowledge of the business context.

</div>
<div>

<img src="../../_images/what-is-data-science_conway-2013.png" alt="Data Science Venn Diagram" class="figure-tight">

</div>
</div>

---

## Data Science Is Interdisciplinary

<img src="../../_images/data-science-fields.png" alt="Data Science Fields" class="figure">

<div class="callout">

Data science overlaps with business analytics, data analytics, machine learning, artificial intelligence, and business intelligence.

</div>

---

## Reading the Field Map

| Layer | Examples | Main Focus |
|---|---|---|
| Business layer | Business analytics, business intelligence | Decisions, reports, dashboards, and organizational questions. |
| Data layer | Data analytics, data science | Data preparation, exploration, modeling, and interpretation. |
| AI layer | Machine learning, deep learning, generative AI | Prediction, automation, and intelligent systems. |

<div class="callout">

For this course, the management question comes first. The tool is chosen after the question is clear.

</div>

---

## Evolution of Data Fields

| Era | Key Technologies and Developments | Analytics Type |
|---|---|---|
| 1970s | Relational databases, SQL, Decision Support Systems | Descriptive and decision support |
| 1980s | OLTP systems, data modeling, Executive Information Systems | Descriptive reporting |
| 1990s | Data warehousing, OLAP, business intelligence, data mining | Descriptive and diagnostic |
| 2000s | Dashboards, KPIs, and business analytics | Descriptive, diagnostic, early predictive |
| 2010s | Data science, machine learning, end-to-end workflows | Predictive and prescriptive |
| 2020s | Responsible AI and generative AI | Predictive and prescriptive |

---

## Analytics Phases

| Question Type | Example Management Question | Common Output |
|---|---|---|
| Descriptive | What happened last quarter? | Dashboard, KPI report, summary table |
| Diagnostic | Why did sales drop in one region? | Drill-down analysis, comparison |
| Predictive | Which customers may churn next month? | Forecast, probability, model score |
| Prescriptive | What action should the team take? | Recommendation, decision rule |

---

## CRISP-DM Process

<div class="wide-cols">
<div>

The Cross-Industry Standard Process for Data Mining organizes projects into six phases:

1. Business understanding
2. Data understanding
3. Data preparation
4. Modeling
5. Evaluation
6. Deployment

</div>
<div>

<img src="../../_images/CRISP-DM_process_diagram.png" alt="CRISP-DM Process Model" class="figure-tight">

</div>
</div>

---

## CRISP-DM Tasks

| Business Understanding | Data Understanding | Data Preparation | Modeling | Evaluation | Deployment |
|---|---|---|---|---|---|
| Determine objectives | Collect initial data | Select data | Select techniques | Evaluate results | Plan deployment |
| Assess situation | Describe data | Clean data | Generate test design | Review process | Plan monitoring |
| Define data mining goals | Explore data | Construct data | Build model | Decide next steps | Produce report |
| Produce project plan | Verify quality | Integrate and format data | Assess model |  | Review project |

---

## General Data Science Lifecycle

<img src="../../_images/general-data-science-lifecycle.png" alt="General data science lifecycle model" class="figure">

<div class="callout">

Many organizations customize CRISP-DM, but most workflows still move from business questions to data, modeling, evaluation, and deployment.

</div>

---

## Careers Across the Workflow

<img src="../../_images/data-science-workflow-and-jobs.png" alt="Data science workflow and related job titles" class="figure">

---

## Common Data Roles

| Role | Common Work | Course Connection |
|---|---|---|
| Data analyst | Reports, summaries, dashboards, exploratory analysis | Tables, charts, basic statistics |
| Data engineer | Data collection, pipelines, storage, and quality | Databases and data management |
| Machine learning engineer | Model training, deployment, and monitoring | Predictive modeling and evaluation |
| Data scientist | End-to-end analysis, modeling, interpretation, and communication | Full data science workflow |

---

## Data Science Tools

<img src="../../_images/data-science-tools.jpeg" alt="Data Science Tools" class="figure">

---

## Tool Categories

| Category | Typical Tools | Main Purpose |
|---|---|---|
| Data management | SQL databases, MongoDB, Redis, Neo4j | Store, collect, and organize data. |
| Data manipulation | Python, R, pandas, NumPy | Clean, reshape, and transform data. |
| Data analysis | scikit-learn, PyTorch, TensorFlow | Fit models and analyze patterns. |
| Visualization | Matplotlib, Seaborn, dashboards | Communicate results clearly. |
| Environment | Jupyter Notebook and related tools | Combine code, notes, output, and explanation. |

---

<!-- _class: section -->

## Section 2

On Programming

---

## Why Programming Belongs Here

Programming is the technical language used to express data work precisely.

- A program gives the computer instructions.
- A programming language has formal rules.
- A small syntax mistake can change meaning or stop execution.
- Python is the course language, but the core ideas apply broadly.

<div class="callout">

Students are not just learning Python syntax. They are learning how computational instructions are structured.

</div>

---

## Natural vs. Formal Languages

| Feature | Natural Language | Formal Language |
|---|---|---|
| Main use | Human communication | Precise computation or notation |
| Ambiguity | Often ambiguous and context-dependent | Designed to be unambiguous |
| Redundancy | Often verbose to reduce misunderstanding | Usually concise |
| Literalness | Allows idioms and metaphors | Means exactly what it says |
| Examples | English, Spanish, French | Python, SQL, mathematical notation |

---

## Levels of Abstraction

| Level | Description | Examples | Code Example |
|---|---|---|---|
| High-level language | Close to human-readable language | Python, Java, JavaScript, C, C++ | `print("Hello, World!")` |
| Low-level language | Close to machine operations | Assembly language | `mov eax, 1` |
| Machine code | Binary instructions executed by the CPU | 0s and 1s | `10110000 00000000` |

<div class="callout">

Python hides many hardware details so beginners can focus on computational thinking.

</div>

---

## Execution Models

| Model | Basic Idea | Examples |
|---|---|---|
| Interpreted | Run code through an interpreter. | Python, JavaScript |
| Compiled | Translate source code before execution. | C, C++, Rust |
| Hybrid | Compile to bytecode, then run on a virtual machine. | Python, Java, C# |

---

## Execution Diagrams

```text
Interpreter Execution
┌───────────┐   ┌───────────┐   ┌──────┐
│Source Code│ → │Interpreter│ → │Output│
└───────────┘   └───────────┘   └──────┘

Compiler Execution
┌───────────┐   ┌────────┐   ┌───────────┐   ┌──────┐
│Source Code│ → │Compiler│ → │Object Code│ → │Output│
└───────────┘   └────────┘   └───────────┘   └──────┘

Python (CPython) Execution
┌─────────┐   ┌────────┐   ┌──────────┐   ┌─────┐   ┌──────┐
│script.py│ → │Compiler│ → │Bytecode  │ → │ PVM │ → │Output│
└─────────┘   └────────┘   │  (.pyc)  │   └─────┘   └──────┘
                           └──────────┘
```

<div class="callout">

Python is often described as interpreted, but modern Python also compiles code to bytecode before the Python virtual machine runs it.

</div>

---

## Programming Constructs

| Construct | Meaning |
|---|---|
| Sequence | Run instructions one after another. |
| Selection | Choose between alternative paths. |
| Iteration | Repeat instructions. |
| Subroutine | Group instructions into a function or method. |
| Variable | Store a value using a name. |
| Data type | Define the kind of value and the operations it supports. |
| Operator | Perform an operation on one or more values. |

---

## Expressions and Statements

<div class="wide-cols">
<div>

An **expression** produces a value.

A **statement** performs an action.

| Type | Example | Result |
|---|---|---|
| Expression | `2 + 3` | Produces `5` |
| Expression | `x * y` | Produces a value |
| Statement | `x = 5` | Changes program state |
| Statement | `print(x)` | Displays output |

</div>
<div>

<img src="../../_images/expression.jpg" alt="Expression, Operand, and Operator" class="figure-tight">

</div>
</div>

---

## Number Systems

Computers store and process data in binary, but programmers use several number systems.

| System | Base | Digits Used | Typical Use | Python Example |
|---|---:|---|---|---|
| Binary | 2 | 0-1 | Hardware, memory, bitwise operations | `0b1100100` |
| Octal | 8 | 0-7 | Unix file permissions | `0o144` |
| Decimal | 10 | 0-9 | Human-friendly math | `100` |
| Hexadecimal | 16 | 0-9, A-F | Memory, colors, debugging | `0x64` |

---

## Positional Notation

Each digit's value depends on its position and the base.

| Digit | Position | Calculation | Value |
|---:|---:|---|---:|
| 3 | 2 | `3 x 10^2` | 300 |
| 4 | 1 | `4 x 10^1` | 40 |
| 5 | 0 | `5 x 10^0` | 5 |
|  |  | Total | 345 |

```text
digit value = digit x (base ^ position)
```

---

## Decimal to Binary Example

The decimal number `100` is equal to binary `1100100`.

```text
0b1100100
  ││││││└ 0 x 2^0 = 0
  │││││└─ 0 x 2^1 = 0
  ││││└── 1 x 2^2 = 4
  │││└─── 0 x 2^3 = 0
  ││└──── 0 x 2^4 = 0
  │└───── 1 x 2^5 = 32
  └────── 1 x 2^6 = 64
                           100
```

---

## Character Encoding

Computers need a mapping between characters and numbers.

| Term | Meaning |
|---|---|
| Bit | The smallest unit of data, either 0 or 1. |
| Byte | A group of 8 bits. |
| ASCII | An early character encoding for English letters, digits, and symbols. |
| Unicode | A standard for representing text across writing systems. |
| UTF-8 | A dominant Unicode encoding used across the web and modern systems. |

---

## ASCII Example

<img src="../../_images/ascii-code-chart.png" alt="ASCII Code Chart 1972" class="figure">

<div class="callout">

The letter `A` is represented as decimal `65`, which is binary `0b1000001`.

</div>

---

## Chapter 1 Vocabulary: Data Work

| # | Term | Short Meaning |
|---:|---|---|
| 1 | Data science | Uses data, computing, statistics, and domain knowledge for decisions. |
| 2 | Data | Recorded facts, measurements, observations, or values. |
| 3 | Domain expertise | Knowledge of the business or management context. |
| 4 | Business analytics | Data analysis used to support business decisions. |
| 5 | Business intelligence | Reports and dashboards for monitoring performance. |
| 6 | Data analytics | Cleaning, inspecting, transforming, and interpreting data. |
| 7 | Machine learning | Learning patterns from data for prediction or automation. |
| 8 | Artificial intelligence | Systems that perform tasks associated with human intelligence. |
| 9 | CRISP-DM | A process model for data science and data mining projects. |
| 10 | Data preparation | Cleaning and shaping data before analysis or modeling. |
| 11 | Modeling | Building a representation of patterns in data. |
| 12 | Deployment | Putting results, reports, or models into practical use. |

---

## Chapter 1 Vocabulary: Roles and Code

| # | Term | Short Meaning |
|---:|---|---|
| 13 | Data engineer | Builds and maintains data pipelines and infrastructure. |
| 14 | Data analyst | Explores data, reports patterns, and communicates findings. |
| 15 | Machine learning engineer | Builds and deploys machine learning systems. |
| 16 | Data scientist | Works across problem framing, analysis, modeling, and communication. |
| 17 | Programming | Writing precise instructions that a computer can execute. |
| 18 | Algorithm | A step-by-step procedure for solving a problem. |
| 19 | Natural language | Everyday human language such as English or Spanish. |
| 20 | Formal language | A language with precise rules for a specific purpose. |
| 21 | Syntax | Formal rules for writing statements. |
| 22 | Interpreter | Runs source code by translating and executing it. |
| 23 | Compiler | Translates source code into another form before execution. |
| 24 | Bytecode | Intermediate code that can run on a virtual machine. |

---

## Chapter 1 Vocabulary: Program Building Blocks

| # | Term | Short Meaning |
|---:|---|---|
| 25 | Sequence | Instructions run one after another. |
| 26 | Selection | A program chooses between alternative paths. |
| 27 | Iteration | Repetition, usually controlled by a loop. |
| 28 | Variable | A named storage location for a value. |
| 29 | Data type | A value classification that shapes allowed operations. |
| 30 | Operator | A symbol that performs an operation. |
| 31 | Expression | Code that evaluates to a value. |
| 32 | Statement | Code that performs an action or controls flow. |
| 33 | Binary | A base-2 number system using 0 and 1. |
| 34 | Hexadecimal | A base-16 number system used in computing contexts. |
| 35 | Bit | The smallest unit of data, either 0 or 1. |
| 36 | Byte | A group of 8 bits. |
| 37 | Character encoding | A mapping between text characters and numeric values. |
| 38 | ASCII | An early English-focused character encoding. |
| 39 | Unicode | A standard for representing text across writing systems. |
| 40 | UTF-8 | A dominant Unicode encoding used on the web. |

---

## Practice Path

| Practice Type | Purpose | Chapter 1 Examples |
|---|---|---|
| Section exercises | Practice one concept immediately after it is introduced. | Formal languages, abstraction levels, execution models, constructs, expressions, number systems, encoding |
| Lab questions | Extend and combine section exercises. | Data workflow variables, tool categories, base conversion, arithmetic expressions, character encoding |
| Homework | Reinforce the chapter after class. | Review, application, and reflection |

<div class="callout">

Lab questions should build from section exercises, so students practice first and then combine ideas in a longer assignment.

</div>

---

## What To Carry Forward

After this chapter, you should be able to:

- Frame data science as a decision workflow.
- Connect roles and tools to stages of that workflow.
- Explain why programming requires precision.
- Distinguish expressions from statements.
- Convert simple decimal numbers to binary.
- Explain why text needs character encoding.

---

<!-- _class: title -->

# End of Chapter 1

Next: Chapter 2, Python Basics
