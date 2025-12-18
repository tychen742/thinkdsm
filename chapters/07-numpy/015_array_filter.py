import numpy as np

# create array
arr = np.array([1, 2, 3, 4, 5, 6, 7, 8, 9, 10])
# create an empty list
arr_filter = []

# iterate through arr_filter
for element in arr:
    # condition if elemnt > 42, then True; else False
    if element > 5:
        arr_filter.append(True)
    else:
        arr_filter.append(False)

arr_new = arr[arr_filter]   ### filter array with T/F list

print(arr_filter)
print(arr_new)

# print(type(arr))

# Create filtered array directly
arr_filter = arr > 5
print(arr_filter)
print(arr[arr_filter])