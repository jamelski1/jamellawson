def makeNeighbors():
    wordList = open('words_dat.txt')
    stringWordList = ''
    for line in wordList:
        stringWordList += line
    
    dictionary = {}    
    for word in stringWordList.split():
        dictionary[word] = []
    for k in dictionary.iterkeys():
        for thing in stringWordList.split():
            mismatches=0
            k[0]==thing[0]
            
    #dictionary['above'] += ['abode']
    return dictionary
    
    
dictionary = makeNeighbors()    

    






















print dictionary