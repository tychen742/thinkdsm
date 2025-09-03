---
jupytext:
  text_representation:
    extension: .md
    format_name: myst
    format_version: 0.13
    jupytext_version: 1.17.2
kernelspec:
  display_name: Python 3 (ipykernel)
  language: python
  name: python3
---

# Lists

Lists are one of Python's most useful built-in type. In Python, a list is a **sequence**, meaning it is an ordered collection of items that can store multiple values in a single variable. Lists are extremely flexible because they can hold elements of different data types, such as numbers, strings, or even other lists, and they can be changed after creation by adding, removing, or modifying items. Like a string, a **list** is a sequence of values. In a string, the
values are characters; in a list, they can be any type.
The values in a list are called **elements**.

Some basic properties of Python lists are as seen in {numref}`property-python-lists`.

```{list-table} Properties of Python Lists
:header-rows: 1
:name: property-python-lists

- - Property
  - Description
- - **Ordered**
  - Elements maintain the order in which they were added and can be accessed by index (starting at 0).
- - **Mutable**
  - You can change, add, or remove elements after the list is created.
- - **Allows Duplicates**
  - Lists can contain repeated values without restriction.
- - **Dynamic Size**
  - The length of a list can grow or shrink as elements are added or removed.
- - **Heterogeneous**
  - A single list can hold items of different data types (e.g., integers, strings, objects).
```

## Basic Operations

Basic Python list operations include:

- Creating lists
- Indexing (mylist[0], mylist[-1])
- Slicing (mylist[1:4], mylist[::-1])
- Length with len()
- Iterating through lists (for loops, while loops)

### Creating Lists

The simplest to create a list is to enclose the elements in square brackets (`[` and `]`) and we usually assign the created list to a variable name. For example, here is a list of two integers:

```{code-cell} ipython3
numbers = [ 1, 2, 3, 4, 5 ]
```

And here's a list of three strings:

```{code-cell} ipython3
fruits = [ 'apple', 'banana', 'cherry']
```

The elements of a list don't have to be the same type. The following list contains a string, a float, an integer, and even another list. This list is therefore **heterogeneous**:

```{code-cell} ipython3
t = ['spam', 2.0, 5, [10, 20]]
```

A list within another list is called a **nested** list, which are important because they let you represent more complex data structures, such as tables, matrices, and provide a stepping stone to understanding multi-dimensional arrays for advanced data science processing.

A list that contains no elements is called an empty list, which can be created with empty brackets, `[]`.

```{code-cell} ipython3
empty = []
```

### Indexing

In Python, list indexing is the process of accessing individual elements within a list using their position. List indices work as:

- Python uses **zero-based indexing**, which means the first element has index 0, the second has index 1, and so on.
- Any integer expression can be used as an index.
- If you try to read or write an element that does not exist, you get
  an `IndexError`.
- If an index has a negative value, it counts backward from the end of
  the list beginning with `-1`.

With 0-based indexing and negative indexing, list indexing looks like {numref}`list-indexing`.

```{figure} ../../images/list-indexing.png
---
width: 450px
name: list-indexing
---
[Python List Indexing](https://www.geeksforgeeks.org/python/slicing-with-negative-numbers-in-python/)
```


To access an element of a list, we can use the bracket operator. The index of the first element is `0`.

```{code-cell} ipython3
fruits = [ "apple", "banana", "cherry" ]
fruits[0]                       ### 'apple'
```

Although a list can contain another list, the nested list still counts as a single element -- so in the following list, there are only four elements.

```{code-cell} ipython3
t = ['spam', 2.0, 5, [10, 20]]
len(t)                          ### 4
```

### Modifying Elements

Unlike strings, lists are **mutable**. When the bracket operator appears on
the left side of an assignment, it identifies the element of the list
that will be assigned.

```{code-cell} ipython3
fruits = [ "apple", "banana", "cherry" ]
fruits[0] = "avocado"
fruits[0]                                   ### is now 'avocado'
```

### List Slicing

Things to know about list slicing:
- Slicing makes a **new list** from a portion of the elements of the original ist.
- The list slicing syntax uses colon(s) and index parameters inside the square brackets following the list variable name; for example, 
- The start index is inclusive but the stop index in **exclusive**; for example, nums[1:3]. would return a new list containing the elements from index[1] (inclusive) to index[3] (exclusive).
- There are 3 index parameters in the square brackets and they are all optional: **start**, **stop**, **step**. Although we mostly only use the start index and stop index. 

