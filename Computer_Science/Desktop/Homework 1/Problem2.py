def TableRead(afile):
    
    #opens the file
    f = open(afile,"r")
    
    #creates an empty running list to story the content of the file
    runningList = []
    
    #determines how many times to go through the list
    count = 0
    reading = True
    
    #while there is still more to read
    while reading:
        #read the next line of the file
        data = f.readline()
        #checks if there is more to read or if it is just an empty string
        #if it IS NOT an empty string it adds 1 to the count
        if data != '':
            
            count += 1
        #if it IS an empty string it does not add 1 and it exits out of the while loop
        else:
            reading = False
            
    F = open(afile,"r")
    
    #goes through the list
    while count > 0:
        #reads the the list line by line take out the \n
        #and the commas
        data = F.readline().strip().split(', ')
        
        #changes the first element of the line into an integer
        data[0] = int(data[0])
        #adds that line to the running list (making it a list of lists)
        runningList = runningList + [data]
        #decrements the count by 1 to eventually exit the while loop
        count -= 1
        #print for testing purposes
        #print runningList
        
    #creates a dictionary to add items to    
    runningDictionary = {}     
        
        
    #takes the first entry in the list and makes it the key to the dictionary    
    for i in range(len(runningList)):
        runningDictionary[runningList[i][0]] = runningList[i]
    
    #this changes all of the author IDs from a string to an integer
    
    '''Code that can be used to change the authod IDs from a string to an integer
    But it is not all the way complete
    if runningList[0][2] == type(int):
        
        for i in range(len(runningList)):
            runningList[i][2] = int(runningList[i][2])
    else:
        pass
        '''
    f.close()
    F.close()
    return runningDictionary

def Combine(dictionary1, dictionary2):
    '''for i in range(3):
        if dictionary2[i][0] == dictionary1[i][2]:
            #dictionary1[i][2] = dictionary2[i][1]
            #dictionary1[i].append(dictionary2[i][2])
            print "I did something " + str(i)
        else:
            print "I didn't do anything " + str(i)'''
    for i in range(len(dictionary2)):
        for j in range(len(dictionary1)):
            if dictionary1[j][2] == str(dictionary2[i][0]):
                dictionary1[j][2] = dictionary2[i][1]
                dictionary1[j].append(dictionary2[i][2])
                
                #print statement for testing purposes
                #print "Yes"
                #everything above this part is correct!!!
                #everything below this part needs some more work but it does print out something
                #if dictionary1[i][2] in dictionary2[i][1]:
                    #continue
            else:
                pass
                #print statment for testing purposes
                #print "No"
                #dictionary1[i][2] = dictionary2[i][1]
                #dictionary1[i].append(dictionary2[i][2])
            #else:
                #pass
    
    #print dictionary1
    #print dictionary2    
    return dictionary1

print "This is the Combined Table: "
print Combine(TableRead("wiki.txt"),TableRead("authors.txt"))
