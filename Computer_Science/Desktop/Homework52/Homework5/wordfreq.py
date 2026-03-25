'''
  wordfreq  is a program to read a text file, count word frequency, and   
  show a plot of the 1000 most frequently occurring words in the file.  

  So that wordfreq can be flexible, we allow the name of the file to be 
  a command-line parameter, so that a command such as 

      python wordfreq.py pg5818.txt 

  would count the words in the file named pg5818.txt, where as the 
  command "python wordfreq.py myfile.txt" would count the words in 
  the file named myfile.txt.  

  Counting words should take into account that splitting up a  
  string will get punctuation characters (see the string module, 
  specifically the string.punctuation for a complete sequence 
  of the punctuation characters).  For example, 

     "Mr. O'Keefe arrived yesterday?".split() -->
      ["Mr.", "O'Keefe", "arrived", "yesterday?"]  

  For correct word-counting, we want to ignore punctuation and also
  convert all words to lower-case letters.  An exception to this is 
  the hyphen, which is part of a word:  "lower-case" should be treated
  as two words ("lower" and "case") rather than one word ("lowercase"). 

  In English, there are some words which are so frequent that they
  distort the frequencies of word counting.  Examples include "a", 
  "the", "and", "of", plus many more.  The file "stopwords.txt" has 
  a list of all the these frequent words.  DO NOT include any stopwords
  in the frequency counting.  

  Optionally, words can also be stemmed, which is a procedure that 
  ignores suffixes, so that "box" and "boxes" are counted as the same
  word.  The stem() function in the porter2 module returns the stem
  of a given word.   You should skip using the stem() function for your
  initial implementation of the program.  Stemming is something for 
  Version 2.0 of your program, after it works.    

  For word frequency, we prefer a percentage or fractional count between
  0 and 1.  For instance, if the total number of words is 215782 and 
  the number of times "favor" occurs is 617, then the relative frequency 
  is 617/215782 = 0.002859367 (approximately).  

  But for visualizing word frequency in graphs, we prefer to use more 
  convenient numbers that things like 0.00285 -- that's too small to see.
  Therefore, the convention is to show the negative logarithm of the 
  relative frequency:  
 
     import math
     math.log(0.002859367)
     
       -->  5.857154 (approximately)  
  
  For graphing word frequencies, we make the convention that the 
  x-axis represents words and the y-axis represents the (converted)
  frequency.  It can look very messy unless we sort the words by 
  frequency first.  Then the most frequent word has x=1, the second
  most frequent word has x=2, and so on.  This makes the visualization
  much nicer.

  TECHNIQUES

  1.  Getting the file name:

  To get the file name, the following code is used:

     import sys
     filename = sys.argv[1]

  (now, the variable 'filename' is a string containing the file's name) 

  2.  Reading the text in the file:

     WordFile = open(filename)
     for line in WordFile:
         # now variable 'line' is a string, ending with '\n', which 
         # is one line from the file;  getting the words in the line
         # will start with splitting the line into a list:      
         words = line.split() 

  3.  Counting words:

     Probably it's best to use a dictionary for this.  Just remember
     to handle punctuation, upper case (and optionally stemming) before
     consulting/changing the dictionary.  

  4.  Sorting:

     The sort method works on lists, whereas we would like to sort the
     items of a dictionary (in decreasing order, by their values).  There
     is helpful Python module for this:

       import operator
       SortedByFreq = sorted(WordDict.iteritems(), 
                             key=operator.itemgetter(1,0),
			     reverse=True)  

     (We want reverse=True to get biggest value first, then descending.)

     The WordDict.iteritems() is a generator, which makes pairs (key,value) 
     for all items in the WordDict dictionary.  The "key=" argument to the    
     sorted function tells it to use a particular part of an item for comparison,
     which controls how the sorting will be done.

  5.  Graphing the result:

     We will use the matplotlib.pyplot module to make the graphs.  

     IMPORTANT NOTE:  all the workstations in the Computer Science Lab 
     have matplotlib installed, but the matplotlib module is not installed 
     in standard Python.  The matplotlib library is an "extra" module, added 
     after Python has already been installed.  So if you've installed 
     Python on your own computer or use Python outside of the CS department,
     it may be that matplotlib is not installed. 


  UNIT TESTS  (for file "pg5818.txt")
 
  >>> testProg("pg5818.txt",version=0)
  (('the', 1406), ('proud', 3))
  >>> testProg("pg5818.txt",version=1)
  (('the', 1422), ('staff', 3))
  >>> testProg("pg5818.txt",version=2)
  (('the', 1427), ('wall', 3))
  >>> testProg("pg5818.txt",version=3)
  (('the', 1427), ('vests', 3))
  >>> testProg("pg5818.txt",version=4)
  (('the', 1555), ('tap', 3))
  >>> testProg("pg5818.txt",version=5)
  (('project', 88), ('drove', 3))
  >>> testProg("pg5818.txt",version=6)
  (('work', 101), ('idl', 3))

'''
import sys, string

