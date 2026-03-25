'''
  Draw Something!  

  For this problem, there are no test cases.  Study examples, like 
  figdraw.py (or more advanced is hanoi.py), and also look at teken.py
  which is the module for drawing.  It uses the browser to render 
  the drawing, but you can also use the stepper for practice.  

  NOTE NOTE NOTE:  if the browser connection doesn't work for you,  
  please let your TA know.  The teken module is known to work on 
  the Computer Science cluster, but may not work if you have installed
  Python on your own machine or use Python somewhere outside of the 
  CS cluster.  The way teken works is by writing a file "render.html" 
  and then requesting that the browser display the file.  If this fails,
  you might try forcing the browser to open the file manually -- ask
  your TA if this becomes necessary. 

  REQUIREMENT:

    write a script, using teken, that draws
      - at least eight (8) lines, and
      - at least three (3) circles, and
      - at least two (2) rectangles, and
      - at least one label with text.
    all of these elements (the 8 lines, 3 circles, 2 rectangles, and label)
    MUST be visible on the browser when your script finishes.  
 
    We will grade this problem based on visual results.
'''
import teken

#-----------(start here)--------------------------------
teken.rectangle(start=(100,100),color="black",
		fill="burlywood",height=200,width=300)
teken.rectangle(start=(400,200),color="black",
		fill="black",height=100,width=100)
teken.rectangle(start=(433,225),color="black",
		fill="white",height=25,width=30)
teken.line(start=(100,150),end=(150,100),color="black")
teken.line(start=(100,200),end=(200,100),color="black")
teken.line(start=(100,250),end=(250,100),color="black")
teken.line(start=(100,300),end=(300,100),color="black")
teken.line(start=(150,300),end=(350,100),color="black")
teken.line(start=(200,300),end=(400,100),color="black")
teken.line(start=(250,300),end=(400,150),color="black")
teken.line(start=(300,300),end=(400,200),color="black")
teken.line(start=(350,300),end=(400,250),color="black")

teken.circle(start=(175,300),radius=60,color="black",
		fill="grey")
teken.circle(start=(350,300),radius=60,color="black",
		fill="grey")
teken.circle(start=(450,300),radius=30,color="black",
		fill="grey")
teken.label(start=(175,200),angle=0,
           text="JAMEL EXPRESS",color="yellow")
teken.show()

#-----------(end here)----------------------------------
