import numpy as np
import pandas as pd

np.random.seed(42)
arr1 = np.random.randn(100)
arr2 = arr1.reshape(20, 5)
cols = list('ABCDE')
df = pd.DataFrame(arr2, columns=cols)
df['Sum'] = df.sum(axis=1)
# print(df)

# Output:
#     A         B         C         D         E       Sum
# 0  0.5  0.67  0.34  0.23  0.89  2.03
# 1  0.45  0.12  0.78  0.56  0.09  2.00
# 2  0.90  0.11  0.22  0.33  0.44  2.00     

print('row 13-14\n', df[13:15], '\n')
print('row 13-14 sum\n', df[13:15]['Sum'], '\n')
print('row 13-14, -1\n', df[13:15][-1:], '\n')  ### tricky
print(df.loc[10, 'A'])
print(df.iloc[10, 0])
print(df[df['Sum'] > 2.0])
    