#-----------(start here)--------------------------------

def nohyphen(W):
  '''
  Break up any hyphenated words in W (making each word
  with hyphens into multiple words.  For example, [..., "un-cater-able", ...] 
  would become [..., "un", "cater", "able", ...].  What's happening here is 
  that (1) "un-cater-able" gets removed, and (2) the three new 
  words ("un","cater","able") get added at the same place. 

  NOTE:  this function returns a new list, not changing W, but instead
  returning a list of words made from W, without hyphens, using the 
  accumulation pattern of making a list.
  '''
  Acc = ''
  for each in W:
    if "-" in each:
      newEach = each.replace('-',' ')
      Acc = Acc + newEach
    else:
      Acc = Acc + each
      
  return list(Acc)

def nonumbers(W):
  '''
  nonumbers(W) returns the list of words in W but with any 
  words containing a numeric digit removed.

  NOTE:  this function returns a new list, not changing W, but instead
  returning a list of words made from W, without hyphens, using the 
  accumulation pattern of making a list.
  '''

def nopunctuation(W): 
  '''
  nopunctuation(W) returns the list of words in W but with any 
  punctuation characters replaced by the empty string.

  NOTE:  this function returns a new list, not changing W, but instead
  returning a list of words made from W, without hyphens, using the 
  accumulation pattern of making a list.
  '''

def noemptywords(W):
  '''
  noemptywords(W) returns the list of words in W but with any 
  empty word removed.  Empty words (which are empty strings) might 
  happen because of what nopunctuation(W) or nohyphen(W) do.

  NOTE:  this function returns a new list, not changing W, but instead
  returning a list of words made from W, without hyphens, using the 
  accumulation pattern of making a list.
  '''

def nostop(W):
  '''
  nostop(W) removes any stopwords from W, where StopWords is 
  is a dictionary containing all the stopwords.

  NOTE:  StopWords is an implicit global variable, assumed to 
         be already created before nostop() is called.

  NOTE:  this function returns a new list, not changing W, but instead
  returning a list of words made from W, without hyphens, using the 
  accumulation pattern of making a list.
  '''

def stem(W):
  '''
  Use the Porter2.stem() function to stem the words, which 
  might combine several words in the list.  So when
  the new list is returned, words like "dancer", 
  "danced", "dancers", "dancing" might all be replaced by
  the stem "danc" -- which wasn't even in the list!  
  '''

def lowercase(W):
  '''
  lowercase(W) returns a list of all the words in W, but 
  converted to lowercase.
  '''

def makeStopWords():
  '''
  makeStopWords() creates a dictionary of stopwords.  This 
  is done by reading the stopwords.txt file.  All that really
  happens is to make a dictionary, use a for loop to read 
  the lines, and use the strip() method on the line to get
  the word;  the value for the word in the dictionary is just True.
  '''

#-----------(end here)----------------------------------

def cleanup(W,version):  
  '''
  The cleanup(W) function removes hyphenation, punctuation, 
  converts to lower case, removes empty strings, removes words
  with numeric digits, and removes stopwords from W.  

  It just uses the functions defined earlier to do all the work.

  A new list of words is returned.
  '''
  if version==0:
     return W
  if version>0:
     W = nohyphen(W)
  if version>1:
     W = nopunctuation(W)
  if version>2:
     W = noemptywords(W) 
     W = nonumbers(W)
  if version>3:
     W = lowercase(W)
  if version>4:
     W = nostop(W)
  if version>5:
     W = stem(W)
  return W

