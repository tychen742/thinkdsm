from numpy import random

# logi = random.logistic(loc=1, scale=2, size=(2, 3))
# print(logi)

import matplotlib.pyplot as plt
import seaborn as sns

logi = random.logistic(size=1000)
sns.distplot(logi, hist=False, color='blue')
# plt.show()

norm = random.normal(scale=2, size=1000)
sns.distplot(norm, hist=False, color="red")

plt.show()