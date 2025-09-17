# from numpy import random
import numpy as np
##### 2 permutatoin methods: shuff() and permutation()

### shuffle
arr = np.array([1, 2, 3, 4, 5])
np.random.shuffle(arr)  ### change the original array itself
print(arr)

### permutation
# print(np.random.permutation(arr))
arr_perm = np.random.permutation(arr)
print(arr_perm)