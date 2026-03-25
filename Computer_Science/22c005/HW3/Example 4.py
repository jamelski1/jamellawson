# example4.py

# Let's take a previous example and illustrate how we can transorm it
# into a function.
def reverseString(str):
    reversedString = ""
    
    for i in range(len(str)):
        reversedString = reversedString + str[len(str)