def countline(Line,CountDict,version):
  '''
  The countline() function gets all the words in a line, 
  cleans them up using cleanup(), and counts the resulting
  words in the CountDict dictionary.  

  The result of countline() is that the CountDict dictionary
  is modified to count the words in Line (where Line is 
  a string being one line of the input file).
  '''
  LineWords = cleanup(Line.split(),version)
  for word in LineWords:
    if word not in CountDict:
       CountDict[word] = 0
    CountDict[word] += 1

def topK(CountDict,K):
  '''
  The topK() function returns a new dictionary 
  which only has the top K most frequently occurring
  words in CountDict, which should already have the 
  count as the value for each key (= word).

  NOTE:  if CountDict has fewer than K words, then
  the new dictionary is just the same as CountDict.
  '''
  import operator
  SortedByFreq = sorted(CountDict.iteritems(), 
		 key=operator.itemgetter(1,0), reverse=True )  
  if len(SortedByFreq) >= K:
     SortedByFreq = SortedByFreq[:K] 
  return dict(SortedByFreq)
  
def freqDict(CountDict):
  '''
  The freqDict() function takes a dictionary of the top K words
  and their counts (number of occurrences in the file), and
  returns a new dictionary with the same words, but instead
  having the negative logarithm of the relative frequency 
  of that word.
  '''
  import math
  newDict = { }
  totalcount = sum((count for count in CountDict.values()))
  for word in CountDict.keys(): 
    relfreq = CountDict[word] / float(totalcount)
    newDict[word] = - math.log(relfreq)
  return newDict

def plotList(FreqDict):
  '''
  The plotList() function takes a dictionary of words
  created by the freqDict() function and returns a list of
  like [4.092, 5.093, 6.094, 6.095,...]  
  where each value represents a word's frequency in FreqDict.  

  A value like 4.092 (the first one) represents the word in FreqDict
  that had the largest frequency value (as determined by
  the negative logarithm value).  

     NOTE:  after taking negative log of relative 
            frequency, the SMALLER value means higher
	    number of occurrences in the file.
  
  The logic of plotList() is very simple:  just sort the 
  items of FreqDict and make a new list. This will make it 
  easy for plotting.  Because of the negative lots, we don't
  use reverse=True on the sorted() call.
  '''
  import operator
  sortitems = sorted(FreqDict.iteritems(), key=operator.itemgetter(1,0))  
  newsortitems = [ f for (w,f) in sortitems ]
  return newsortitems

def testProg(filename,version=0):
  '''
  This function is only for unit testing.  Don't change
  this function.  
  '''
  global StopWords
  import operator
  if version>2:
     StopWords = makeStopWords()
  WordDict, WordFile = dict(), open(filename)
  for Line in WordFile:
     countline(Line,WordDict,version) 
  sortitems = sorted(WordDict.iteritems(), 
                     key=operator.itemgetter(1,0),
                     reverse=True)
  return sortitems[0],sortitems[999]

def mainProg(filename,version=0):
  '''
  The main program is here.  It gets the file name, reads the file
  and the stopwords file, and builds the list of most frequent 
  words.   The real work is done by all the functions defined earlier.

  The result of mainProg() is a list of the frequencies (as negative
  logarithms) of the top K words in the file.
  '''
  global StopWords
  WordDict, WordFile = dict(), open(filename)
  if version>2:
     StopWords = makeStopWords()
  for Line in WordFile:
     countline(Line,WordDict,version) 
  Points = plotList(freqDict(topK(WordDict,1000)))
  return Points

def simplegraph(V):
  '''This is for an interactive display of the results
     of calculating a word frequency distribution, plotting
     a line through the points, using the matplotlib module.

     Argument V is supposed to be a list of frequency values.
  '''
  import matplotlib.pyplot as mp
  x = list(range(len(V)))
  y = V 
  mp.xlabel("Top Words")
  mp.ylabel("- log(frequency)")
  mp.title("Frequency of Words")  
  mp.plot(x,y,linewidth=2)
  mp.show()

if __name__ == "__main__":
    import doctest
    (fail,tests) = doctest.testmod() 
    if fail>0:
       sys.exit(1)
    else:
       if len(sys.argv)==2:
          P = mainProg(sys.argv[1])
       else:
	  P = mainProg("pg5818.txt")
       simplegraph(P)
