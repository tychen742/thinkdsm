import pandas as pd

# ### a dictionary
dict = {
    'cars': ["BMW", "Volvo", "Ford"],
    'passings': [3, 7, 2]
}

var = pd.DataFrame(dict)
print(var)


print("Pandas version:", pd.__version__)