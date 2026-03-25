# it is possible to terminate a while or for loop before
# the terminating condition is met (below this is if count <= 16) using break
count = 0
while(count <= 16):
    count +=1
    print(count)
    if count == 5:
        break #terminates the while loop
    
print ("\n") # \n means make a new line

##it is also possible to skip some of the while loop using continue
count=0
while(count < 17):
    count += 1
    if (count % 4) == 0:
        continue
    #do not execute the code below here and go to the beginning of the while
    #loop
    print(count)