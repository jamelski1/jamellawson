input_file = open("input.txt", "r")
dictionary = []
file = open("dictionary.txt", "r")
for word in file:
        dictionary.append(word)

line = []

for thisLine in input_file:
        temp = thisLine.strip().replace(".", "").replace(",", "").replace(";", "").replace("?", "").replace("!", "").replace("'s", "").replace("(", "").replace(")", "").replace("-", "").replace("*", "").replace("1", "").replace("2", "").replace("3", "").replace('"', "").replace("'", "").replace(":", "").split()
        temp = map(str.lower, temp)
        line += temp
input_file.close()
file.close()
mispelledwords= []
for word in line:
        if word in dictionary:
                continue
        else:
                mispelledwords.append(word)
mispelledwords.sort()
print mispelledwords
