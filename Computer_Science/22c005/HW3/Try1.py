# 00675720
# Jamel Lawson

def patternIndex (filename, pattern): 
    total= 0
    f= open(filename)
    linenumber= 1
    for line in f:
        patternIndex= 0
        count= 0
        for i in line:
            if pattern[patternIndex] == i:
                patternIndex= patternIndex + 1
            else:
                patternIndex= 0
            if patternIndex== len(pattern):
                return([linenumber, count-len(pattern) + 1])
            count= count +1
        linenumber= linenumber + 1
        
    return([-1, -1])    
