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

dictionary =  makeNeighbors()

def threeNeighbors(dictionary, word):
    word = raw_input("Please enter an English 5 letter word:")
    
    value = dictionary[word]
    answers = []
    
    #for firstStep in values:
        #answers[firstStep] = []
        
    for word in values:
        OneHop = dictionary[word]
        for otherWord in OneHop:
            TwoHop = dictionary[word]
            for nextWord in TwoHop:
                ThreeHop = dictionary[word]
                if ThreeHop == []:
                    continue
                else:
                    answers += [ThreeHop]
    return answers
                
                
#dictionary = {"stale": ["stalk", "stole", "stall", "style"], "stole": ["stale", "style", "stone", "stove"], "stone":["stabe", "stove", "scone"]} #makeNeighbors()  
dictionary = {"stale": ["stole"], "stole": ["stone"], "stone":["stole","scone"]}

answer = threeNeighbors(dictionary)

print answer