The following example selects the second and third elements from a list of four letters. 

```{code-cell} ipython3
letters = ['a', 'b', 'c', 'd']
letters[1:3]                            ### ['b', 'c']
```

If you omit the first index, the slice starts at the beginning.

```{code-cell} ipython3
letters[:2]                             ### ['a', 'b']
```

If you omit the second, the slice goes to the end.

```{code-cell} ipython3
letters[2:]                             ### ['c', 'd']
```

So if you omit both, the slice is a copy of the whole list.

```{code-cell} ipython3
letters[:]                              ### ['a', 'b', 'c', 'd']
```

Because `list` is the name of a built-in function, you should avoid using it as a variable name.


### Python Functions

Some Python built-in functions are useful when working with lists:

- len()
- min()
- max()
- sum()

The `len` function returns the length of a list.

```{code-cell} ipython3
cheeses = ['Cheddar', 'Edam', 'Gouda']
len(cheeses)
```

The length of an empty list is `0`.

```{code-cell} ipython3
>>> empty = []
>>> empty
[]
>>> len(empty)
0
```

No other mathematical operators work with lists, but the built-in function `sum` adds up the elements.

```{code-cell} ipython3
t1 = [1, 2]
sum(t1)                         ### 3
```

And `min` and `max` find the smallest and largest elements.

```{code-cell} ipython3
t1 = [1, 2]
min(t1)                         ### 1
```

```{code-cell} ipython3
t1 = [1, 2]
max(t2)                         ### 2
```

### List Methods

Python also has a set of built-in methods that you can use on lists. Commonly used list methods include:

- len()
- sum()
- minx()
- max()
- append()
- extend()
- pop()
- remove()

#### The Dot Notation
Use the dot notation (`.`), you can show the methods a list object has. Just type the name of the list plus `.` and hit the Tab key twice:

```{code-cell} bash
>>> nums = [ 1, 2, 3 ]
>>> nums.
t1.append(    t1.copy()     t1.extend(    t1.insert(    t1.remove(    t1.sort(
t1.clear()    t1.count(     t1.index(     t1.pop(       t1.reverse()
```

#### append
Python provides methods that operate on lists. For example, `append`
adds a new element to the end of a list:

```{code-cell} ipython3
>>> letters = ['a', 'b', 'c', 'd']
>>> letters
['a', 'b', 'c', 'd']
>>> letters.append("e")
>>> letters
['a', 'b', 'c', 'd', 'e']
letters                         ### ['a', 'b', 'c', 'd', 'e']
```

#### extend
`extend` takes a **list as an argument** (not values) and appends all of the elements to the original list:

```{code-cell} ipython3
>>> letters.extend('f', 'g')
Traceback (most recent call last):
  File "<python-input-33>", line 1, in <module>
    letters.extend('f', 'g')
    ~~~~~~~~~~~~~~^^^^^^^^^^
TypeError: list.extend() takes exactly one argument (2 given)
letters                         ### ['a', 'b', 'c', 'd', 'e']
letters.extend(['f', 'g'])
letters                         ### ['a', 'b', 'c', 'd', 'e', 'f', 'g']
```

#### pop
There are two methods that remove elements from a list: pop() and remove()
If you know the index of the element you want, you can use `pop`: 
- If you provide an index as the argument, pop() **removes and returns** the element at that index.
- If you do not provide an index as argument, pop() remove and return the last element in the list.

```{code-cell} ipython3
>>> nums = [1, 2, 3, 4 ,5]
>>> nums.pop(1)                 ### pop(1) removes and returns the 2nd element in list. 
2
>>> nums
[1, 3, 4, 5]
>>> nums.pop()                  ### pop() removes & returns the last element.
5
>>> nums
[1, 3, 4]
>>> 
```

#### remove
On the other hand, if you know the element you want to remove (but not the index), you can use `remove`:

```{code-cell} ipython3
>>> nums = [1, 2, 3, 4 ,5]
>>> nums.remove(3)
>>> nums
[1, 2, 4, 5]
```

If the element you ask for is not in the list, that's a ValueError.

```{code-cell} ipython3
>>> nums
[1, 2, 4, 5]
>>> nums.remove(6)
Traceback (most recent call last):
  File "<python-input-48>", line 1, in <module>
    nums.remove(6)
    ~~~~~~~~~~~^^^
ValueError: list.remove(x): x not in list
```

## Other operations

Operators like `in`, `+`, and `*` are used on lists as well.

