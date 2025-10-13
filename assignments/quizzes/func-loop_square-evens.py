def square_evens(nums):                                     ### define function; takes a list as input
    return [ num**2 for num in nums if num % 2 == 0 ]       ### return a list of squares of even numbers

nums = list( range(1, 10) )                                 ### create a list of numbers from 1 to 9       
results = square_evens(nums)                                ### call the function with the list

for num in results:                                         ### iterate through the results
    print(num, end=" ")                                     ### print each squared even number followed by a space   

print()                                                     ### print a newline at the end  
    
##### the for loop version if you are not familiar with list comprehensions

def square_evens_loop(nums):
    results = []
    for num in nums:
        if num%2 == 0:
            results.append(num**2)
    
    return results