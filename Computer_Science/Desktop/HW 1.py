"""Jamel Lawson
Homework problem 1 2.19 in the text
A dartboard of radisu 10 and the wall it is hanging on are
represented using the two dimensional coordinate system,
with the board's center at coordinate (0,0).  Variables x and 
y store the x- and y-coordinate of a dart hit.  Write an
expression using variables x and y that evalates to True if the dart
hits (is within) the dartboard, and evaluate the expression for these
dart coordinates:
(a) (0,0) (b) (10, 10) (c) (6,-6) (d) (-7,8)"""

def dartGame(x,y):
	#compares the input x to the bounds 10 and -10
	#if it's outside of these bounds it returns False
	#and doesn't event check the why coordinate
	if (x < 10 and x > -10):
		#compares the input y to the bounds 10 and -10
		#if it's outside of these bounds it returns False
		#if it's inside these bounds then it returns True
		if (y < 10 and y > -10):
			return True
		else:
			return False

	else:
		return False
"""(a) (0,0)   True
(b) (10,10) False
(c) (6, -6) True
(d) (-7, 8) True"""

"""Jamel Lawson
Homework problem 2
Write a method that takes, as input, a string and prints the string in reverse order."""

#reverses a string...without using a list!!! ^_^
def reverse(theString):
	#Creates an empty string
	answer = ''
	#iterates the String
	for i in theString:
		#ADDS EVERY LETTER ONTO THE FRONT OF THE EMPTY STRING
		#AS IT GOES THROUGH EACH LETTER IN THE STRING
		answer = i + answer
	#this produces a backwards string to print out	
	print answer
	#this returns the answer to make it able to be saved to a variable
	return answer


"""Jamel Lawson
Homework problem 3
Write a method that PRINTS a random number between 1 and 6"""

#module found at http://docs.python.org/library/random.html
import random

#them method random.randit(a,b) was also found it the website above
def newNum():
	#saves the random int to the local variable x
	x = random.randint(1,6)
	#prints the local variable
	print x
	#allows the local variable to be saved as a global variable
	#for later use
	return x


"""Jamel Lawson
Homework problem 4 2.34 in the text
Using Turtle graphics, draw an image showing the six sides of a dice."""

#imports the module for use.
import turtle

#opens the white background for the image to be displayed.
theScreen = turtle.Screen()
#creates the pen to draw the picture.
Pen = turtle.Turtle()
#creates a thicker pen
Pen.pensize(10)
#picks the pen up to keep from drwaing
Pen.penup()

#Prints out a Square on the Screen
def createSquare(x, y):
    
    Pen.pendown()
    Pen.forward(100)
    Pen.right(90)
    Pen.forward(100)
    Pen.right(90)
    Pen.forward(100)
    Pen.right(90)
    Pen.forward(100)
    Pen.right(90)
    Pen.penup()
#Prints out a dot on the Screen
def putDot():
    Pen.pendown()
    Pen.pensize(10)
    Pen.dot()
    Pen.penup()
#This commenting was for an earlier draft when I was seeing
#How difficult it would be to create a 3 dimensional cube.
#Pen.goto(x+25, y+25)
#Pen.right(45)
#Pen.forward(50)
#Pen.right(45)
#Pen.forward(100)
#Pen.right(135)
#Pen.forward(50)

#set x and y to 0 to intialize them
x = 0
y = 0


#Creates the box for Dice #4
createSquare(x,y)

#Creates the box for Dice #5
Pen.goto(125, 0)
createSquare(x,y)

#Creates the box for Dice #6
Pen.goto(250, 0)
createSquare(x,y)

#Creates the box for Dice #3
Pen.goto(-125, 0)
createSquare(x,y)

#Creates the box for Dice #2
Pen.goto(-250, 0)
createSquare(x,y)

#Creates the box for Dice #1
Pen.goto(-375, 0)
createSquare(x,y)

#Creates the Dot for Dice #1 
Pen.goto(-325, -50)
putDot()

#Creates the Dots for Dice #2
Pen.goto(-225, -25)
putDot()
Pen.goto(-175, -75)
putDot()

#Creates the Dots for Dice #3
Pen.goto(-100, -25)
putDot()
Pen.goto(-75, -50)
putDot()
Pen.goto(-50, -75)
putDot()

#Creates the Dots for Dice #4
Pen.goto(25, -25)
putDot()
Pen.goto(75, -25)
putDot()
Pen.goto(25, -75)
putDot()
Pen.goto(75, -75)
putDot()

#Creates the Dots for Dice #5
Pen.goto(150, -25)
putDot()
Pen.goto(200, -25)
putDot()
Pen.goto(175, -50)
putDot()
Pen.goto(150, -75)
putDot()
Pen.goto(200, -75)
putDot()

#Creates the Dots for Dice #6
Pen.goto(275, -25)
putDot()
Pen.goto(325, -25)
putDot()
Pen.goto(275, -50)
putDot()
Pen.goto(325, -50)
putDot()
Pen.goto(275, -75)
putDot()
Pen.goto(325, -75)
putDot()
theScreen.bye()

#This was part of the earlier development of my program as well.
#Pen.penup()
#x = 50
#y = -50
#Pen.goto(x, y)
#Pen.pendown()
#Pen.dot(25)

#Pen.penup()
#x2 = 125
#y2 = 0
#Pen.pendown()

