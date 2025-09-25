# import numpy as np
# import numpy.random as random   # good
from numpy import random        # good, too
# random is a module

# random distribution: a set of random numbers that follow a certain probability density function.
# PDF: Probability Density Function: A function that describes a continuous probability. i.e. probability of all values in an array.

# x = random.choice([3, 5, 7, 9], p=[0.1, 0.3, 0.6, 0.0], size=(100))
x = random.choice([2, 4, 6, 8], p=[0.2, 0.3, 0.5, 0.0], size=(100))
print(x)

# size
x = random.choice([2, 4, 6, 8], p=[0.2, 0.3, 0.5, 0.0], size=(3, 5))
print(x)
