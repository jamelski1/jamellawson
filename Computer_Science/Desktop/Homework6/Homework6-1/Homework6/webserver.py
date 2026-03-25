import BaseHTTPServer
class MyHandler(BaseHTTPServer.BaseHTTPRequestHandler):
   "inherit and customize Python webserver class"
   def do_GET(self):
     try:
       if self.path.endswith("/TheyMeet.html"):
          theFile = open("TheyMeet.txt")
          theString = theFile.read()
          newString = theString.format("They Meet", "picture1.jpg", "")
          self.send_response(200)
          self.send_header('Content-type','text/html')
          self.end_headers()
          self.wfile.write(newString)
          return
       elif self.path.endswith("/Marriage.html"):
          theFile = open("Marriage.txt")
          theString = theFile.read()
          newString = theString.format("Marriage", "picture2.jpg", "")
          self.send_response(200)
          self.send_header('Content-type','text/html')
          self.end_headers()
          self.wfile.write(newString)
          return
       elif self.path.endswith("/NewOther.html"):
          theFile = open("NewOther.txt")
          theString = theFile.read()
          newString = theString.format("NewOther", "picture2.jpg", "")
          self.send_response(200)
          self.send_header('Content-type','text/html')
          self.end_headers()
          self.wfile.write(newString)
          return
       elif self.path.endswith("/BigDaddy.html"):
          theFile = open("BigDaddy.txt")
          theString = theFile.read()
          newString = theString.format("Big Daddy", "picture3.jpg", "")
          self.send_response(200)
          self.send_header('Content-type','text/html')
          self.end_headers()
          self.wfile.write(newString)
          return
       elif self.path.endswith("/picture1.jpg"):
          self.send_response(200)
          self.send_header('Content-type','image/jpeg')
          imagefile = open("picture1.jpg",'rb')
          image = imagefile.read()
          imagefile.close()
          self.end_headers()
          self.wfile.write(image)
          return
       elif self.path.endswith("/picture2.jpg"):
          self.send_response(200)
          self.send_header('Content-type','image/jpeg')
          imagefile = open("picture2.jpg",'rb')
          image = imagefile.read()
          imagefile.close()
          self.end_headers()
          self.wfile.write(image)
          return
       elif self.path.endswith("/picture3.jpg"):
          self.send_response(200)
          self.send_header('Content-type','image/jpeg')
          imagefile = open("picture3.jpg",'rb')
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