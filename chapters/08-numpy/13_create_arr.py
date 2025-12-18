import numpy as np

arr = np.array([1, 2, 3, 4, 5])

print(arr)
print(type(arr))

# type
tup = np.array((1, 2, 3, 4, 5))
print("tuple: ", tup)


# 0-D arrays. This arr_0d arry has a single value of 42
arr_0d = np.array(42)
print(arr_0d)

# 1-D arrays: has 0-D arrays as elements.
# 1-D arrays: also called uni-dimensional or 1-D array
# common & basic
arr_1d = np.array([1, 2, 3, 4, 5])
print("A 1-D array: ", arr_1d)


# 2-D arrays
arr_2d = np.array([[1, 2, 3], [4, 5, 6]])
print("A 2-D array: ", arr_2d)


# 3-D arrays
# A 3-D array with 2 2-D
arr_3d = np.array(
    [
        [
            [1, 2, 3],
            [4, 5, 6]
        ],
        [
            [1, 2, 3],
            [4, 5, 6]
        ],
        [
            [1, 2, 3],
            [4, 5, 6]
        ]
    ]
)

print("A 3-D array: ", arr_3d)

# use the ndim property to check dimensions
print(arr_3d.ndim)
