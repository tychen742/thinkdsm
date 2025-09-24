import numpy as np
print("something")
arr = np.array([1, 2, 3])

# for x in arr:
#     print(x)

# arr2: a 2-D array
arr2 = np.array([
    [1, 2, 3],
    [4, 5, 6]
])
# for x in arr2:
#     print("")
#     for y in x:
#         print(y, end=' ')
# print()


# arr3: a 3-D array
arr3 = np.array(
    [
        [
            [1, 2, 3],
            [4, 5, 6]
        ],
        [
            [7, 8, 9],
            [10, 11, 12]
        ],
        [
            [13, 14, 15],
            [16, 17, 18]
        ]
    ]
)
# for x in arr3:
#     print(x)
#     print()

for x in arr3:
    print()
    for y in x:
        print()
        for z in y:
            print(z, end=" ")
print()
### use the nditer helper function
# for x in np.nditer(arr3):
#     print(x)

### nditer change datatypes 
# the 'b' character before string type: Python 3 unicode marking "bytestrings" 
# https://stackoverflow.com/questions/33655641/b-character-added-when-using-numpy-loadtxt
# for x in np.nditer(arr3, flags=['buffered'], op_dtypes=['S']):
#     print(x)

print("step-iterating through a 3-D array with nditer:")
for x in np.nditer(arr3[:, :1, :1]):
    print(x)

##### nd = n-dimensional; e.g., ndarray 
### using ndenumerate (iterating with index numbers)
for idx, x in np.ndenumerate(arr3):
    print(idx, x)