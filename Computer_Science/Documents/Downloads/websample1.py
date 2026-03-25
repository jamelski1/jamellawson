'''
  Simple Python Webserver Example.
  How to run:
     1.  Use IDLE, or Wing, or just a command like   python websample1.py
         to start this program running.  
     2.  In a browser, enter either 
         - http://localhost:8000      or
         - http://localhost:8000/index.html
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
      server = BaseHTTPServer.HTTPServer(('',8000), MyHandler)
      print 'started httpserver...'
      server.serve_forever()
   except KeyboardInterrupt:
      print '^C received, shutting down server'
      server.socket.close()

# run the main function
main()
