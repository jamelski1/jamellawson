animal = "elephant"
firstLetter = animal[1]
print(firstLetter)

#That's strange. Why did python print out the second letter? This is
#because computer scientists normally start counting from zero. So
#lets try this again, substitutiong our 1 with a 0.
firstLetter = animal [0]
print(firstLetter)

#Now let's find the length.
length = len(animal)
print(length)

#Since len returns the number of characters in our string let's use
#it to retrieve the last letter of our string.
lastLetter = animal[length-1]
print (lastLetter)

#We can also use negative indices. Using one tells Python to begin at
# the end of the string. So for example -1 gives the last character of
# a string, -2 the second to last and so on.
lastLetter = animal [-1]
print(lastLetter)