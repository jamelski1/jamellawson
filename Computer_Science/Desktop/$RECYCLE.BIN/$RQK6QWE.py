'''
  This is a Python webserver.  It uses some non-standard port that 
  is permitted by the CS cluster of machines.  The port number is 
  8000 below, but this should be changed to some other number in     
  range(8000,16384) so that it does not conflict with another student.

  The purpose of the Python webserver is to present a page with 
  some images and links to other pages.  The guidelines for how it 
  works are:

  1.  The HTML for the page should be pretty simple, using only 
      tags like <html> <body> <p> <a> <img>.

  2.  The actual HTML should come from a text file, but that text
      file can have text in it like {0} (and {1}, etc) so that the
      Python format() method can be used to fill in blanks, so to
      speak.  

  3.  Although there is only one HTML file, the appearance of the 
      page will change because of what the server does with the 
      format() method.

  4.  The page can have images.  But, the images should be files 
      like river.jpg or similar.  The Python webserver will get 
      requests from the browser, like  "/river.jpg" in the URL 
      path, for instance.  Then the Python webserver has to read
      the file and return it.  

      NOTE:  a typical webserver may in fact get multiple 
             requests from a browser just to show one page

  5.  Your Python webserver must be able to show at least three
      different webpages.  It should be possible to navigate 
      between these pages using links that the user can click
      on.  

  6.  Samples of webservers in this directory show some techniques,
      see sample1.py and sample1.py

  7.  RULES FOR YOUR CODE 

      (a) No function/method can be longer than 10 lines!  (Except for
          comments and docstrings, which do not count for the 10
          lines) 

          "Cheating" around the 10 line restriction, like using 
          semicolon, extended lines with continuation (backslash)
          or combining one-line bodies --- tricks NOT ALLOWED.

      (b) All functions/methods must be documented, to say what is the
          purpose, what are the arguments (if any), and what are
          the output(s), what are the intended goals and effects. 

  8.  Grading/Scoring criteria:

      (i)   Does it work?
      (ii)  Does it follow the rules (a)-(b) above?  
      (iii) Does the code follow the original plan for documentation 
            on the functions/methods? 
      (iv)  Originality/Features:  does your Python webserver go 
            beyond the bare minimum of three pages, have multiple 
            images and links?  Does it look just random or does it
            resemble what a real web site would look like? 
''' 
