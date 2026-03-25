import random
import time

def generateString(number):
    
    #redundant but it helps me think it through
    count = number
    
    #creates a dictionary corrilating the numbers 1-4 to the letters A, T, C, and G
    characters = {1 : 'A', 2: 'T', 3: 'C', 4: 'G'}
    
    #initiate a new List
    newList = []
    #initiate a new String
    printString = ''
    
    #goes through the numbers 0 through count minus 1 and adds a random number 1-4 to the variable newList
    for i in range(count):
        newList += [random.randint(1,4)]
    
    #goes through the variable newList, refers the the dictionary characters 
    #and adds the characters to the variable printString to give the ending result    
    for i in newList:
        printString += characters[i]
        
    return printString

#use a for loop
def DNAswap(myString):
    random = ''
    #for item in concrete:
    for item in myString:
        if item == 'A':
            random += 'T'
        elif item == 'T':
            random += 'A'
        elif item == 'C':
            random += 'G'
        elif item == 'G':
            random += 'C'
    return (random)

#use a while loop:
def DNAswap2(myString):
    random = ''
    count = 0
    while count < len(myString):
        if myString[count] == 'A':
            random += 'T'
        elif myString[count] == 'T':
            random += 'A'
        elif myString[count] == 'C':
            random += 'G'
        elif myString[count] == 'G':
            random += 'C'
        count += 1
    return (random)

def DNAswap3(myString):
    new1 = myString.replace('A', 'Z')
    new2 = new1.replace('T', 'A')
    new3 = new2.replace('Z', 'T')
    new4 = new3.replace('G', 'Y')
    new5 = new4.replace('C', 'G')
    new6 = new5.replace('Y', 'C')
    return new6

#use a dictionary
def DNAswap4(myString):
    dictionary = {'A': 'T', 'T': 'A', 'G':'C', 'C': 'G'}
    random = ''
    for element in myString:
        random += dictionary[element]
    return (random)

def compareMethods():
    start = time.time()
    a = DNAswap(generateString(20000))
    stop = time.time()
    
    a1 = stop - start
    
    
    start = time.time()
    b = DNAswap2(generateString(20000))
    stop = time.time()
        
    b1 = stop - start
    
    start = time.time()
    c = DNAswap3(generateString(20000))
    stop = time.time()
        
    c1 = stop - start
    
    start = time.time()
    d = DNAswap(generateString(20000))
    stop = time.time()
    
    d1 = stop - start
    print 'DNAswap = ' + str(a1) +' seconds'    
    print 'DNAswap2 = ' + str(b1) +' seconds'    
    print 'DNAswap3 = ' + str(c1) +' seconds'
    print 'DNAswap4 = ' + str(d1) +' seconds'    
    