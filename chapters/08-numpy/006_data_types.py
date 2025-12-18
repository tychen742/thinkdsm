import numpy as np

arr_int = np.array([1, 2, 3, 4])
print("arr_int ([1, 2, 3, 4]) type: ", arr_int.dtype)

# print(type("This is a string"))

arr_str = np.array(['apple', 'banana', 'cherry'])
print("arr_str ('apple', 'banana', 'cherry') type: ", arr_str.dtype)


arr_type_S = np.array([1, 2, 3, 4], dtype='S')  # S: string
print("arr_type_S type S specified: ", arr_type_S)
print("arr_type_S type: ", arr_type_S.dtype)

# no type specified
arr_type_S = np.array([1, 2, 3, 4])  # S: string
print("arr_type_S No type specified: ", arr_type_S)
print("arr_type_S type: ", arr_type_S.dtype)

# test = "test"
# print(test * 5)

arr_float = np.array([1.1, 2.2, 3.3, 4.4, 5.5])
print(arr_float.dtype)