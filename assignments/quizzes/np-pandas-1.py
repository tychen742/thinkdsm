import numpy as np
import pandas as pd

arr1 = np.array([1, 2, 3, 4, 5])
arr2 = np.array([10, 20, 30, 40, 50])
df = pd.DataFrame({'A': arr1, 'B': arr2})
df['C'] = df['A'] + df['B']
print(df)

# Output:
#    A   B   C
# 0  1  10  11
# 1  2  20  22
# 2  3  30  33
# 3  4  40  44
# 4  5  50  55  