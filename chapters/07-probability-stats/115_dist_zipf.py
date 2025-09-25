from numpy import random

# zip = random.zipf(a=2, size=(2, 3))
# print(zip)

# visualize
import matplotlib.pyplot as plt
import seaborn as sns

zip = random.zipf(a=2, size=1000)
sns.distplot(zip[zip < 10], kde=False)

plt.show()