The `in` operator works on lists -- it checks whether a given element appears anywhere in the list.

```{code-cell} ipython3
fruits = [ "apple", "banana", "cherry" ]
'banana' in fruits              ### True
```

And `10` is not considered to be an element of `t` because it is an element of a nested list, not `t`.

```{code-cell} ipython3
t = ['spam', 2.0, 5, [10, 20]]
10 in t                         ### False
```

The `+` operator concatenates lists.

```{code-cell} ipython3
t1 = [1, 2]
t2 = [3, 4]
t1 + t2                         ### [1, 2, 3, 4]
```

The `*` operator repeats a list a given number of times.

```{code-cell} ipython3
['spam'] * 4                    ### ['spam', 'spam', 'spam', 'spam']
[ 1, 2, 3 ] * 3                 ### [1, 2, 3, 1, 2, 3, 1, 2, 3]
```

## Lists and strings

A string is a sequence of characters and a list is a sequence of values,
but a list of characters is not the same as a string.
To convert from a string to a list of characters, you can use the `list` function.

```{code-cell} ipython3
>>> s = 'spam'
>>> t = list(s)
>>> t
['s', 'p', 'a', 'm']
>>> 
```

The `list` function breaks a string into individual letters.
If you want to break a string into words, you can use the `split` method:

```{code-cell} ipython3
>>> s = 'pining for the fjords'
>>> t = s.split()
>>> t
['pining', 'for', 'the', 'fjords']
```

The list function breaks a string into individual letters. If you want to break a string into words, you can use the `split` method:

```{code-cell}
>>> s = 'pining for the fjords'
>>> t = s.split()
>>> t
['pining', 'for', 'the', 'fjords']
```

An optional argument called a **delimiter** specifies which characters to use as word boundaries. The following example uses a hyphen as a delimiter.

```{code-cell} ipython3
>>> s = 'ex-parrot'
>>> t = s.split('-')                ### note that this returns a list
>>> t
['ex', 'parrot']
```

If you have a list of strings, you can concatenate them into a single string using `join`.
`join` is a string method, so you have to invoke it on the delimiter and pass the list as an argument.

```{code-cell} ipython3
>>> delimiter = ' '
>>> t = ['pining', 'for', 'the', 'fjords']
>>> s = delimiter.join(t)
>>> s
'pining for the fjords'
```

In this case the delimiter is a space character, so `join` puts a space
between words. To join strings without spaces, you can use the empty string, `''`, as a delimiter.


## Sorting lists

Python provides a built-in function called `sorted` that sorts the elements of a list.

```{code-cell} ipython3
>>> scramble = ['c', 'a', 'b']
>>> sorted(scramble)
['a', 'b', 'c']
```

The original list is unchanged.

```{code-cell} ipython3
>>> scramble
['c', 'a', 'b']
```

`sorted` works with any kind of sequence, not just lists. So we can sort the letters in a string like this.

<!-- ```{code-cell} ipython3
sorted('letters')
```

The result is a list.
To convert the list to a string, we can use `join`.

```{code-cell} ipython3
''.join(sorted('letters'))
```

With an empty string as the delimiter, the elements of the list are joined with nothing between them.

+++ -->

## Objects and Values

If we run these assignment statements:

```{code-cell} ipython3
a = 'banana'
b = 'banana'
```

We know that `a` and `b` both refer to a string, but we don't know whether they refer to the _same_ string. There are two possible states, shown in the following figure.

```{code-cell} ipython3
>>> a = 'banana'
>>> b = 'banana'
>>> a == b
True
>>> a is b
True
```

In this example, Python only created one string object, and both `a`
and `b` refer to it. But when you create two lists, you get two objects.

```{code-cell} ipython3
>>> a = [ 1, 2, 3 ]
>>> b = [ 1, 2 ,3 ]
>>> a == b
True
>>> a is b
False
>>> 
```

In this case we would say that the two lists are **equivalent**, because they have the same elements, but not **identical**, because they are not the same object.
If two objects are identical, they are also equivalent, but if they are equivalent, they are not necessarily identical.

## Aliasing

If `num_a` refers to an object and you assign `num_b = num_a`, then both variables refer to the **same object**.

```{code-cell} ipython3
>>> nums_a = [ 1, 2, 3, 4, 5 ]
>>> nums_b = nums_a
>>> nums_a == nums_b
True
>>> nums_a is nums_b
True

```

The association of a variable with an object is called a **reference**. In this example, there are two references to the same object.

