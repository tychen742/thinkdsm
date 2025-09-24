import numpy as np

# ##### define a ufunc
def myadd(x, y):
    return x + y

# ### using the frompyfunc method with func, num of input, num of output
myadd = np.frompyfunc(myadd, 2, 1)
print(myadd([1, 2, 3, 4, 5], [6, 7, 8, 9, 10]))


# ### check ufunc data type ==> <class 'numpy.ufunc'>
print(type(myadd))          ### put the name/identifier in type()

# ### check numpy's built-in method numpy add ==> also a <class 'numpy.ufunc'>
print(type(np.add))


# ### use np.ufunc to check ufunc
# print(np.ufunc)   ==> <class 'numpy.ufunc'>
if type(np.add) == np.ufunc:
    print('add is a ufunc')
else:
    print('add is NOT a ufunc')