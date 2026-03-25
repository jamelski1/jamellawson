'''
  This is a Python GUI application, using the Tk framework, 
  partly described in Chapter 27. 

  The purpose of the Python GUI application is to put the user
  in a randomly selected maze of at least sixteen rooms with 
  connections between the rooms.  There is a room with treasure,
  and if the user moves to that room, the maze is solved:  the
  user wins!  To make the game interesting, there is one room
  with a dragon.  If the user moves to the room with the dragon,
  then the user loses (game over), EXCEPT if the user has a 
  sword.  So, there is a room with a sword.  When the user moves
  to the room with the sword, the user gains the sword and keeps
  it forever after.  Initially, the user has no sword and is in
  a room where there is neither sword nor dragon.  The maze is 
  set up so that there can be some way to win.  

  On the window for the application, the user can see buttons 
  that say what directions the user can move:  north, south, 
  east, west.  The window can also show labels about whether the
  user has a sword, and other status information.  Basically, the 
  user can just click on buttons and move from room to room.

  In addition to the information of Chapter 27, there is a 
  small, working GUI program in this directory, guisample.py, 
  that you can try.  It's not very nicely done, but does illustrate  
  a few widgets and some dynamic behavior.  Your application should
  be better than this.

  RULES FOR YOUR CODE 

      (a) No function or method can be longer than 20 lines!  
          (Except for comments and docstrings, which do not count 
          for the 20 lines) 

          "Cheating" around the 20 line restriction, like using 
          semicolon, extended lines with continuation (backslash)
          or combining one-line bodies --- tricks NOT ALLOWED.

      (b) All functions/methods must be documented, to say what is the
          purpose, what are the arguments (if any), and what are
          the output(s), what are the intended goals and effects. 

      (c) The way that the program represents the game, how the 
          user location and other information is represented, should
          be described in comments or a docstring.  

  8.  Grading/Scoring criteria:

      (i)   Does it work?
      (ii)  Does it follow the rules (a)-(c) above?  
      (iii) Does the code follow the original plan for documentation 
            on the functions/methods? 
      (iv)  Originality/Features:  does your Python application go 
            beyond the bare minimum of buttons and text, say with 
            colors, other widgets and interactive behaviors? 
''' 

''' Player 1 always starts off in room 0 with an empty holster.  The rooms are a dictionary
keys from 0 - 15 (adding up to 16 entire rooms). The Player 1 may be prompted for
their name and gender to fill in the different times the characters speak to the
Player 1 (depending on if this is possible).  The user will receive a short
paragraph describing the rules and directions and setting such as the house he's
in the situation with his family how he may not leave the house, how there is
a sword to find, how there is a dragon to slay etc.  The buttons will say North,
South, East, West.  The entire maze will be 4X4 equaling 16 rooms.  I will import
random module.  Assign the values to the the dictionary between 0 - 15.
The values will consist of family names which will be the name of the room.
The values will be Mom, Dad, Grandma, Grandpa, Sister, Brother,
Grandson, Aunt, Uncle, Son, Daughter, Niece, Nephew, Wife/Husband, Grandaughter.
Dragon will be a variable and it will be random using int(random.choice(range(1,16)))
I will randomly assign the sword a room as well.  Using a while loop I will say
while False:
sword = int(random.choice(range(1-16)))
if dragon == sword
return False
else:
return True
This will make it so that sword and dragon always have 2 different random numbers
and therefore will start in 2 different rooms.  From there I will need to figure
out how to use the guisample to build a 4X4 rooms that can go north, east, south,
and west instead of just forward and backwards.  I will create a variable called
weapon that is set to False.  I will need to make a function
that tests if the player has found the sword everytime he enters a new room.
Probably an if statement. If Player == Sword weapon is set to True and the player
is alerted that he has gained the sword. If Player == Dragon and weapon == False
give the message that the player has died and delay for 5 seconds to give the
player time to read the message and system exit.  If Player == Dragon and
weapon == True give the player the message that he has slayed the dragon and
delay for 5 seconds to give the player time to read the message and system exit.'''

from Tix import *  # but Tix not actually used in this example 
from Tkinter import *
import random