An object with more than one reference has more than one name, so we say the object is **aliased**. If the aliased object is mutable, changes made with one name affect the other. In this example, if we change the object `nums_a` refers to, we are also changing the object `nums_a` refers to. 

```{code-cell} ipython3
>>> nums_a = [ 1, 2, 3, 4, 5 ]
>>> nums_a[0] = 1000
>>> nums_a
[1000, 2, 3, 4, 5]
```

<!-- So we would say that `nums_a` "sees" this change. Although this behavior can be useful, it is error-prone. In general, it is safer to avoid aliasing when you are working with mutable objects. -->

<!-- For immutable objects like strings, aliasing is not as much of a problem.
In this example:

```{code-cell} ipython3
string_a = 'banana'
string_b = 'banana'
```

It almost never makes a difference whether `a` and `b` refer to the same
string or not.

+++ -->


<!-- ## Making a word list

In the previous chapter, we read the file `words.txt` and searched for words with certain properties, like using the letter `e`.
But we read the entire file many times, which is not efficient.
It is better to read the file once and put the words in a list.
The following loop shows how.

```{code-cell} ipython3
download('https://raw.githubusercontent.com/AllenDowney/ThinkPython/v3/words.txt');
```

```{code-cell} ipython3
word_list = []

for line in open('words.txt'):
    word = line.strip()
    word_list.append(word)

len(word_list)
```

Before the loop, `word_list` is initialized with an empty list.
Each time through the loop, the `append` method adds a word to the end.
When the loop is done, there are more than 113,000 words in the list.

Another way to do the same thing is to use `read` to read the entire file into a string.

```{code-cell} ipython3
string = open('words.txt').read()
len(string)
```

The result is a single string with more than a million characters.
We can use the `split` method to split it into a list of words.

```{code-cell} ipython3
word_list = string.split()
len(word_list)
```

Now, to check whether a string appears in the list, we can use the `in` operator.
For example, `'demotic'` is in the list.

```{code-cell} ipython3
'demotic' in word_list
```

But `'contrafibularities'` is not.

```{code-cell} ipython3
'contrafibularities' in word_list
```

And I have to say, I'm anaspeptic about it.

## Debugging

Note that most list methods modify the argument and return `None`.
This is the opposite of the string methods, which return a new string and leave the original alone.

If you are used to writing string code like this:

```{code-cell} ipython3
word = 'plumage!'
word = word.strip('!')
word
```

It is tempting to write list code like this:

```{code-cell} ipython3
t = [1, 2, 3]
t = t.remove(3)           # WRONG!
```

`remove` modifies the list and returns `None`, so next operation you perform with `t` is likely to fail.

```{code-cell} ipython3
%%expect AttributeError

t.remove(2)
```

This error message takes some explaining.
An **attribute** of an object is a variable or method associated with it.
In this case, the value of `t` is `None`, which is a `NoneType` object, which does not have a attribute named `remove`, so the result is an `AttributeError`.

If you see an error message like this, you should look backward through the program and see if you might have called a list method incorrectly.

+++ -->

## Glossary

**list:**
An object that contains a sequence of values.

**element:**
One of the values in a list or other sequence.

**nested list:**
A list that is an element of another list.

**delimiter:**
A character or string used to indicate where a string should be split.

**equivalent:**
Having the same value.

**identical:**
Being the same object (which implies equivalence).

**reference:**
The association between a variable and its value.

**aliased:**
If there is more than one variable that refers to an object, the object is aliased.

**attribute:**
One of the named values associated with an object.


<!-- ## Exercises

```{code-cell} ipython3
# This cell tells Jupyter to provide detailed debugging information
# when a runtime error occurs. Run it before working on the exercises.

%xmode Verbose
```

### Ask a virtual assistant

In this chapter, I used the words "contrafibularities" and "anaspeptic", but they are not actually English words.
They were used in the British television show _Black Adder_, Season 3, Episode 2, "Ink and Incapability".

However, when I asked ChatGPT 3.5 (August 3, 2023 version) where those words came from, it initially claimed they are from Monty Python, and later claimed they are from the Tom Stoppard play _Rosencrantz and Guildenstern Are Dead_.

If you ask now, you might get different results.
But this example is a reminder that virtual assistants are not always accurate, so you should check whether the results are correct.
As you gain experience, you will get a sense of which questions virtual assistants can answer reliably.
In this example, a conventional web search can identify the source of these words quickly.

If you get stuck on any of the exercises in this chapter, consider asking a virtual assistant for help.
If you get a result that uses features we haven't learned yet, you can assign the VA a "role".

