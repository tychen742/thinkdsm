from numpy import random

# expo = random.exponential(scale=2, size=(2, 3))
# print(expo)

import matplotlib.pyplot as plt
import seaborn as sns

expo = random.exponential(size=1000)
sns.distplot(expo, hist=False)
plt.show()


