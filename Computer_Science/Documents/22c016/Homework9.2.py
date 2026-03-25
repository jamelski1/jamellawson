def makeNeighbors():
    words = open('words_dat.txt')
    wordList = []
    for word in words:
        wordList.append(word)
    
    dictionary = {}    
    for word in wordList:
        dictionary[word] = []
        
    for k in dictionary.iterkeys():
        for altWord in wordList:
            mismatches= 0
            for i in range(0, len(k)):
                if k[i] != altWord[i]:
                    mismatches += 1
                if mismatches > 1:
                    break
            if mismatches == 1:
                dictionary[k] += [altWord]
    return dictionary
    
dictionary = makeNeighbors()    
previousCount = 0
for k in dictionary.iterkeys():
    #count = 0
    L = dictionary[k]
    count = len(L)
    if count >= previousCount:
        previousCount = count
        
        

    #for item in dictionary[k]:
        #count += 1

for k, val in dictionary.iteritems():
    count = len(val)
    if count == previousCount:
        print k, val
    if count == 0:
        print k, val
    if count == 1:
        print k, val
    
                   
        
