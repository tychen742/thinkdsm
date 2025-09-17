import pandas as pd

lst = [1, 23, 4]

# ### create a series
var = pd.Series(lst)

print(var)

# ### labels
# labels are by default indices
print("The label of var[0]:", var[0])

# ### create labels
var = pd.Series(lst, index = ["a", "b", "c"])
print(var)

# ### access item with label
print("The value associated with label c is:", var["c"])

# ### key-value objects ==> series; keys are labels
# ex: dictionary
height = {"p01": 170, "p02": 180, "p03": 190}
var = pd.Series(height)
print(var)

# ### accessing items using labels ("index")
var = pd.Series(height, index = ["p01", "p03"])
print(var)