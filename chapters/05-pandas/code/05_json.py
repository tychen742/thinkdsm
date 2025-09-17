# ##### json == python dictionary

import pandas as pd

df = pd.read_json('data.json')
print(type(df))
print(df)
# print(df.to_string())   ### print all data

# ### head
print(df.head())
print(df.head(10))

# ### tail()
print(df.tail())
print("\n\ntail():\n", df.tail())

# ### info()
print()
# print("\n\ndf.info():\n", df.info())  ### irregular
print(df.info())