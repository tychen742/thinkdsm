from numpy import random

# chi = random.chisquare(df=2, size=(2, 3))
# print(chi)

### visualize chi square
import matplotlib.pyplot as plt
import seaborn as sns

chi = random.chisquare(df=1, size=1000)
sns.distplot(chi, hist=False)
plt.show()