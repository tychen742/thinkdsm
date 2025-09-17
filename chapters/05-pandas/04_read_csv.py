# ### files ==> dataframe
# Dataset: Netflix Movies and TV Shows @ https://www.kaggle.com/datasets/shivamb/netflix-shows

import pandas as pd

# ### read csv
df = pd.read_csv("netflix_titles.csv")
# print(df.head())
print(df)       ### will print only 5+5 rows

# ### to_string()
# print(df.to_string())

# ### max_rows
print(pd.options.display.max_rows)  ### 60

pd.options.display.max_rows = 9999
# print(df)       ### print up to 9999 rows

