'''
  Simple Python Webserver Example with image.
  How to run:
     1.  Use IDLE, or Wing, or just a command like   python websample2.py
         to start this program running.  
     2.  In a browser, enter either 
         - http://localhost:8000      or
         - http://localhost:8000/river.jpg
         (you should see a difference between the two URLs)
  NOTE:  the number 8000 is in the code below, but you might need 
         to change this to some other value in range(8000,16384) to 
         avoid conflicts with other network activity.
'''
import BaseHTTPServer
class MyHandler(BaseHTTPServer.BaseHTTPRequestHandler):
   "inherit and customize Python webserver class"
   def do_GET(self):
     try:
       if self.path.endswith("/river.jpg"):
          self.send_response(200)
          self.send_header('Content-type','image/jpeg')
          imagefile = open("river.jpg",'rb')
          image = imagefile.read()
          imagefile.close()
          self.end_headers()
          self.wfile.write(image)
          return
       elif self.path.endswith("/index.html"):
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
     except IOError:  # in case file could not be found
          pass

def main():
   '''instantiate and launch the webserver, running it
      until CTRL-C interrupt via Keybord'''
   try:
      server = BaseHTTPServer.HTTPServer(('',8000), MyHandler)
      print 'started httpserver...'
      server.serve_forever()
   except KeyboardInterrupt:
      print '^C received, shutting down server'
      server.socket.close()

# run the main function
main()
