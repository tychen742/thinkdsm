import numpy as np

# create array
arr = np.array([1, 2, 3, 4, 5])

# output 1-D array elememt using indices
print(arr[0])
print(arr[2])


# 2-D arrays
# 2-D arrays are like tables with rows and columns.
# dimension represents the row and the index represents the column
arr_2d = np.array([
    [1, 2, 3, 4, 5],
    [6, 7, 8, 9,  10]
])

print('The 2nd element on the 1st row is: ', arr_2d[0, 1])
print('The element on the 2st row, 5th column: ', arr_2d[1, 4])


# 3-D arrays
arr_3d = np.array(
    [
        [
            [1, 2, 3],
            [4, 5, 6]
        ],
        [
            [7, 8, 9],
            [10, 11, 12]
        ]
    ]
)
print(arr_3d[0, 1, 2])


### negative indexing
arr_negative = np.array([[1, 2, 3, 4, 5], [6, 7, 8, 9, 10]])
print('Last element from 2nd dim: ', arr_negative[1, -1])

