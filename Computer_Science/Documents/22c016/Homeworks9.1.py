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
               
            
    #dictionary['above'] += ['abode']
    return dictionary
    
    
dictionary = makeNeighbors()    

    






















print dictionary