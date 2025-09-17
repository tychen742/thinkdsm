# ### A series is one-dimensional; a Pandas DataFrame is 2-dimensional (like 2-dimensional array or table)

import pandas as pd

data = {
    "age": [20, 30, 40],
    "income": [30, 50, 120]
}

df = pd.DataFrame(data)
print(df)

# ### retrieval: rows
print("First row of the dataframe", df.loc[0])
print("First and second row of the dataframe", df.loc[[0, 1]])


# ### named indexes
data = {
    "age": [20, 30, 40],
    "income": [75, 100, 120]
}
print("\n\nThe data:\n",data)
df = pd.DataFrame(data, index = ["John", "Adam", "Shon"])
print("\n\nData with named index:\n", df)


