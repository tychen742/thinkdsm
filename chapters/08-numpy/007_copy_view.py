import numpy as np;

arr1 = np.array([1, 2, 3, 4, 5])
print("arr1:", arr1)

print()

arr2 = arr1.copy()
arr1[0] = 10000
print("arr1[0]=1000: ", arr1)
print("arr1.copy:", arr2)

print()

arr3 = arr1.view()
arr1[0] = 10000
print("arr1:", arr1)
print("arr1.view():", arr3)