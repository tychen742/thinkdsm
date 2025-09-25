from numpy import random
import matplotlib.pyplot as plt
import seaborn as sns

##### normal distribution
### the normal method in random
x = random.normal(size=(2, 3))
print(x)

### generate a random normal distribution of size 2X3 with mean at 1 and SD of 2
x = random.normal(loc=1, scale=2, size=(2, 3))
print(x)


##### visualization of Normal Distribution
# sns.distplot(random.normal(size=1000), hist=False)
sns.distplot(random.normal(size=1000), hist=False)
plt.show()