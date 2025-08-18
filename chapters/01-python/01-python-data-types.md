Python Crash Course - Part 1
Introduction to Python Crash Course - Part 1
In this lecture, we begin our discussion of Python by going over basic data types. The lecture demonstrates where to find the Jupyter notebooks for this series and how to access the Python crash course notebook.

Basic Numbers and Arithmetic
Python has two basic number types: the integer (e.g., 1) and the floating point number (e.g., 1.0). With either of these numbers, you can perform basic arithmetic as expected.

python Code Sample
1 + 1
1 * 3
1 / 2
2 ** 4
For addition, use the plus sign. For multiplication, use the asterisk. Division is performed with a forward slash. Note that dividing two integers results in a floating point number. For exponents, use two asterisks together. Python follows the order of operations, and you can use parentheses to clarify the order.

python Code Sample
2 + 3 * 5 + 5
2 + 3 * (5 + 5)
The modulus operation (also known as the mod function) is represented by the percent sign in Python. It returns what remains after the division.

python Code Sample
4 % 2
5 % 2
8 % 2
Variable Assignments
Variables are assigned using the equal sign. Choose a variable name and assign an object or data type to it.

python Code Sample
var = 2
x = 2
y = 3
x + y
x = x + x
Variable names should not start with numbers or special symbols. Use lowercase letters, and to chain together multiple words, use underscores.

python Code Sample
#12var = 12
#$var = 5
name_of_var = 10
Strings in Python
Strings can be created using single or double quotes. You can also wrap double quotes around single quotes if you need to include a quote inside the string.

python Code Sample
'hello'
"hello"
"I can't go"
Printing Strings and Print Formatting
Assign a string to a variable and print it. In Jupyter Notebook, typing the variable name displays the value, but to officially display output in Python, use the print statement.

python Code Sample
x = 'hello'
print(x)
Print Formatting with .format()
You can format print statements by inserting curly brackets in your string and using the .format() method to fill them with variable values.

python Code Sample
num = 12
name = 'Sam'
print('My number is {} and my name is {}'.format(num, name))
You can also use named placeholders inside the curly brackets and specify which variable fills each placeholder in the .format() call.

python Code Sample
print('My number is {one} and my name is {two}. More: {one}'.format(one=num, two=name))
Indexing and Slicing Strings
Strings are sequences of characters. You can access specific elements using square bracket notation. Python indexing starts at zero.

python Code Sample
s = 'hello'
s[0]
s[4]
Slice notation allows you to grab parts of a string. Use a colon to specify the start and end indices. The end index is not included.

python Code Sample
s = 'abcdefghijk'
s[0:]
s[:3]
s[3:6]
Lists in Python
Lists are sequences of elements in square brackets, separated by commas. Lists can contain any data type, including other lists.

python Code Sample
my_list = ['a', 'b', 'c']
my_list.append('d')
my_list[0]
my_list[1:3]
my_list[0] = 'NEW'
Lists can be nested inside each other. You can access elements in nested lists by chaining square brackets.

python Code Sample
lst = [1, 2, [3, 4]]
lst[2][1]
For deeper nesting, continue stacking brackets to access the desired element.

python Code Sample
nest = [1, 2, 3, [4, 5, ['target']]]
nest[3][2][0]
print(nest[3][2][0])
Conclusion
In this lecture, we covered lists, slice notation, how to grab things from an index, strings, print formatting, basic variable assignments, and basic arithmetic.

Key Takeaways
Python supports basic arithmetic operations and variable assignments using intuitive syntax.
Strings can be created with single or double quotes and support indexing and slicing.
Print formatting allows dynamic insertion of variables into strings using the .format() method.
Lists are ordered sequences that support indexing, slicing, appending, and nesting.
