'''
   This is an example of using a constraint solver, a general
   tool used in computer science for automated problem solving.

   The way it works is this.  
   
     1. First, you create a "problem" object -- this will 
        represent some logic puzzle that you want to solve.  

     2. Second, you define the "variables" of the problem. 
        The job of the constraint solver is to find values
        for these variables that solve the puzzle.

     3. Third, you state relationships that must hold between
        the variables (below, the only relationship we have
        is that certain variables must have different values).

     4. Fourth, if needed, you can give some initial guesses
        or values to some of the variables.  The puzzle will
        then be to find values for the remaining variables that
        don't have values. 
 
     5. Fifth, use the "getSolutions()" method to get a list 
        of solutions to the puzzle (it's a list, because there
        might be numerous possible solutions).  

   The example below is a simplified part of a Sudoku 
   puzzle, just a 3x3 arrangement of numbers.  We call this
   a Masquare puzzle.  

'''
from constraint import Problem, AllDifferentConstraint, MustEqConstraint

def Masquare(puzzle):
   '''
      The parameter, puzzle, is a "picture" of a Masquare
      puzzle (see example of a picture in test case below).

      The Masquare() function prints a solution to the 
      given puzzle.  
   '''
   X = Problem()  # this creates a "problem object"

   # For Masquare there are 9 variables, because it is a 3x3 
   # arrangement of numbers.  Each variable has an allowable
   # set of values it can be (one through nine).  Each variable
   # has a coordinate (i,j) which is the row and column in 
   # the Masquare arrangement.
   allowable = "1 2 3".split()  
   for row in range(3):
     for col in range(3):  # this gets us all combinations (row,col)
       varName = (row,col) # the "name" of a variable is just the pair
       X.addVariable(varName,allowable) 

   # Here are the rules of Masquare, enforced as (a)-(b) below:

   # (a) In each row, variables have different values
   for row in range(3):
       # let thisrow be all the variables on current row
       thisrow = [ (row,j) for j in range(3) ] 
       X.addConstraint( AllDifferentConstraint(), thisrow )

   # (b) In each column, variables have different values
   for col in range(3):
       # let thiscol be all the variables on current column 
       thiscol = [ (i,col) for i in range(3) ] 
       X.addConstraint( AllDifferentConstraint(), thiscol )
       
   #First, do the upper left one (0,0), (0,1), (0,2), (1,0) ...
   box = [(i,j) for i in range(3) for j in range(3)]
   X.addConstraint( AllDifferentConstraint(), box )

   # Here is where we give some initial values to selected
   # variables, specified in the "picture" (puzzle argument)
   puzzle = puzzle.split()
   puzzle = ''.join(puzzle)  
   # OK, now it's just a 9-character string
   assert len(puzzle) == 9
   # but, we really want it to be like 
   # [".2.", "1..", "..3"]  which
   # is like 3 rows and 3 columns
   puzzle = [puzzle[:3],puzzle[3:6],puzzle[6:]]

   # For each non-"." item in the puzzle, add a 
   # "must equal" constraint for the item.
   for row in range(3):
     for col in range(3):
       value = puzzle[row][col]
       if value != ".":
          X.addConstraint( MustEqConstraint( (row,col), value ), [(row,col)])

   # All done with set up! OK to get a solution
   solution = X.getSolution()

   if solution == None:
     print "\tno solution possible!"
     return


   #-----------(start here)--------------------------------

   # Please remove this print statement and replace it by 
   # some Python code to draw the result.  Your code should
   # draw what the solution variable (a dictionary) has, so
   # that your code would draw the right thing for other 
   # puzzles and their solutions.
 
   # now print it nicely
   separator = " " + 3*"+---" + "+"
   for row in range(3):
      nicerow = ''
      for col in range(3):
         nicerow +=  " | " + solution[(row,col)] 
         nicerow += " |"
         print separator
         print nicerow
   print solution
   
   #-----------(end here)----------------------------------

#
#  Here is the test of the Masquare() function
#
examplePuzzle = '''
.1.
3..
..2
'''
Masquare(examplePuzzle)
