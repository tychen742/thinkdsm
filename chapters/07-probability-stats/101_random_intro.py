from numpy import random

### random int
# for i in range(1, 101):
#     rand = random.randint(0, i)
#     print(i, ":", rand)
#     # print(i)

# print()

# for i in range (1, 101):
#     rand = random.randint(100)
#     print(i, ":", rand)


### random float: rand()
for i in range(1, 4):
    rand_float = random.rand()
    print(rand_float)
for i in range(1, 4):
    rand_float = random.rand(3)
    print(rand_float)
for i in range(1, 4):
    rand_float = random.rand(1, 4) # one row, each row contains 4 random numbers
    print(rand_float)

# for i in range(1, 6):
#     rand_float = random.rand()
#     print(rand_float)

