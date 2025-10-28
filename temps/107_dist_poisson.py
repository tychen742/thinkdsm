from numpy import random
import matplotlib.pyplot as plt
import seaborn as sns

# pois = random.poisson(lam=2, size=1000)
# print(pois)
# sns.distplot(pois, kde=False)
# plt.show()


norm = random.normal(loc=50, scale=7, size=1000)
pois = random.poisson(lam=50, size=1000)
sns.distplot(norm, hist=False, label='normal', color='blue')
sns.distplot(pois, hist=False, label='poisson', color='red')
plt.show()