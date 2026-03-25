sum = 0
count = 0

x=int(raw_input("Please Enter a grade (type -1 to quit: "))

while(x != -1):
    sum += x #sum = sum + x
    count += 1 #count = count + 1
    x = int(raw_input("Please Enter a grade (type =1 to quit: " ))
    
if(sum!=0):
    print("The average is " + str(float(sum)/count))
    
    #could also type this and it would mean the same thing
    #average = float(sum)/count
    #print("The average is " + str(average))
    
else:
    print("You did not enter any numbers")