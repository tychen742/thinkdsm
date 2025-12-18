# ##### arithmetics in np arrays

# ### addition
# ### substraction
# ### multiplication
# ### division

# ### power
# ### remainder
# ### quotient and mod
# ### absolute values

import numpy as np

# ### addition
arr1 = np.array([1, 2, 3, 4, 5])
arr2 = np.array([3, 4, 5, 6, 7])
arr3 = np.add(arr1, arr2)

print(arr3)

# ### substraction
arr1 = np.array([1, 2, 3, 4, 5])
arr2 = np.array([3, 4, 5, 6, 7])
arr3 = np.subtract(arr1, arr2)

print(arr3)

# ### multiplication
arr1 = np.array([1, 2, 3, 4, 5])
arr2 = np.array([3, 4, 5, 6, 7])
arr3 = np.multiply(arr1, arr2)

print(arr3)

# ### division
arr1 = np.array([1, 2, 3, 4, 5])
arr2 = np.array([3, 4, 5, 6, 7])
arr3 = np.divide(arr1, arr2)

print(arr3)

# ### power
arr1 = np.array([1, 2, 3, 4, 5])
arr2 = np.array([3, 4, 5, 6, 7])
arr3 = np.power(arr1, arr2)

print(arr3)

# ### remainder/mod
arr1 = np.array([10, 9, 8, 7, 6])
arr2 = np.array([5, 4, 3, 2, 1])

arr3 = np.mod(arr1, arr2)
print(arr3)

arr3 = np.remainder(arr1, arr2)

print(arr3)

# ### quotient and mod
arr1 = np.array([10, 9, 8, 7, 6])
arr2 = np.array([5, 4, 3, 2, 1])

arr3 = np.divmod(arr1, arr2)
print(arr3)

# ### absolute values
arr1 = np.array([- 10, - 9, 8, 7, 6])


arr3 = np.absolute(arr1, arr2)
print(arr3)
