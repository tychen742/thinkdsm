---
jupytext:
  text_representation:
    extension: .md
    format_name: myst
    format_version: 0.13
    jupytext_version: 1.17.2
kernelspec:
  display_name: .venv
  language: python
  name: python3
---

# Lecture Notebook

+++

## Variable Assignment

```{code-cell} ipython3
---
jupyter:
  outputs_hidden: true
---
# Can not start with number or special characters
name_of_var = 2
```

```{code-cell} ipython3
---
jupyter:
  outputs_hidden: true
---
x = 2
y = 3
```

```{code-cell} ipython3
---
jupyter:
  outputs_hidden: true
---
z = x + y
```

```{code-cell} ipython3
z
```


## Operators
### Comparison Operators

```{code-cell} ipython3
1 > 2
```

```{code-cell} ipython3
1 < 2
```

```{code-cell} ipython3
1 >= 1
```

```{code-cell} ipython3
1 <= 4
```

```{code-cell} ipython3
1 == 1
```

```{code-cell} ipython3
'hi' == 'bye'
```

### Logic Operators

```{code-cell} ipython3
(1 > 2) and (2 < 3)
```

```{code-cell} ipython3
(1 > 2) or (2 < 3)
```

```{code-cell} ipython3
(1 == 2) or (2 == 3) or (4 == 4)
```

## Printing

```{code-cell} ipython3
---
jupyter:
  outputs_hidden: true
---
x = 'hello'
```

```{code-cell} ipython3
x
```

```{code-cell} ipython3
print(x)
```

```{code-cell} ipython3
---
jupyter:
  outputs_hidden: true
---
num = 12
name = 'Sam'
```

```{code-cell} ipython3
print('My number is: {one}, and my name is: {two}'.format(one=num,two=name))
```

```{code-cell} ipython3
print('My number is: {}, and my name is: {}'.format(num,name))
```

### Data types

#### Numbers

+++



```{code-cell} ipython3
1 + 1
```

```{code-cell} ipython3
1 * 3
```

```{code-cell} ipython3
1 / 2
```

```{code-cell} ipython3
2 ** 4
```

```{code-cell} ipython3
4 % 2
```

```{code-cell} ipython3
5 % 2
```

```{code-cell} ipython3
(2 + 3) * (5 + 5)
```



#### Strings

```{code-cell} ipython3
'single quotes'
```

```{code-cell} ipython3
"double quotes"
```

```{code-cell} ipython3
" wrap lot's of other quotes"
```

#### Lists

```{code-cell} ipython3
[1,2,3]
```

```{code-cell} ipython3
['hi',1,[1,2]]
```

```{code-cell} ipython3
---
jupyter:
  outputs_hidden: true
---
my_list = ['a','b','c']
```

```{code-cell} ipython3
---
jupyter:
  outputs_hidden: true
---
my_list.append('d')
```

```{code-cell} ipython3
my_list
```

```{code-cell} ipython3
my_list[0]
```

```{code-cell} ipython3
my_list[1]
```

```{code-cell} ipython3
my_list[1:]
```

```{code-cell} ipython3
my_list[:1]
```

```{code-cell} ipython3
---
jupyter:
  outputs_hidden: true
---
my_list[0] = 'NEW'
```

```{code-cell} ipython3
my_list
```

```{code-cell} ipython3
---
jupyter:
  outputs_hidden: true
---
nest = [1,2,3,[4,5,['target']]]
```

```{code-cell} ipython3
nest[3]
```

```{code-cell} ipython3
nest[3][2]
```

```{code-cell} ipython3
nest[3][2][0]
```

#### Dictionaries

```{code-cell} ipython3
---
jupyter:
  outputs_hidden: true
---
d = {'key1':'item1','key2':'item2'}
```

```{code-cell} ipython3
d
```

```{code-cell} ipython3
d['key1']
```


#### Tuples 

```{code-cell} ipython3
---
jupyter:
  outputs_hidden: true
---
t = (1,2,3)
```

```{code-cell} ipython3
t[0]
```

```{code-cell} ipython3
# t[0] = 'NEW'
```

#### Sets

```{code-cell} ipython3
{1,2,3}
```

```{code-cell} ipython3
{1,2,3,1,2,1,2,3,3,3,3,2,2,2,1,1,2}
```

#### Booleans

```{code-cell} ipython3
True
```

```{code-cell} ipython3
False
```

#### range()

```{code-cell} ipython3
range(5)
```

```{code-cell} ipython3
for i in range(5):
    print(i)
```

```{code-cell} ipython3
list(range(5))
```

#### list comprehension

```{code-cell} ipython3
---
jupyter:
  outputs_hidden: true
---
x = [1,2,3,4]
```

```{code-cell} ipython3
out = []
for item in x:
    out.append(item**2)
print(out)
```

```{code-cell} ipython3
[item**2 for item in x]
```

### functions

```{code-cell} ipython3
---
jupyter:
  outputs_hidden: true
---
def my_func(param1='default'):
    """
    Docstring goes here.
    """
    print(param1)
```

```{code-cell} ipython3
my_func
```

```{code-cell} ipython3
my_func()
```

```{code-cell} ipython3
my_func('new param')
```

```{code-cell} ipython3
my_func(param1='new param')
```

```{code-cell} ipython3
---
jupyter:
  outputs_hidden: true
---
def square(x):
    return x**2
```

```{code-cell} ipython3
---
jupyter:
  outputs_hidden: true
---
out = square(2)
```

```{code-cell} ipython3
print(out)
```

### lambda expressions

```{code-cell} ipython3
---
jupyter:
  outputs_hidden: true
---
def times2(var):
    return var*2
```

```{code-cell} ipython3
times2(2)
```

```{code-cell} ipython3
lambda var: var*2
```

### map and filter

```{code-cell} ipython3
---
jupyter:
  outputs_hidden: true
---
seq = [1,2,3,4,5]
```

```{code-cell} ipython3
map(times2,seq)
```

```{code-cell} ipython3
list(map(times2,seq))
```

```{code-cell} ipython3
list(map(lambda var: var*2,seq))
```

```{code-cell} ipython3
filter(lambda item: item%2 == 0,seq)
```

```{code-cell} ipython3
list(filter(lambda item: item%2 == 0,seq))
```

### methods

```{code-cell} ipython3
---
jupyter:
  outputs_hidden: true
---
st = 'hello my name is Sam'
```

```{code-cell} ipython3
st.lower()
```

```{code-cell} ipython3
st.upper()
```

```{code-cell} ipython3
st.split()
```

```{code-cell} ipython3
---
jupyter:
  outputs_hidden: true
---
tweet = 'Go Sports! #Sports'
```

```{code-cell} ipython3
tweet.split('#')
```

```{code-cell} ipython3
tweet.split('#')[1]
```

```{code-cell} ipython3
d
```

```{code-cell} ipython3
d.keys()
```

```{code-cell} ipython3
d.items()
```

```{code-cell} ipython3
---
jupyter:
  outputs_hidden: true
---
lst = [1,2,3]
```

```{code-cell} ipython3
lst.pop()
```

```{code-cell} ipython3
lst
```

```{code-cell} ipython3
'x' in [1,2,3]
```

```{code-cell} ipython3
'x' in ['x','y','z']
```


