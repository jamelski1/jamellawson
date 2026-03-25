f =  open("cipher5.txt")
frequencyCounts = [0]*26
cipherText = ""
previousGuesses = ""
for line in f:
    cipherText += line
    for ch in line:
        if ch.isupper():
            frequencyCounts[ord(ch) - ord("A")] += 1
        elif ch.islower():
            frequencyCounts[ord(ch) - ord("a")] += 1
letterCount = sum(frequencyCounts)
percentFC = []
def dissimilarity(x, y):
    return abs(x-y)/abs(x+y)
for count in frequencyCounts:
    percentFC = percentFC + [count*100.0/letterCount]
D = [8.167, 1.492, 2.782, 4.253, 12.702, 2.228, 2.015, 6.094, 6.966, 0.153, 0.772, 4.025, 2.406, 6.749, 7.507, 1.929, 0.095, 5.987, 6.327, 9.056, 2.758, 0.978, 2.360, 0.150, 1.974, 0.074]
mapping = {"a":[], "b":[], "c":[], "d":[], "e":[], "f":[], "g":[], "h":[], "i":[], "j":[], "k":[], "l":[], "m":[], "n":[], "o":[], "p":[], "q":[], "r":[], "s":[], "t":[], "u":[], "v":[], "w":[], "x":[], "y":[], "z":[]}
for plain in range(len(D)):
    for cipher in range(len(percentFC)):
        x = D[plain]
        y = percentFC[cipher]
        if dissimilarity(x, y) < 0.2:
            plainChar = chr(ord("a")+plain)
            cipherChar = chr(ord("a")+cipher)      
            mapping[plainChar].append(cipherChar)

#Attempts to Decrypts the possible cipher text
#assuming this "cipher" is cipher text and assuming "guess" is key value pair is the function body right
def decryptFunction(cipher, guess):
    tempcipher = ""
    for letter in cipher:
	if not letter in guess:
	    tempcipher += letter
	else:
	    tempcipher += guess[letter]
    return tempcipher


#Tells how many words are in the dictionary that we have (whichever guess has the most words is problably the best guest)
def evaluate(guess, dictionaryofWords):
    wordCorrect = 0
    listofGuessWords = guess.split()
    for word in listofGuessWords:
	if word in dictionaryofWords:
	    wordCorrect +=1
    return wordCorrect
words = {}
L = open("dictionary.txt", "r")
for line in L:
    words[line.strip()] = 1
guessDict = {}
#after we've made a guess we put the remaining variable in here to use as a guess for Z since Z is empty
remaining = []

alphabet=['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z']
#given cipher text and coming up with plain text
#for some letter possible guesses
notAssigned = []
#Make this into a function and call this with next guess
for key, value in mapping.iteritems():
    #print key
    #print value
    if len(value)==0:
	notAssigned.append(key)
    else:
	#remove letters we have used from list alphabet
	#Remove value[0] from alphabet
	for i in range(0,len(value)):
	    if value[i] in alphabet:
		guessDict[value[i]]=key
		alphabet.remove(value[i])
		break
	    elif i == len(value)-1:
		notAssigned.append(key)
		
#assign ciphertext letter to plaintext letter
#guessDict[value[0]]=key

print guessDict
#make sure it has all the letters
#takes ones haven't been assigned and assigns a remainder letter in the alphabet
for i in range(0,len(alphabet)-1):
    guessDict[alphabet[i]]=notAssigned[i]
print guessDict
tmp = decryptFunction(cipherText, guessDict)
print tmp
print evaluate(tmp,words)
