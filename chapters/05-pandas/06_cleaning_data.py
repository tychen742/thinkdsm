# ### show rows with empty cell/NaN
import numpy as np
import pandas as pd
import matplotlib.pyplot as plt

df = pd.read_json('data.json')
df.plot()
plt.show()

# print(df)

# ### isna(): https://stackoverflow.com/questions/66888339/find-empty-cells-in-rows-of-a-column-dataframe-pandas

print(df['Duration'].isna())
print(df['Pulse'].isna())
print(df['Maxpulse'].isna())
print(df['Calories'].isna())

# ### isnull(): https://stackoverflow.com/questions/27159189/find-empty-or-nan-entry-in-pandas-dataframe
print(np.where(pd.isnull(df)))
print(df.iloc[17, 3])

print([df.iloc[i, j] for i, j in zip(*np.where(pd.isnull(df)))])

