# Takes a line s and replaces all punctuation marks given
# in the list punctuationMarkes by blanks; returns the modified list
def filterOutPunctuation(punctuationMarks, s):
	for mark in punctuationMarks:
		s = s.replace(mark, " ")
	return s


# Creates from the raw list, dictionaries containing words of length 1, length 2, length 3, length 4, and 
# a separate dictionary for longer words. In each dictionary the words are the keys and their frequencies
# are the values.
def processWords(L):
	wordDict = [{}, {}, {}, {}, {}]
	for word in L:
		if len(word) <= 4:
			wordLength = len(word)
		else:
			wordLength = 5
			
		if word in wordDict[wordLength-1]:
			wordDict[wordLength-1][word] += 1
		else:
			wordDict[wordLength-1][word] = 1
			
	return wordDict
	
		
# Makes all the words in the wordList have lower case
def makeLower(wordList):
	for i in range(len(wordList)):
		wordList[i] = wordList[i].lower()

#Main program
fileNames = ["alice.txt", "carol.txt", "hyde.txt", "war.txt", "gulliver.txt", "treasure.txt"]
L = []
punctuationMarks = map(chr, range(0, ord("A")) + range(ord("Z")+1, ord("a")) + range(ord("z")+1, 127))

# Loop that processes all 6 input text files
for name in fileNames:
	f = open(name)	
	bigString = f.read()	# read the entire text file in one go
	bigString = filterOutPunctuation(punctuationMarks, bigString)	
	wordList = bigString.split()
	makeLower(wordList)
	L.extend(wordList)
	f.close()

# Turn the raw word list into useful dictionaries
wordList = processWords(L)

# Block of code that produces output
f = open("project1Output.txt", "w")
for item in wordList:
	sortedWords = []
	# Turn a dictionary into a list of size-2 sublists in which the 
        # frequency appears first and the word appear next
	for k in item:
		sortedWords.append([item[k], k])

	# Sort by frequencies, since they show up first
	sortedWords.sort()

	# Print
	for item in sortedWords:
		f.write(item[1] + " " + str(item[0]) + "\n")

f.close()

