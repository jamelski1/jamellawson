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

import BaseHTTPServer
class MyHandler(BaseHTTPServer.BaseHTTPRequestHandler):
   "inherit and customize Python webserver class"
   def do_GET(self):
     try:
       if self.path.endswith("/index.html"):
          self.send_response(200)
          self.send_header('Content-type','text/html')
          self.end_headers()
          self.wfile.write("<html><body>Index<p>")
          self.wfile.write("<a href=other.html>Other</a> link")
          self.wfile.write("</body></html>\n")
          return
       elif self.path.endswith("/other.html"):
          self.send_response(200)
          self.send_header('Content-type','text/html')
          self.end_headers()
          self.wfile.write("<html><body>Nothing Here, Sorry</body></html>\n")
          return
       elif self.path.endswith("/river.jpg"):
          self.send_response(201)
          self.send_header('Content-type','image/jpeg')
          imagefile = open("river.jpg",'rb')
          image = imagefile.read()
          imagefile.close()
          self.end_headers()
          self.wfile.write(image)
          return
       elif self.path.endswith("/another.html"):
          self.send_response(200)
          self.send_header('Content-type','text/html')
          page = '''<html><body bgcolor="grey"><h1>River</h1><p>
                    <img src="river.jpg">
                    </body></html>'''
          self.end_headers()
          self.wfile.write(page)
          return
       else:
          self.send_response(404)
          self.send_header('Content-type','text/html')
          self.end_headers()
          self.wfile.write("<html><body>Not Found</body></html>\n")
          return
     except IndexError:
          pass

def main():
   '''instantiate and launch the webserver, running it
      until CTRL-C interrupt via Keybord'''
   try:
      server = BaseHTTPServer.HTTPServer(('',11000), MyHandler)
      print 'started httpserver...'
      server.serve_forever()
   except KeyboardInterrupt:
      print '^C received, shutting down server'
      server.socket.close()

# run the main function
main()
'''Basically I copied and pasted each if, elif, else statement from the
websample1 and websample2.  I ran it and it produces "seperate" webpages for
each statement.  The webpages consists of texts, links, and pictures.  I need
to link all of the pages together, write texts to all of the pages, and put
pictures either around the texts or as its background.  I need to figure out
how to make the if, elif, and else statements into definitions because the code
is too long right now and it will be much easier to call the definition to
render a page.  I will make a function depending on the name of the page
and I will will call it like the do_Get(self) is calling it.  For example
I will make an index function, other function, river function, and another function.
Those are all the names of my webpages.  Then I will use if statements to
help decide when to call these functions'''
