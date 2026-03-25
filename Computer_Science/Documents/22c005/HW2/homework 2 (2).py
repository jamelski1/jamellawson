# Jamel Lawson
total = 0
count = 0
f = open("miles.txt")

previousDay = 0

for line in f: 
    print(int(line) - previousDay)
    
    previousDay = int(line)