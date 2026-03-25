import xml.sax

class HTMLContentHandler(xml.sax.ContentHandler):
  def __init__(self):
    xml.sax.ContentHandler.__init__(self)
 
  def startElement(self, name, attrs):
  	print 'start', name, 
	for attrName in attrs.getNames():
		print attrName, '=', attrs.getValue(attrName),
	print
  	
  def endElement(self, name):
  	print 'end', name
 
def main(sourceFileName):
	source = open(sourceFileName)
	contentHandler = HTMLContentHandler()
	xml.sax.parse(source, contentHandler)
  
if __name__ == "__main__":
	main('html/index.html')