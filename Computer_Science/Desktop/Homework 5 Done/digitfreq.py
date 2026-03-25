'''
  digitfreq is a program to read a text file, count frequency on 
  the digits ('0' through '9') and produce an ordered list of 
  (digit,count) pairs, one for each of the digits.  

  Several functions are implement in digitfreq, including a function
  to count the number of digits found in a string, a function to 
  count the number of digits found in a file, a function to turn
  digit counts into digit frequencies (as percentages), and finally
  a function to plot the distribution of digits using matplotlib. 
  
  Here are test cases for functions that digitfreq should have:  
  
  >>> r = digitcount("57 21 350.215 203,567,121 2009")
  >>> r    
  [4, 4, 5, 2, 0, 4, 1, 2, 0, 1]
  >>> s = freqdist(r)
  >>> s
  [17, 17, 21, 8, 0, 17, 4, 8, 0, 4]
  >>> digitcount("nothing here")
  [0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
  >>> freqdist([10,10,10,200,30,20,80,0,0,0]) 
  [2, 2, 2, 55, 8, 5, 22, 0, 0, 0]
  >>> r = digitfile("laborstats.txt") 
  >>> r
  [575, 775, 745, 431, 325, 405, 569, 346, 337, 372]
  >>> freqdist(r)
  [11, 15, 15, 8, 6, 8, 11, 7, 6, 7]
  >>> m = noyears("17. for 2008 and 2009, but 2003 shows 112004") 
  >>> m
  '17. for and 2009, but shows 112004'
  >>> r = digitfile("laborstats.txt",years=False)
  >>> freqdist(r)
  [8, 16, 14, 9, 7, 8, 12, 7, 7, 8]
  >>> r = digitfile("census.txt")
  >>> freqdist(r)
  [8, 12, 10, 8, 9, 9, 11, 10, 10, 9]

  After you get all the tests passing, you can then show some 
  plots, by something like the following (do this interactively):

     P = freqdist(digitfile("census.txt"))
     simplegraph(P)
     histogram(P) 
  
'''

#-----------(start here)--------------------------------
def digitcount(S):
  '''Just returns a list of counts for each digit in string S,
  but controlled by keyword parameter dictionary.  
   
     digitcount("12399") returns [0,1,1,1,0,0,0,0,0,2]

  showing zero counts except for "1", "2", "3", and "9".
  '''
  
  dictionary = dict(zip(range(10),[0]*10))
  possibleNumbers= "0123456789"
  for strNumber in S:
    if strNumber in possibleNumbers:
        dictionary[int(strNumber)] += 1
  return dictionary.values()
def noyears(line):
  '''Return a string with years 2000 through 2011 (as strings) 
     removed.  See the unit test above for an example of how
     noyears(line) should behave.'''
  NewString = ''
  test = ["2000", "2001", "2002", "2003", "2004", "2005", "2006", "2007", "2008", "2009", "2010", "2011"]
  otherLine = line.split()
  for variable in otherLine:
    if variable not in test:
        NewString = NewString + ' '+ variable
  return NewString.lstrip()

def digitfile(filename,years=True):
  "Returns digitcount but over the entire file contents"
  saved = open(filename, 'r')
  text = saved.read()
  if years == False:
    noYearsText = noyears(text)
    theNumbers = digitcount(noYearsText)
    return theNumbers
  theNumbers = digitcount(text)
  return theNumbers


def freqdist(V):
  '''Converts a list of counts [1,20,0,18, (etc)] into 
     a list of relative frequencies as percentages.  
   
     Example: freqdist([10,10,10,200,30,20,80,0,0,0]) 
     returns [2,2,3,55,8,5,22,0,0,0]
  '''
  percentage = [100*(variable)/sum(V) for variable in V]
  return percentage
#-----------(end here)----------------------------------

def simplegraph(V):
  '''This is for an interactive display of the results
     of calculating a digit frequency distribution, plotting
     a line through the points, using the matplotlib module.

     There will be ten points, with point (x,y) being the 
     digit x ("0" to "9") and y being the percentage frequency.

     Argument V is supposed to be a list of ten percentage values.
  '''
  import matplotlib.pyplot as mp
  x = list("0123456789") 
  y = V 
  mp.xlabel("Digits 0-9")
  mp.ylabel("Percent Frequency")
  mp.title("Frequency of Digits")  
  mp.plot(x,y,linewidth=3)
  mp.show()

def histogram(V):
  '''This is for an interactive display of the results
     of calculating a digit frequency distribution, plotting
     a histogram of the results, using the matplotlib module.

     There will be ten bars, reaching (x,y), which represents 
     digit x ("0" to "9") and y being the percentage frequency.

     Argument V is supposed to be a list of ten percentage values.
  '''
  import matplotlib.pylab as pl
  import matplotlib.pyplot as mp 
  x = pl.arange(10) 
  for i in range(10):
    pl.bar(0.2 + i*1.0, V[i], 0.5, bottom=0.001)
  mp.xlabel("Digits 0-9")
  mp.ylabel("Percent Frequency")
  mp.title("Frequency of Digits")  
  pl.show()

if __name__ == "__main__":
    import doctest, sys
    (fail,tests) = doctest.testmod() 
    if fail>0:
       sys.exit(1)	
    else:
       r = digitfile("laborstats.txt",years=False)
       histogram(r)
