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
4. text sequence: `str` (note that strings for text that support _indexing and slicing_)
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

Python has three basic number types: the integer (e.g., 1), the floating point number (e.g., 1.0), and the complex number. Standard mathematical order of operation is followed for basic arithmetic operations. Note that dividing two integers results in a floating point number and dividing by zero will generate an error.

```{code-cell} ipython3
1 + 1         
1 * 3         
1 / 2         
2 / 2             ### output 1.0, not 1
2 ** 4        
2 + 3 * 5 + 5     ### 22
2 + 3 * (5 + 5)   ### 32
```

The modulus operation (also known as the mod function) is represented by the percent sign. It returns what remains after the division:

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

Strings are **sequences** of characters. You can access specific elements using **square bracket notation**. Python indexing starts at zero.

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

Lists are sequences of elements (similar to the array in many other languages) in **square brackets**, separated by _commas_. Lists can contain any data type, including other lists.

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
lst[2][1]             ### 4
```

For deeper nesting, continue stacking brackets to access the desired element.

```{code-cell}
nest = [1, 2, 3, [4, 5, ['target']]]
nest[3][2][0]                         ### 'target'
print(nest[3][2][0])                  ### target
```

## Keywords and Built-in Functions

### Python Keywords
In programming, keywords are predefined, reserved words with special meanings that define the structure and syntax of a programming language. Keywords have predefined meanings and cannot be used as **identifiers** (such as variable names, function names, or class names). For example, trying to create a value with a keyword as the variable name will cause a syntax error:

```{code-cell}
>>> True = "this is true"
  File "<python-input-0>", line 1
    True = "this is true"
    ^^^^
