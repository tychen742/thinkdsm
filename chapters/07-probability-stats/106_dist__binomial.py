from numpy import random
import matplotlib.pyplot as plt
import seaborn as sns

# binomial distribution
bino = random.binomial(n=100, p=0.5, size=1000)
# print(x)

# # visualization
# sns.distplot(bino, hist=True, kde=False)
# plt.show()

# normal distribution vs binomial
norm = random.normal(loc=50, scale=5, size=1000)
sns.distplot(norm, hist=False, label='normal', color='red')
sns.distplot(bino, hist=False, label="binomial", color='green')
plt.show()
