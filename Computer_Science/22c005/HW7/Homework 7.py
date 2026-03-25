def getLetterFrequencyTable (wordList):
    alphabetlist = [letter for letter in 'abcdefghijklmnopqrstuvwxyz']
    frequencyList = []
    for letter in alphabetlist:
        count = 0
        for word in wordList:
            for char in word:
                if char == letter:
                    count += 1
        frequencyList.append(count)
    return [alphabetlist,frequencyList]
def getStrikesFrequencyTable (strikeslist):
    numberList = range(27)
    frequencyList = []
    for number in numberList:
        count = 0
        for strikes in strikeslist:
            if strikes == number:
                count += 1
        frequencyList.append(count)
    return [numberList, frequencyList]
def printHistogram (table, number):
    for i in range(len(table[0])-1):
        j = i + 1
        temp = [table[0][j],table[1][j]]
        while(j > 0 and temp[1] > table[1][j-1]):
            table[0][j] = table[0][j-1]
            table[1][j] = table[1][j-1]
            j = j - 1
        table[0][j] = temp[0]
        table[1][j] = temp[1]
    
f= open ("words.txt")
words = [line.strip() for line in f.readlines()]
print getLetterFrequencyTable (words)
print getStrikesFrequencyTable ([9,11,7,9,7])
printHistogram( getStrikesFrequencyTable([9, 11, 7, 9, 7]), 1.0 ) 