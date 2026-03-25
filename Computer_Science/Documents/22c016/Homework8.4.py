partialWord = input("Please enter your partial word:")
dictionary = []
file = open("dictionary.txt", "r")
line = []
for word in file:
        dictionary.append(word)
        
for thisLine in partialWord:
        temp = thisLine.strip().split()
        line += temp
file.close()
alikeWords = []
for word in partialWord:
        #if the first letters aren't the same keep going through the dictionary
        if word[0] is not word[0] in dictionary:
                continue
        else:
                for word in partialWord:
                        #if the last letters are the same add the word to alikeWords
                        if word[-1:] is word[-1:] in dictionary:
                                alikeWords.append(word)
                        else:
                                continue
print alikeWords