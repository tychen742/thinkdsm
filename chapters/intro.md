# Introduction

These lecture notes are prepared for IST-3420, Introduction to Data Science and Management at Missouri University of Science and Technology (MS&T). The course aims to provide you with a solid foundation in data science concepts and practices, supporting both your future studies and career development.

Major curriculum modules included in this course are:

- Foundation Building: Establishes solid Python/Jupyter programming skills essential for data science work.
- Data Manipulation Core: Covers NumPy and Pandas extensively, as these are the backbone tools for data scientists.
- Visualization Skills: Develops both basic and advanced visualization capabilities for effective data communication.
- Analysis Techniques (Weeks 9-10): Introduces statistical thinking and hypothesis testing crucial for data-driven insights.
- Machine Learning (Weeks 11-13): Covers both supervised and unsupervised learning with practical implementations.

## 1. What is Data Science?

According to [U.S. Census Bureau](https://www.census.gov/topics/research/data-science.html), data Science is "a field of study that uses scientific methods, processes, and systems to extract knowledge and insights from data." As the Data Science Venn Diagram suggested by [Drew Conway](http://drewconway.com/zia/2013/3/26/the-data-science-venn-diagram), data science is by nature interdisciplinary. Its practitioners draw on varied training in statistics, computing, and domain expertise.

```{figure} ../images/what-is-data-science_conway-2013.png
:width: 275px
:label: my-figure-label
:alt: Data Science Venn Diagram
:align: center

Data Science Venn Diagram
```
If we put the [related data work fields](https://365datascience.com/trending/data-science-vs-ml-vs-data-analytics/) together, we can see that the data science (broadly defined) fields overlap with each other: 

```{figure} ../images/data-science-fields.png
:width: 750px
:label: data-science-fields
:name: data-science-fields
:alt: Data Science Fields
:align: center

Data Science Fields
```

From {numref}`data-science-fields` we can try to define data science by looking at how it relates to other fields. The figure can be understood as having 3 layers: The business layer (dark green), the data layer (light green), and the machine learning/AI layer (purple). We may observe that: 
1. Data science consists most of the fields of data analytics and machine learning.
2. Data science also has huge overlap with business analytics.
3. Data science can be considered as a subset of data analytics, just like machine learning. 
4. Business intelligence almost can be considered as a subset of data science with heavy business applications. 
5. AI may be considered as extension of machine learning (but still have certain overlap with data science).  


## 2. The Data Science Process
### 2.1 The CRISP-DM model
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

### 2.2. General Data Science Lifecycle Models
In the industry, practitioners create their own process models based on the CRISP-DM process model. For example, the right figure below is a general [data science lifecycle](https://www.theiotacademy.co/blog/data-science-lifecycle/) model with added exploratory data analysis (EDA) process. 

```{figure} ../images/general-data-science-lifecycle.png
---
width: 450px
name: general-data-science-lifecycle
---
General data science lifecycle model
```

<!-- ## Tools -->

## 3. Data Science Careers 
There are plenty of jobs and career opportunities in the general field of data science. From the perspective of data science workflow/lifecycle, we see that the four common data science related jobs roughly correspond with different phases of the workflow/lifecycle: Data Engineers with data collection and cleaning/cleansing, data analysts with data cleaning and EDA, machine learning engineers for model building and model deployment, while data scientists for the whole process of the workflow/lifecycle. 

```{figure} ../images/data-science-workflow-and-jobs.png
---
width: 500px
name: data-science-lifecycle-and-jobs
---
Data science workflow and related job titles
```

As technology advances, AI has become central to modern data work and is now foundational across the data stack. A quick search at an online job site (indeed.com) using the term "data scientists" yields job titles showing that data science and AI are interconnect: 
1. Generative AI/ML Data Scientist
2. Senior Agentic AI Data Scientist 
3. Manager, Data Science - GenAI Digital Assistant
4. Senior Advanced AI Software Engineer
5. Data Scientist Lead - Bank AI/ML

When searching for related job titles, the results show that the term "Data Scientist" yields most (5000+) jobs, followed by "Data Engineer", while "artificial intelligence" delivers 8000+ jobs. 

```{list-table} Data Science Jobs
:header-rows: 1
:label: data-science-jobs

* - Data Engineer
  - Data Analyst 
  - Machine Learning Engineer
  - Data Scientist
* - 4,000+
  - 3,000+
  - 1,000+
  - 5,000+

However, when searching using the field/skill-set terms:  "Data Engineering", "Data Analysis", "Machine Learning", "Data Science", and add "Artificial Intelligence," the term "data analysis" returns most job results, followed by AI.

```{list-table} Data Science Skills
:header-rows: 1
:label: data-science-skills

* - Data Engineering
  - Data Analysis 
  - Machine Learning
  - Data Science
  - Artificial Intelligence
* - 5,000+
  - 9,000+
  - 7,000+
  - 7,000+
  - 8,000+



```{tableofcontents}

```
