# Introduction to NumPy

NumPy, or Numerical Python, is the foundation for Pythonic data science, machine learning, and scientific libraries like **pandas**, **scikit-learn**, and **TensorFlow**. Learning NumPy is to understand the basics of how these other tools work. NumPy (or Numpy) is basically a linear algebra library for Python. Numpy is important for Data Science because almost all of the libraries in the PyData Ecosystem rely on NumPy as one of their main building blocks.


## NumPy Data Structure

The primary data structure in NumPy is the N-dimensional array, or `ndarray`. NumPy's arrays are a list of lists in Python, but more compact than Python lists. In essence, a Python list is an array of pointers to heterogenous Python objects, while a NumPy array is an array of uniform values of the same type ({numref}`c-vs-python-list`). Python lists there are more flexible, but Numpy arrays are smaller in file size and access in reading and writing items is much faster {cite}`Martelli_2009`.

<!-- , at least 4 bytes per pointer plus 16 bytes for even the smallest Python object (4 for type pointer, 4 for reference count, 4 for value -- and the memory allocators rounds up to 16).  -->

<!-- (4 bytes each for single-precision numbers and 8 bytes double-precision).  -->

```{figure} ../images/c-vs-python-list.png
:width: 350px
:name: c-vs-python-list
:alt: c-vs-python-list
:align: center

Difference between C and Python lists {cite}`Vanderplas_2022`
```


## N-Dimensional Array (`ndarray`)

NumPy introduces the `ndarray` — like a super-powered list that can store numbers in rows and columns. 

```{
import numpy as np

arr = np.array([[1, 2, 3],
                [4, 5, 6]])
print(arr)
}
```

## Vectorized Operations (No Loops Needed)

NumPy does math on whole arrays at once (much faster than using loops).

```code
arr = np.array([1, 2, 3, 4])
print(arr * 2)   # multiply each element by 2
print(arr + 5)   # add 5 to each element
```

## Broadcasting

NumPy can combine arrays of different shapes by \"stretching\" one to match the other.
A = np.array([[1, 2, 3],
              [4, 5, 6]])

B = np.array([10, 20, 30])

print(A + B)

## Rich Ecosystem of Functions

NumPy provides built-in tools for math, statistics, and linear algebra.

```bash
arr = np.array([1, 2, 3, 4, 5])
print(np.mean(arr))   # mean
print(np.std(arr))    # standard deviation
print(np.dot(arr, arr))  # dot product
```

NumPy makes numerical computing in Python **fast, efficient, and powerful**. Mastering arrays, vectorization, and broadcasting will give you a strong foundation for data science and beyond.