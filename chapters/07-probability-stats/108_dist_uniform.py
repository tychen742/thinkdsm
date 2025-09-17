from numpy import random
import matplotlib.pyplot as plt
import seaborn as sns

# uniform distribution
# unif = random.uniform(size=10)
# print(unif)

# unif = random.uniform(size=(2, 3))
# print(type(unif))   # numpy.ndarray
# print(unif)         ### 2-d 2 x 3 array

unif = random.uniform(0, 5, size=1000)
sns.distplot(unif, hist=False)
plt.show()