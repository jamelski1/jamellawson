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

   The example below is a Sudoku solver.   

'''
from constraint import Problem, AllDifferentConstraint, MustEqConstraint

def Sudoku(puzzle):
   '''
      The parameter, puzzle, is a "picture" of a Sudoku
      puzzle from a newspaper or similar source.  See
      example of a picture below.

      The Sudoku() function prints a solution to the 
      given puzzle.  
   '''
   X = Problem()  # this creates a "problem object"

   # For Sudoku there are 81 variables, because it is a 9x9 
   # arrangement of numbers.  Each variable has an allowable
   # set of values it can be (one through nine).  Each variable
   # has a coordinate (i,j) which is the row and column in 
   # the Sudoku arrangement.
   allowable = "1 2 3 4 5 6 7 8 9".split()  
   for row in range(9):
     for col in range(9):  # this gets us all combinations (row,col)
       varName = "row" + str(row) + "col" + str(col)    
       # the names could be like "row3col7"  
       varName = (row,col)
       # on second thought, just let the name be a tuple (i,j)  
       X.addVariable(varName,allowable) 

   # Here are the rules of Sudoku, enforced as (a)-(c) below:

   # (a) In each row, variables have different values
   for row in range(9):
       # let thisrow be all the variables on current row
       thisrow = [ (row,j) for j in range(9) ] 
       X.addConstraint( AllDifferentConstraint(), thisrow )

   # (b) In each column, variables have different values
   for col in range(9):
       # let thiscol be all the variables on current column 
       thiscol = [ (i,col) for i in range(9) ] 
       X.addConstraint( AllDifferentConstraint(), thiscol )

   # (c) In each 3x3 sub-table, all the variables must be different
   # -- this is a tedious bunch of rules that we have to add

   # First, do the upper left one (0,0), (0,1), (0,2), (1,0) ...
   box = [(i,j) for i in range(3) for j in range(3)]
   X.addConstraint( AllDifferentConstraint(), box )
   # Then middle upper sub-table 
   box = [(i,j) for i in range(3) for j in range(3,6)]
   X.addConstraint( AllDifferentConstraint(), box )
   # Right upper sub-table
   box = [(i,j) for i in range(3) for j in range(6,9)]
   X.addConstraint( AllDifferentConstraint(), box )
   # Now the middle section, leftmost sub-table 
   box = [(i,j) for i in range(3,6) for j in range(3)]
   X.addConstraint( AllDifferentConstraint(), box )
   # Middle section, middle sub-table
   box = [(i,j) for i in range(3,6) for j in range(3,6)]
   X.addConstraint( AllDifferentConstraint(), box )
   # Middle section, right sub-table
   box = [(i,j) for i in range(3,6) for j in range(6,9)]
   X.addConstraint( AllDifferentConstraint(), box )
   # Finally, the bottom section, leftmost sub-table
   box = [(i,j) for i in range(6,9) for j in range(3)]
   X.addConstraint( AllDifferentConstraint(), box )
   # Bottom section, middle sub-table
   box = [(i,j) for i in range(6,9) for j in range(3,6)]
   X.addConstraint( AllDifferentConstraint(), box )
   # Bottom section, right sub-table
   box = [(i,j) for i in range(6,9) for j in range(6,9)]
   X.addConstraint( AllDifferentConstraint(), box )


   # Here is where we give some initial values to selected
   # variables, copied from a newspaper's Sudoku puzzle, 
   # using "." for empty places;  first get rid of any whitespace
   puzzle = puzzle.split()
   puzzle = ''.join(puzzle)  
   # OK, now it's just an 81-character string
   assert len(puzzle) == 81

   # but, we really want it to be like 
   # [".9.7..86.", ".31..5.2.", ...]  which
   # is like 9 rows and 9 columns
   R = []
   for row in range(9):
      R.append( puzzle[9*row:9*row+9] )

   # For each non-"." item in the puzzle, add a 
   # "must equal" constraint.  
   for row in range(9):
     for col in range(9):
       value = R[row][col]
       if value != ".":
          X.addConstraint( MustEqConstraint((row,col),value), [(row,col)])

   # All done with set up! OK to get a solution
   solution = X.getSolution()

   # now print it nicely
   separator = " " + 9*"+---" + "+"
   for row in range(9):
     nicerow = ''
     for col in range(9):
        nicerow +=  " | " + solution[(row,col)] 
     nicerow += " |"
     print separator
     print nicerow
   print separator

#
#  Here is the test of the Sudoku() function
#
# a "picture" of the puzzle, using a string
# the dots represent the empty squares 
newspaperPuzzle = '''
.9.7..86.
.31..5.2.
8.6......
..7.5...6
...3.7...
5...1.7..
......1.9
.2.6...5.
.54..8.7.
'''
Sudoku(newspaperPuzzle)
