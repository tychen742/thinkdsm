from numpy import random

# pare = random.pareto(a=2, size=(2, 3))
# print(pare)


### visualize
import matplotlib.pyplot as plt
import seaborn as sns

pare = random.pareto(a=2, size=1000)
sns.distplot(pare, kde=False)
plt.show()