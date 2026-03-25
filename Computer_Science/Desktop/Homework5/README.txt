The README file for Homework4, Fall Semester 2011, for
22C:016 (all sections), due 17 November 2011 to be 
submitted via ICON.

***** THIS HOMEWORK IS DIFFERENT *********************

  The problems here are varied, don't all have unit
  tests, and some require that you carefully modify 
  existing programs.

Please do read all of these instructions.  Credit for 
doing the homework depends on following instructions.

There are four problems, 

   Freeform.py    20 points
   Masquare.py    20 points
   digitfreq.py   20 points
   wordfreq.py    20 points 

1.  Freeform.py

   This is a problem with no defined tests;  use the teken 
   module to draw some figures.  Read the docstring in Freeform.py
   to understand what is required;  then edit Freeform.py and add
   some Python to accomplish the task.

2.  Masquare.py

   This is a simplified version of Sukoku.py (also in this directory,
   just for fun).  Your task is to replace the printed output by 
   drawing the result using the teken module. 

3.  digitfreq.py 

   This one does have unit tests.  It is a simple example of testing
   Benford's Law (use a search engine to look up this term).  There are
   some files in this directory that digitfreq.py should read to get
   results.  If all tests pass, it even plots the results using matplotlib
   (but that only works if you are in the CS cluster). 

4.  wordfreq.py

   Similar to digitfreq.py, but more complex processing of a text file.
   
   A series of text processing steps and word counting get results.

WHAT TO DO

Edit all four programs, Freeform.py, Masqare.py, digitfreq.py, 
and wordfreq.py.  In each of these there are comments which look
like this:

   #-----------(start here)--------------------------------
   
   #-----------(end here)----------------------------------

You are supposed to add Python code between these comments.  For
two of the programs, Freeform.py and Masquare.py, there are no 
unit tests.  Instead, your program will be graded on what it draws.
For the other two, digitfreq.py and wordfreq.py, there are some 
unit tests.  If you succeed in getting your code to pass all of
the unit tests, then the program will attempt to use the matplotlib
software to graph some results of your functions.  

NOTE that programs digitfreq.py and wordfreq.py require you to 
write particular functions, which are described by more comments
between the "#----(start here)----" and "#----(end here)-----" 
lines.  