class demoFrame(Frame):
  '''
    Define a Python class for building a frame
    -- this is mostly copied from an example in Chapter 27
  '''
  def __init__(self,master):
     '''
       Constructor of this class needs the root window
       object that Tk() creates:  the parameter "master" 
     '''
     Frame.__init__(self,master)  # call superclass constructor first
     # (these next method calls are "magic", found by searching
     #  on 'tkinter frame' with a search engine)
     self.pack_propagate(0)  # turn off dynamic frame sizing
     self.pack(padx=10,pady=10)  # this puts the frame onto the window
     self.config(width=400,height=150)  # set frame width and height in pixels
     self.config(background="lightgreen",relief=RAISED)
     # (end of magic)
     self.widgets = []
     # right now, there are no buttons or labels
     self.state = [[0,0], "and", "You Don't Have The Sword"]     # start with "state" equal zero
     self.buildWidgets()  # first time call to build all widgets
     self.dragon = [int(random.choice(range(1,5))),int(random.choice(range(1,5)))]
     self.treasure = [int(random.choice(range(1,5))),int(random.choice(range(1,5)))]
     self.sword= [int(random.choice(range(1,5))),int(random.choice(range(1,5)))]
     self.HasSword = True
       
     
     self.Player1 = False
  def buildWidgets(self):
     '''
       This method creates widgets customized to the current state, 
       which is an integer in range(6).  When state is greater than
       zero, there is a "go left" button;  when state is less than
       five, there is a "go right" button.  Plus there is a label
       showing the current state.  

       Buttons are bound to the methods that will do the appropriate
       action when they are clicked.  

       An exit button is always present, to allow quitting. 
     ''' 
     if self.state[0][0]>0: 
        leftButton = Button(self,text="Back")
        leftButton.bind("<Button-1>",self.goBack)
        leftButton.pack(side="left")
        self.widgets.append(leftButton)  # remember this for later removal
     if self.state[0][0]<5:  
        rightButton = Button(self,text="Forward")
        rightButton.bind("<Button-1>",self.goForward)
        rightButton.pack(side="right")
        self.widgets.append(rightButton) # remember this for later removal
     if self.state[0][1]<5:
       upButton = Button(self, text ="Up")
       upButton.bind("<Button-1>",self.goUp)
       upButton.pack(side="top")
       self.widgets.append(upButton)

     if self.state[0][1]>0:
       downButton = Button(self, text="Down")
       downButton.bind("<Button-1>", self.goDown)
       downButton.pack(side="bottom")
       self.widgets.append(downButton) 
     showState = Label(self,text="State is {0}".format(self.state))
     showState.pack(side="top")
     self.widgets.append(showState)
     exitButton = Button(self,text="Exit")
     exitButton.bind("<Button-1>",self.quit)
     exitButton.pack(side="bottom")
     self.widgets.append(exitButton)

  def clearWidgets(self):
     '''
       Take back any widgets we put on the frame, so it is clean for rebuilding.
     '''
     for widget in self.widgets:
         widget.destroy()
     self.widgets = []   # now there are no widgets in frame

  def quit(self,mouseEvent):
     import sys
     sys.exit(0)   # this forces immediate quit of entire application
   
  def goBack(self,mouseEvent):
     '''
       The goBack() method is called when the user clicks on a "left" button,
       so all it does is decrement the state value and redraw the frame.
     '''
     self.state[0][0] -= 1
     self.clearWidgets()
     self.buildWidgets()

  def goForward(self,mouseEvent):
     '''
       The goForward() method is called when the user clicks on a "right" button,
       so all it does is increment the state value and redraw the frame.
     '''
     self.state[0][0]  += 1
     self.clearWidgets()
     self.buildWidgets()
  def goUp(self,mouseEvent):
    self.state[0][1] += 1
    self.clearWidgets()
    self.buildWidgets()
  def goDown(self,mouseEvent):
    self.state[0][1] -=1
    self.clearWidgets()
    self.buildWidgets()

#-----( main program starts here )---------------------------------------------

   

root = Tk()
Tkobject = demoFrame(root)
Tkobject.mainloop()

