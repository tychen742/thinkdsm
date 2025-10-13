import numpy as np
import pandas as pd

arr1 = np.random.randint(1, 100, size=100)
arr2 = arr1.reshape(20, 5)
df = pd.DataFrame(arr2, columns=['A', 'B', 'C', 'D', 'E'])
df['Sum'] = df.sum(axis=1)
print(df)

# Output:
#     A   B   C   D   E  Sum
# 0   5  67  34  23  89 218
# 1  45  12  78  56   9 200
# 2  90  11  22  33  44 200
# ...
