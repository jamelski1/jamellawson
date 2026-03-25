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

def digitfile(filename,years=True):
  "Returns digitcount but over the entire file contents"
  saved = open(filename, 'r')
  text = saved.read()
  theNumbers = digitcount(text)
  return theNumbers
