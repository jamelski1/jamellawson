#Useful Functions
def isEven(x):
    return (x%2==0)




#Nested For Loop (Create a chess board)

#Chess board dimensions

def printChessBoard(height, width):
    for i in range(height):
        for j in range (width):
            if isEven(J) and isEven(i):
                print("X"),
            elif isOdd(J) and isOdd(i):
                print("X"),
            else:
                print("O")
                

height = 10
width = 6

i=0,1
j=0,1

for i in range(height):
    for j in range (width):
        if is Even(j) and isEven(i):
            print("X"),
        elif isOdd(j) and isOdd(i):
            print("X"),
        else:
            print("O"),
    print("")

#How do I turn this into a function that takes
#two parameters: height and width?