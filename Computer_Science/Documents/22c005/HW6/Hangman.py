from random import choice
f= open ("words.txt")
words = [line.strip() for line in f.readlines()]
print (choice(words))