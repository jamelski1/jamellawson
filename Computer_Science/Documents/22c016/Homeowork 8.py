
def fileToList(x):
    
            
    input_file = open(x)
    line = []


    for thisLine in input_file:
        temp = thisLine.strip().replace(".", "").replace(",", "").replace(";", "").replace("?", "").replace("!", "").replace("'s", "").replace("(", "").replace(")", "").replace("-", "").replace("*", "").replace("1", "").replace("2", "").replace("3", "").replace('"', "").replace("'", "").replace(":", "").replace("`", "").replace("&", "").replace("0", "").replace("4", "").replace("5", "").replace("6", "").replace("7", "").replace("8", "").replace("9", "").replace("<", "").replace("=", "").replace("[", "").replace("]", "").replace("_", "").replace('/', "").split()
        temp = map(str.lower, temp)
        line+= temp
    input_file.close()
    return line

dictionary = []
for s in ["alice.txt","carol.txt","hyde.txt","war.txt","gulliver.txt","treasure.txt"]:
    line =  fileToList(s)
    for x in line:
        if x in dictionary:
            continue
        else:
            dictionary.append(x)
dictionary.sort()
outfile = open("dictionary.txt", "w")
for word in dictionary:
    outfile.write(word + "\n")
print dictionary
outfile.close()