For example, before you ask a question try typing "Role: Basic Python Programming Instructor".
After that, the responses you get should use only basic features.
If you still see features we you haven't learned, you can follow up with "Can you write that using only basic Python features?"

+++ -->

<!-- ### Exercise

Two words are anagrams if you can rearrange the letters from one to spell the other.
For example, `tops` is an anagram of `stop`.

One way to check whether two words are anagrams is to sort the letters in both words.
If the lists of sorted letters are the same, the words are anagrams.

Write a function called `is_anagram` that takes two strings and returns `True` if they are anagrams.

+++

To get you started, here's an outline of the function with doctests.

```{code-cell} ipython3
def is_anagram(word1, word2):
    """Checks whether two words are anagrams.

    >>> is_anagram('tops', 'stop')
    True
    >>> is_anagram('skate', 'takes')
    True
    >>> is_anagram('tops', 'takes')
    False
    >>> is_anagram('skate', 'stop')
    False
    """
    return None
```

```{code-cell} ipython3
# Solution goes here
```

You can use `doctest` to test your function.

```{code-cell} ipython3
from doctest import run_docstring_examples

def run_doctests(func):
    run_docstring_examples(func, globals(), name=func.__name__)

run_doctests(is_anagram)
```

Using your function and the word list, find all the anagrams of `takes`.

```{code-cell} ipython3
# Solution goes here
```

### Exercise

Python provides a built-in function called `reversed` that takes as an argument a sequence of elements -- like a list or string -- and returns a `reversed` object that contains the elements in reverse order.

```{code-cell} ipython3
reversed('parrot')
```

If you want the reversed elements in a list, you can use the `list` function.

```{code-cell} ipython3
list(reversed('parrot'))
```

Or if you want them in a string, you can use the `join` method.

```{code-cell} ipython3
''.join(reversed('parrot'))
```

So we can write a function that reverses a word like this.

```{code-cell} ipython3
def reverse_word(word):
    return ''.join(reversed(word))
```

A palindrome is a word that is spelled the same backward and forward, like "noon" and "rotator".
Write a function called `is_palindrome` that takes a string argument and returns `True` if it is a palindrome and `False` otherwise.

+++

Here's an outline of the function with doctests you can use to check your function.

```{code-cell} ipython3
def is_palindrome(word):
    """Check if a word is a palindrome.

    >>> is_palindrome('bob')
    True
    >>> is_palindrome('alice')
    False
    >>> is_palindrome('a')
    True
    >>> is_palindrome('')
    True
    """
    return False
```

```{code-cell} ipython3
# Solution goes here
```

```{code-cell} ipython3
run_doctests(is_palindrome)
```

You can use the following loop to find all of the palindromes in the word list with at least 7 letters.

```{code-cell} ipython3
for word in word_list:
    if len(word) >= 7 and is_palindrome(word):
        print(word)
```

### Exercise

Write a function called `reverse_sentence` that takes as an argument a string that contains any number of words separated by spaces.
It should return a new string that contains the same words in reverse order.
For example, if the argument is "Reverse this sentence", the result should be "Sentence this reverse".

Hint: You can use the `capitalize` methods to capitalize the first word and convert the other words to lowercase.

+++

To get you started, here's an outline of the function with doctests.

```{code-cell} ipython3
def reverse_sentence(input_string):
    '''Reverse the words in a string and capitalize the first.

    >>> reverse_sentence('Reverse this sentence')
    'Sentence this reverse'

    >>> reverse_sentence('Python')
    'Python'

    >>> reverse_sentence('')
    ''

    >>> reverse_sentence('One for all and all for one')
    'One for all and all for one'
    '''
    return None
```

```{code-cell} ipython3
# Solution goes here
```

```{code-cell} ipython3
run_doctests(reverse_sentence)
```

### Exercise

Write a function called `total_length` that takes a list of strings and returns the total length of the strings.
The total length of the words in `word_list` should be $902{,}728$.

```{code-cell} ipython3
# Solution goes here
```

```{code-cell} ipython3
# Solution goes here
```

```{code-cell} ipython3

``` -->

[Think Python: 3rd Edition](https://allendowney.github.io/ThinkPython/index.html)

Copyright 2024 [Allen B. Downey](https://allendowney.com)

Code license: [MIT License](https://mit-license.org/)

Text license: [Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International](https://creativecommons.org/licenses/by-nc-sa/4.0/)
