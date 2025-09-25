import matplotlib.pyplot as plt
import seaborn as sns

# plotting a distplot
# sns.distplot([0, 1, 2, 3, 4, 5])
# plt.show()


# plotting a distplot w/o the histogram
sns.distplot([0, 1, 2, 3, 4, 5], hist=False)
plt.show()