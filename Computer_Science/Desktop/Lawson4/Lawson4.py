import random

def fileToList(x):
    
            
    input_file = open(x)
    line = []


    for thisLine in input_file:
        temp = thisLine.strip().replace(".", "").replace(",", "").replace(";", "").replace("?", "").replace("!", "").replace("'s", "").replace("(", "").replace(")", "").replace("-", "").replace("*", "").replace("1", "").replace("2", "").replace("3", "").replace('"', "").replace("'", "").replace(":", "").replace("`", "").replace("&", "").replace("0", "").replace("4", "").replace("5", "").replace("6", "").replace("7", "").replace("8", "").replace("9", "").replace("<", "").replace("=", "").replace("[", "").replace("]", "").replace("_", "").replace('/', "").split()
        temp = map(str.lower, temp)
        line+= temp
    input_file.close()
    return line

def newFileToList(x):
    input_file = open(x)
    line = []
    for thisLine in input_file:
        temp = thisLine.strip().replace(".", "").replace(",", "").replace(";", "").replace("?", "").replace("!", "").replace("'s", "").replace("(", "").replace(")", "").replace("-", "").replace("*", "").replace("1", "").replace("2", "").replace("3", "").replace('"', "").replace("'", "").replace(":", "").replace("`", "").replace("&", "").replace("0", "").replace("4", "").replace("5", "").replace("6", "").replace("7", "").replace("8", "").replace("9", "").replace("<", "").replace("=", "").replace("[", "").replace("]", "").replace("_", "").split()
        temp = map(str.lower, temp)
        line+= temp
    input_file.close()
    return line    

def Problem1(textFile):
    
    dictionary = []
    for s in [textFile]:
        line =  fileToList(s)
        for x in line:
            if len(x) < 3:
                continue
            elif x in dictionary:
                continue
            else:
                dictionary.append(x)
                
    
    dictionary.sort()
    outfile = open("scarydictionary.txt", "w")
    for word in dictionary:
        outfile.write(word + "\n")
    print dictionary
    outfile.close()
    
"""def Problem2(textFile, wordList):
    
    input_file = open(textFile, 'r')
    s1 = input_file.readlines()
    #s2 = s1.split()
    input_file.close()
    
    counters = {}
    
    line =  fileToList(textFile)    
    
    for i in range(len(wordList)):
        for word in line:
            if wordList[i] == word:
                if word in counters:
                    counters[word] += 1
                else:
                    counters[word] = 1
    print s1
    print line
    print 'and' in line
    print '\n' in line
    return counters
        
    
    #for i in range(len(wordList)):
        #if """

def Problem2(textFile, wordList):
    
    input_file = open(textFile, 'r')
    s1 = input_file.readlines()
    input_file.close()    
    
    s2 = str(s1)
    s3 = s2.strip().replace(']', '').replace('[', '')
    s4 = s3.split()
    lines = 0
    for i in s4:
        if i == "\n":
            lines += 1
    print '\\n' in s4
    print s2
    print lines
    
def dealHand():
    #numDict = {'2': 2, '3': 3, '4': 4, '5': 5, '6': 6, '7': 7, '8': 8, '9': 9, '10': 10, 'J': 11, 'Q': 12, 'K': 13, 'A': 14}
    suit = ['Clubs', 'Diamonds', 'Spades', 'Hearts']
    
    numbers = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A']
    possibleCards = []
    
    for i in numbers:
        for var in range(4):
            
            possibleCards += [i + ' of ' + suit[var]]
    
    mixed = []
    
    while len(mixed) < 52:
        
        for integer in range(1,53):
            temp = random.randint(1,52)
            if temp in mixed:
                pass
            else:
                mixed.append(temp)
    
    new = dict(zip(range(1,53), [i for i in possibleCards]))
    
    newList = []
    for i in mixed:
        newList.append(new[i])
        
        
    player1 = newList[0:26]
    player2 = newList[26::]
    
    return (player1, player2)

"""def shuffle(aList):
    mixed = []
    
    while len(mixed) < len(aList):
        
        for integer in range(aList):
            temp = random.randint("""

def Problem4(x):
    num1 = random.randint(1,9)
    num2 = random.randint(1,9)
    
    print str(num1) + ' ' + '+' + ' ' + str(num2) + '='
    user = raw_input("Enter answer: ")
    
    