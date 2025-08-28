# Introduction

These lecture notes are prepared for IST-3420, Introduction to Data Science and Management at Missouri University of Science and Technology (MS&T). The course aims to provide you with a solid foundation in data science concepts and practices, supporting both your future studies and career development.

Major curriculum modules included in this course are:

- Foundation Building: Establishes solid Python/Jupyter programming skills essential for data science work.
- Data Manipulation Core: Covers NumPy and Pandas extensively, as these are the backbone tools for data scientists.
- Visualization Skills: Develops both basic and advanced visualization capabilities for effective data communication.
- Analysis Techniques: Introduces statistical thinking and hypothesis testing crucial for data-driven insights.
- Machine Learning (Weeks 11-13): Covers both supervised and unsupervised learning with practical implementations.

## 1. What is Data Science?

According to [U.S. Census Bureau](https://www.census.gov/topics/research/data-science.html), data Science is "a field of study that uses scientific methods, processes, and systems to extract knowledge and insights from data." As the Data Science Venn Diagram suggested by [Drew Conway](http://drewconway.com/zia/2013/3/26/the-data-science-venn-diagram) ({numref}`what-is-data-science_conway-2013`), data science is by nature interdisciplinary; and data science practitioners draw on varied training in statistics, computing, and domain expertise.

```{figure} ../images/what-is-data-science_conway-2013.png
:width: 275px
:label: what-is-data-science_conway-2013
:name: what-is-data-science_conway-2013
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
### 2.1. The CRISP-DM model
As general process model of conducting a data science, the CRoss Industry Standard Process for data mining, known as [CRISP-DM](https://en.wikipedia.org/wiki/Cross-industry_standard_process_for_data_mining), is widely used as a defacto standard process model to describe the common approaches used for data mining and data science projects. There are 6 phases in this process model: 
1. Business Understanding
2. Data Understanding
3. Data Preparation
4. Modeling
5. Evaluation 
6. Deployment


```{figure} ../images/CRISP-DM_process_diagram.png
---
width: 350px
name: CRISP-DM-process-model
---
CRISP-DM Process Model
```

In addition to the process model, CRISP-DM also has a methodology, which contains specific generic tasks in each of the phases as seen in {numref}`CRISP-DM-tasks`.
<!-- https://www.datascience-pm.com/crisp-dm-2/#What_are_the_6_CRISP-DM_Phases -->

```{list-table} CRISP-DM tasks in each phase
:header-rows: 1
:label: CRISP-DM-tasks
:name: CRISP-DM-tasks

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
There are plenty of jobs and career opportunities in the general field of data science. From the perspective of [data science workflow](https://www.springboard.com/blog/data-science/data-science-process/)/lifecycle ({numref}`data-science-lifecycle-and-jobs`), we see that the four common data science related jobs roughly correspond with different phases of the workflow: Data Engineers with data collection and cleaning/cleansing, data analysts with data cleaning and EDA, machine learning engineers for model building and model deployment, while data scientists for the whole process of the workflow. 

```{figure} ../images/data-science-workflow-and-jobs.png
---
width: 500px
name: data-science-lifecycle-and-jobs
---
Data science workflow and related job titles
```

It is first noticed that, as technology advances, AI has become central to modern data work and is now foundational across the data stack. A quick search at an online job site (indeed.com) using the term "data scientists" yields job titles showing that data science and AI are interconnect: 
1. Generative AI/ML Data Scientist
2. Senior Agentic AI Data Scientist 
3. Manager, Data Science - GenAI Digital Assistant
4. Senior Advanced AI Software Engineer
5. Data Scientist Lead - Bank AI/ML

Further, when searching for these related job titles, the results show that the term "Data Scientist" yields most (5000+) jobs, followed by "Data Engineer", while "artificial intelligence" returns 8000+ jobs. 

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
```

However, when searching using the field/skill-set terms:  "Data Engineering", "Data Analysis", "Machine Learning", "Data Science", and add "Artificial Intelligence," the term "data analysis" returns most job results, followed by AI. This result at least suggests that machine learning and AI have become essential in the data science job market. 

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
```

## 4. Data Science Tools
As an attempt to summarize data science tools in four stages of data science operations (data management, data manipulation, data analysis, and visualization), a researcher posted his [data science tools summary](https://www.linkedin.com/posts/taka-coma_i-tried-to-summarize-tools-for-data-science-activity-6937425908513259521-Jo_U/) on LinkedIn to ask for feedback. 

```{figure} ../images/data-science-tools.jpeg
---
width: 500px
label: data-science-tools
name: data-science-tools
---
Data Science Tools
```

As seen in {numref}`data-science-tools`, the figure contains 4 groups of data science tools:
1. Data Management: Tools in this category are databases for data collection/acquisition and cleaning/cleansing. Most of the listed tools are SQL DBMS's (except mongoDB, redis, and neo4j). 
2. Data Manipulation: Programming languages such as Python and R, plus libraries such as pandas and NumPy are included. 
3. Data Analysis: scikit-learn is a popular toolkit for machine learning analysis based on NumPy, SciPy, and matplotlib. PyTorch and TensorFlow are popular open-source machine learning frameworks primarily used for building and training deep learning models. 
4. Data Visualization: Matplotlib is a comprehensive library for creating visualizations in Python. seaborn is a visualization library based on matplotlib providing a high-level interface for drawing statistical graphics.
5. Other Tools: Jupyter Notebook, along with other Jupyter products, is a web-based interactive development environment allowing for the creation and sharing of documents, code, and visualization. Jupyter Notebook has become a type of Integrated Development Environment (IDE) and it works more than 40 languages including Python, R, and Scala.

Note that while there are a large number of data science tools to choose from, beginners may pick one from each of the categories to start learning. Once you master a tool, it is often very easy to transfer the concepts and skills to another in the same category. For example, all SQL tools are different flavors of the same language standard; and almost all programming languages share the same basic constructs. 

## Resources
- https://towardsdatascience.com/
- https://365datascience.com/
- Chapman, P., Clinton, J., Kerber, R., Khabaza, T., Reinartz, T., Shearer, C., & Wirth, R. (2000). CRISP-DM 1.0: Step-by-step data mining guide. The CRISP-DM Consortium.
- https://realpython.com/pytorch-vs-tensorflow/





```{tableofcontents}

```
