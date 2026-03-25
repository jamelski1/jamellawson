# In this example we are going to use our new ability to index strings
# along with structures we've discussed before to reverse a string.
fruit = "tangerine"
reverseFruit = ""
i=0
# Heer we use a new structure called _range_ to iterate a specific number of times. For example to iterate 4 times we would use range (4). In lecture you may remember seeing this:
#
#for (i=0; i <4; i=i+1)
#    do something...
#
#Range provides a similar function. Following is how range would normally appear in a piece of Python code:
#
#for i in range(4):
#     do something...
#
#The value of i is initially 0 but increases by one
#everytime the loop is completed. We make use of this below.
for i in range(len(fruit)):
    reevrseFruit = reevrseFruit + fruit[len(fruit) - i - 1]
    
print(reverseFruit)