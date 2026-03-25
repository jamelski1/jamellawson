f = open("miles.txt")


previousDay = 0
max = 0
min = 100
for line in f:
    if (int(line) - previousDay > max):
        max = (int(line) - previousDay)
    if (int(line) - previousDay < min):
        min = (int(line)-previousDay)
        
    previousDay= int(line)
        
print("The Longest Day Was" + str(max) + "miles")
print("The Shortest Day Was" + str(min) + "miles")