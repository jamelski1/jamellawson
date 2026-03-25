from Tix import *  # but Tix not actually used in this example 
from Tkinter import *

class demoFrame(Frame):
  def __init__(self,master):
     Frame.__init__(self,master)  # call superclass constructor first
     # (these next method calls are "magic", found by searching
     #  on 'tkinter frame' with a search engine)
     self.pack_propagate(0)  # turn off dynamic frame sizing
     self.pack(padx=10,pady=10)  # this puts the frame onto the window
     self.config(width=400,height=150)  # set frame width and height in pixels
     self.config(background="lightgreen",relief=RAISED)
     # (end of magic)
     self.widgets = []  # right now, there are no buttons or labels
     self.state = (x,y)    # start with "state" equal zero
     self.buildWidgets()  # first time call to build all widgets

  def buildWidgets(self):
    
    if self.x>0: 
        leftButton = Button(self,text="Back")
        leftButton.bind("<Button-1>",self.goBack)
        leftButton.pack(side="left")
        self.widgets.append(leftButton)  # remember this for later removal
    if self.x<5:  
        rightButton = Button(self,text="Forward")
        rightButton.bind("<Button-1>",self.goForward)
        rightButton.pack(side="right") 
        self.widgets.append(rightButton)  # remember this for later removal
    if self.x<5:  
        rightButton = Button(self,text="Up")
        rightButton.bind("<Button-1>",self.goUp)
        rightButton.pack(side="Up") 
        self.widgets.append(rightButton)  # remember this for later removal
    if self.x>5:  
        rightButton = Button(self,text="Down")
        rightButton.bind("<Button-1>",self.goDown)
        rightButton.pack(side="Down") 
        self.widgets.append(rightButton)  # remember this for later removal
        
     showState = Label(self,text="State is {0}".format(self.state))
     showState.pack(side="bottom")
     self.widgets.append(showState)
     exitButton = Button(self,text="Exit")
     exitButton.bind("<Button-1>",self.quit)
     exitButton.pack(side="top")
     self.widgets.append(exitButton)

  def clearWidgets(self):
     for widget in self.widgets:
         widget.destroy()
     self.widgets = []   # now there are no widgets in frame

  def quit(self,mouseEvent):
     import sys
     sys.exit(0)   # this forces immediate quit of entire application
   
  def goBack(self,mouseEvent):
     self.x = self.x - 1
     self.clearWidgets()
     self.buildWidgets()

  def goForward(self,mouseEvent):
     self.x = self.x + 1
     self.clearWidgets()
     self.buildWidgets()
  def goUp(self,mouseEvent):

     self.y = self.y - 1
     self.clearWidgets()
     self.buildWidgets()
  
  def goDown(self,mouseEvent):
     self.y = self.y + 1
     self.clearWidgets()
     self.buildWidgets()
#-----( main program starts here )---------------------------------------------

root = Tk()
Tkobject = demoFrame(root)
Tkobject.mainloop()
