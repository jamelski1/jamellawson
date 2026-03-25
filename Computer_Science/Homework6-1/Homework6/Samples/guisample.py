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
