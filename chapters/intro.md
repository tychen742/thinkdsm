# Introduction

These lecture notes are prepared for IST-3420, Introduction to Data Science and Management at Missouri University of Science and Technology (MS&T). The course aims to provide you with a solid foundation in data science concepts and practices, supporting both your future studies and career development.

Major curriculum modules included in this course are:

- Foundation Building: Establishes solid Python/Jupyter programming skills essential for data science work.
- Data Manipulation Core: Covers NumPy and Pandas extensively, as these are the backbone tools for data scientists.
- Visualization Skills: Develops both basic and advanced visualization capabilities for effective data communication.
- Analysis Techniques (Weeks 9-10): Introduces statistical thinking and hypothesis testing crucial for data-driven insights.
- Machine Learning (Weeks 11-13): Covers both supervised and unsupervised learning with practical implementations.

## What is data science?

According to [U.S. Census Bureau](https://www.census.gov/topics/research/data-science.html), data Science is "a field of study that uses scientific methods, processes, and systems to extract knowledge and insights from data." As the Data Science Venn Diagram suggested by [Drew Conway](http://drewconway.com/zia/2013/3/26/the-data-science-venn-diagram), data science is by nature interdisciplinary. Its practitioners draw on varied training in statistics, computing, and domain expertise.

```{figure} ../images/what-is-data-science_conway-2013.png
:width: 275px
:label: my-figure-label
:alt: Data Science Venn Diagram
:align: center

Data Science Venn Diagram
```

## The data science process

As general process model of conducting a data science, the CRoss Industry Standard Process for data mining, known as [CRISP-DM](https://en.wikipedia.org/wiki/Cross-industry_standard_process_for_data_mining), is widely used as a defacto standard process model to describe the common approaches used for data mining and data science projects. 

```{figure} ../images/CRISP-DM_process_diagram.png
---
width: 350px
name: CRISP-DM-process-model
---
CRISP-DM Process Model
```

Also as a methodology, CRISP-DM contains specific generic tasks in each of the phases.
<!-- https://www.datascience-pm.com/crisp-dm-2/#What_are_the_6_CRISP-DM_Phases -->

```{list-table} CRISP-DM tasks in each phase
:header-rows: 1
:label: CRISP-DM-tasks

* - I. Business Understanding
  - II. Data understanding  
  - III. Data Preparation
  - IV. Modeling
  - V. Evaluation
  - VI. Deployment
* - Determine business objectives
  - Collect initial data 
  - Select data
  - Select modeling techniques
  - Evaluate results
  - Plan deployment
* - Assess situation
  - Describe data
  - Select data
  - Generate test design
  - Review process
  - Plan monitoring and maintenance
* - Determine data mining goals
  - Explore data
  - Clean data
  - Build model
  - Determine next steps
  - Produce final report
* - Produce project plan
  - Verify data quality
  - Construct data
  - Assess model 
  - 
  - Review project
* - 
  - 
  - Integrate data
  -
  -
  -
* -
  - 
  - Format data
  -
  -
  -
```


In the industry, practitioners create their own process models based on the CRISP-DM process model. For example, the right figure below is a general [data science lifecycle](https://www.theiotacademy.co/blog/data-science-lifecycle/) model with added exploratory data analysis (EDA) process. Also, others have proposed different process models to meet the recent development of machine learning (ML) and artificial intelligence (AI). 

```{figure} ../images/general-data-science-lifecycle.png
---
width: 400px
name: general-data-science-lifecycle
---
General data science lifecycle model
```

## Tools

## Careers

```{tableofcontents}

```
