---
jupytext:
#   cell_metadata_filter: -all
  formats: md:myst
  text_representation:
    extension: .md
    format_name: myst
    format_version: 0.13
    jupytext_version: 1.17.2
  formats: md:myst
kernelspec:
  name: python3
  language: python
display_name: Python (ipykernel)
---

# Python Basics

## Variables
**Variables** are names that reference **objects** in memory. You create them with the assignment operator (the equal sign, e.g., x = 2) and can reassign them to different objects. Use descriptive, lowercase names with underscores for readability, avoid starting names with digits or symbols.

```{note} 
**Object?** In Python, a variable is a symbolic name or label that refers to an object in memory. In Python, everything is an object. This includes numbers, strings, lists, dictionaries, functions, classes, and even modules. An object is an instance of a class, which serves as a blueprint defining the object's attributes (data) and methods. Each object has a unique identity (memory address), a type (its class), and a value. (see [PEP 8](https://peps.python.org/pep-0008/) for Python coding conventions)
```

### Variable Assignments
Variables are assigned using the equal sign. Choose a variable name and assign an object or data type to it.

```{code-cell}
var = 2
x = 2
y = 3
x + y
x = x + x
```

Variable names should not start with numbers or special symbols. Use lowercase letters, and to chain together multiple words, use underscores.

```{code-cell}
#12var = 12
#$var = 5
name_of_var = 10
```

## Operators
**Operators** let you perform common processing on variables. There are 7 main operators: 
1. assignment operators perform assignments and augmented assignments (e.g., `=, +=`).
2. arithmetic operators perform calculations (e.g., `+`, `-`, `*`, `/`, `%`, `**`) (note that / yields a floating-point and you usually can't divide by 0).
3. comparison operators evaluate relationships (e.g., `==`, `!=`, `<`, `>`, `<=`, `>=`).
4. logical operators combine boolean expressions (`and`, `or`, `not`; e.g., `x == x and y > z`).
5. bitwise operators (`&`, `|`, `^`, `<<`, `>>`; e.g., `x & y`).
6. identity operators compare the objects whereas the equality operator compare two values (`is`, `is not` (e.g., `a is b`)).
7. membership operators (`in, not in` (`x in my_list)1`). 

Operator **precedence**: Python follows standard mathematical order of operations (PEMDAS: Parentheses, Exponents, Multiplication and Division from left to right, then Addition and Subtraction from left to right). For example:

```{code-cell}
2 + 3 * 5 + 5
2 + 3 * (5 + 5)
```

The modulus operation (also known as the mod function) is represented by the percent sign in Python. It returns what remains after the division. Modulus is useful in the operations of cycles/repetition and clock arithmetic. 

```{code-cell}
4 % 2
5 % 2
8 % 2
```

## Data Types
**Data types** define the kind of values you work with. Python has [standard types](https://docs.python.org/3/library/stdtypes.html) built into the interpreter. The commonly used ones are:
1. numerics: `int`, `float`, `complex`
2. boolean: `bool` (for true/false logic)
3. sequence: `list`, `tuple`, `range` (lists are ordered, mutable collections allowing nesting and various types for elements)
4. text sequence: ```str``` (note that strings for text that support _indexing and slicing_)
5. set: set, frozenset
6. mapping: map

```{figure} ../../images/python-data-types.png
---
width: 500px
name: python-data-types
---
[Python built-in data types](https://www.scaler.com/topics/type-casting-in-python/)
```



### Numbers
Python has two basic number types: the integer (e.g., 1) and the floating point number (e.g., 1.0). With either of these numbers, you can perform basic arithmetic as expected.
Python Code Sample

```{code-cell} ipython3
1 + 1
1 * 3
1 / 2
2 ** 4
```

For addition, use the plus sign. For multiplication, use the asterisk. Division is performed with a forward slash. Note that dividing two integers results in a floating point number. For exponents, use two asterisks together. Python follows the order of operations, and you can use parentheses to clarify the order.
Python Code Sample

```{code-cell} ipython3
2 + 3 * 5 + 5
2 + 3 * (5 + 5)
```

The modulus operation (also known as the mod function) is represented by the percent sign in Python. It returns what remains after the division.
Python Code Sample

```{code-cell} ipython3
4 % 2
5 % 2
8 % 2
```

### Strings 
Strings can be created using single or double quotes. You can also wrap double quotes around single quotes if you need to include a quote inside the string.

```{code-cell}
'hello'
"hello"
"I can't go"
```

#### Indexing and Slicing Strings
Strings are sequences of characters. You can access specific elements using square bracket notation. Python indexing starts at zero.

```{code-cell}
s = 'hello'
s[0]
s[4]
```

**Slice notation** allows you to grab parts of a string. Use a colon to specify the start and end indices. The end index is not included.

```{code-cell}
s = 'abcdefghijk'
s[0:]
s[:3]
s[3:6]
```

### Lists
Lists are sequences of elements in square brackets, separated by commas. Lists can contain any data type, including other lists.

```{code-cell}
my_list = ['a', 'b', 'c']
my_list.append('d')
my_list[0]
my_list[1:3]
my_list[0] = 'NEW'
```

Lists can be nested inside each other. You can access elements in nested lists by chaining square brackets.

```{code-cell}
lst = [1, 2, [3, 4]]
lst[2][1]
```
For deeper nesting, continue stacking brackets to access the desired element.

```{code-cell}
nest = [1, 2, 3, [4, 5, ['target']]]
nest[3][2][0]
print(nest[3][2][0])
```

## print()
In Jupyter Notebook, typing the variable name displays the value, but to officially display output in Python, use the print statement.

```{code-cell}
x = 'hello'
print(x)
```

### Print Formatting 
You can format print statements by inserting **curly brackets** in your string and using the **.format()** method to fill them with variable values.

```{code-cell} ipython3
num = 12
name = 'Sam'
print('My number is {} and my name is {}'.format(num, name))
```

You can also use **named placeholders** inside the curly brackets and specify which variable fills each placeholder in the .format() call.

```{code-cell}
print('My number is {one} and my name is {two}. More: {one}'.format(one=num, two=name))
```


## Conclusion
In this lecture, we covered lists, slice notation, how to grab things from an index, strings, print formatting, basic variable assignments, and basic arithmetic.
Key Takeaways
* Python supports basic arithmetic operations and variable assignments using intuitive syntax.
* Strings can be created with single or double quotes and support indexing and slicing.
* Print formatting allows dynamic insertion of variables into strings using the .format() method.
* Lists are ordered sequences that support indexing, slicing, appending, and nesting.


## Resources
- Python (programming language). (2024, February 20). In Wikipedia. https://en.wikipedia.org/wiki/Python_(programming_language)


```{code-cell} ipython3

```

```{bibliography}
```