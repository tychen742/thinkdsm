from numpy import random

# ray = random.rayleigh(scale=2, size=(2, 3))
# print(ray)

# visualize
import matplotlib.pyplot as plt
import seaborn as sns

ray = random.rayleigh(size=1000)
sns.distplot(ray, hist=False)
plt.show()