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

## Installing NumPy

To install NumPy, do one of the following:
1. At command line, navigate to your project directory (dsm), activate the virtual environment, then use the `pip install [package]` command:

```bash
pip install numpy
```
You should see the installation happens like:

```
(.venv) tychen✪macː~/workspace/dsm$ pip install numpy
Collecting numpy
  Downloading numpy-2.3.3-cp312-cp312-macosx_14_0_arm64.whl.metadata (62 kB)
     ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ 62.1/62.1 kB 1.3 MB/s eta 0:00:00
Downloading numpy-2.3.3-cp312-cp312-macosx_14_0_arm64.whl (5.1 MB)
   ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ 5.1/5.1 MB 4.1 MB/s eta 0:00:00
Installing collected packages: numpy
Successfully installed numpy-2.3.3
```

```{note}
Alternatively, in a Jupyter notebook, you may issue `%pip install [package]` in a code cell to install packages just like like `pip install [package]` in the command line. You will see people use `!pip install` as well. `!pip` runs pip as a shell command, while `%pip` is a Jupyter magic function that works in the current running notebook kernel, which allows you to customize your notebooks. Don't forget to comment out your `pip` commands in the cells, or it will keep running every time you run the cells.
```

# Using NumPy

Once you've installed NumPy you can import it as a library:

```
import numpy as np
```
Numpy has many built-in functions and capabilities. For example:


```
arr = np.array([1, 2, 3, 4, 5])     ### creating array
print(np.mean(arr))                 # mean
print(np.std(arr))                  # standard deviation

```

Here we will focus on some of the most important aspects of Numpy: 
- vectors
- arrays
- matrices 
- number generation. 

# NumPy Arrays

NumPy arrays (n-dimensional array, or `ndarray`) NumPy is like a super-powered list that can store numbers in rows and columns. NumPy arrays essentially come in two flavors: vectors and matrices. Vectors are strictly 1-d arrays has only one axis, and matrices are 2-d arrays with two axes: (rows, columns).

## 

```{code-cell}
import numpy as np

arr = np.array([[1, 2, 3],
                [4, 5, 6]])
print(arr)
```


## Vectorized Operations (No Loops Needed)

NumPy does math on whole arrays at once (much faster than using loops).

```
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


NumPy provides built-in tools for math, statistics, and linear algebra.


NumPy makes numerical computing in Python **fast, efficient, and powerful**. Mastering arrays, vectorization, and broadcasting will give you a strong foundation for data science and beyond.