SyntaxError: cannot assign to True
>>>
```

There are currently 35 [keywords](https://docs.python.org/3/reference/lexical_analysis.html#keywords) and four soft keywords in Python.

::::{grid}
:gutter: 5

:::{grid-item}
False  
await  
else  
import  
pass
:::
:::{grid-item}
None  
break  
except  
in  
raise
:::
:::{grid-item}
True  
class  
finally  
is  
return
:::
:::{grid-item}
and  
continue  
for  
lambda  
try
:::
:::{grid-item}
as  
def  
from  
nonlocal  
while
:::
:::{grid-item}
assert  
del  
global  
not  
with
:::
:::{grid-item}
async  
elif  
if  
or  
yield
:::
::::

### Python Built-iin Functions
The Python interpreter has a number of functions and types built into it that are always available. Built-iin functions come prepackaged with the language and are ready-to-use, so you don’t need to import any modules to access them. Built-in functions represent the essential capabilities of the programming language such as:
- working with data types 
- performing calculations 
- handling input/output  

Some examples of built-in functions are: 
- `print()`) for displaying output) 
- `len()` for finding the length of a sequence 
- `type()` for checking the data type of a value 
- `range()` for generating sequences of numbers 
- `input()` for reading user input

A number of the built-in functions are constructor functions that can perform type casting. For example:
```{code-cell}
>>> x = int(1)   # x will be 1
>>> y = int(2.8) # y will be 2
>>> z = int("3") # z will be 3
```


```{figure} ../../images/python-builtin-functions.png
---
width: 400px
name: python-builtin-functions
---
[Python Built-iin Functions](https://docs.python.org/3/library/functions.html#built-in-functions)
```



## Input and Output

In Python, basic input and output operations are handled primarily by the input() and print() functions.

### input()

The input() function is used to obtain user input from the command line. It displays a prompt for the user to enter text and press Enter. The function then returns the entered text as a string.

```{code-cell}
name = input("Enter your name: ")
print(f"Hello, {name}!")
```

```{code-cell}
>>> num = input("Enter an integer between 1 and 10: ")
Enter an integer between 1 and 10: 7
>>> num
'7'
>>> type(num)
<class 'str'>
>>>
```

### print()

The print function is a Python built-in function that output text. In Jupyter Notebook, typing the variable name displays the value, but to officially display output in Python, we use the `print` statement.

You can pass a string **literal** directly to print() as an argument:

```{code-cell}
>>> print("Please wait while the professor is thinking...")
Please wait while the professor is thinking...
```

Mostly, you pass **variables** to print() instead of a string literal:

```{code-cell}
greeting = 'hello world'
print(greeting)
```

You can also pass **expressions** to print():

```{code-cell}
>>> x = 10
>>> y = 2
>>> print( x**y )
100
>>>
```

print() also accepts **multiple arguments** separated by **comma**:
```{code-cell}
>>> name = "Dr. Chen"
>>> age = 35
>>> print(name, age)
Dr. Chen 35
>>> 
```

You can also mix **expressions** with literals when printing using commas (a space between each item will be added):
```{code-cell}
name = "Bob"
age = 25
print("Hello,", name, "! You are", age, "years old.")
```

If you use **concatenation** (`+`) to join the arguments, you have to cast the arguments to string (note that concatenation does not add commas between arguments):

```{code-cell}
>>> print(name, age)
Dr. Chen 35
>>> print(name + age)
Traceback (most recent call last):
  File "<python-input-4>", line 1, in <module>
    print(name + age)
          ~~~~~^~~~~
TypeError: can only concatenate str (not "int") to str
>>> print(name + str(age))
Dr. Chen35
>>> 
```

**F-strings**, also called formatted string literals, are string literals that have an `f` before the opening quotation mark. They can include Python expressions enclosed in **curly braces**. Python will replace those expressions with their resulting values. F-strings are more flexible and readable and therefore is in general preferred for string formatting: 

```{code-cell} python
>>> name = "Dr. Chen"
>>> age = 35
>>> print(f"Hi, {name}, you are {age} years old!")
Hi, Dr. Chen, you are 35 years old!
>>> 
```

The `end` and `sep` parameters in the print function are used to control the output format. `end` (default to `\n`, the newline character) controls what character(s) are printed at the end of the printed text; `sep` (default to `\\` for ) specifies the separator between the values that are passed to the print() function. 

In the example below, we want to print the full path to your project folder by setting the `sep` parameter:

````{tab-set}
```{tab-item} Windows
```python
>>> import os
>>> print("C:\\", "User", os.getlogin(), "workspace", "dsm", sep="\\")
C:\\User\tychen\workspace\dsm
```

```{tab-item} macOS
```python
>>> import os
>>> print("/Users", os.getlogin(), "workspace", "dsm", sep='/')
/Users/tychen/workspace/dsm
>>> 
```
````
In this example below, we want to print all the output in one line (because each print output by default has a new line character at the end of the line) by setting the `end` parameter to a space. 

```{code-cell}
>>> for num in range(5):
...     print(num)
...
0
1
2
3
4

>>> for num in range(5):
...     print(num, end=" ")
...
0 1 2 3 4 >>>
```

## Error Messages

Divide by zero error:
```{code-cell}python
>>> x = 100
>>> x / 0
Traceback (most recent call last):
  File "<python-input-1>", line 1, in <module>
    x / 0
    ~~^~~
ZeroDivisionError: division by zero
>>> 
```

Syntax error:
```{code-cell}python
>>> import os
>>> print(f"Hello, {0s.getlogin()}! How are you?")
  File "<python-input-12>", line 1
    print(f"Hello, {0s.getlogin()}! How are you?")
                    **^**
SyntaxError: invalid decimal literal
>>> print(f"Hello, {os.getlogin()}! How are you?")
Hello, tychen! How are you?
>>>
```

## Conclusion

In this lecture, we covered lists, slice notation, how to grab things from an index, strings, print formatting, basic variable assignments, and basic arithmetic.
Key Takeaways

- Python supports basic arithmetic operations and variable assignments using intuitive syntax.
- Strings can be created with single or double quotes and support indexing and slicing.
- Print formatting allows dynamic insertion of variables into strings using the .format() method.
- Lists are ordered sequences that support indexing, slicing, appending, and nesting.

## Resources

- Python (programming language). (2024, February 20). In Wikipedia. https://en.wikipedia.org/wiki/Python_(programming_language)

```{code-cell} ipython3

```

```{bibliography}

```
