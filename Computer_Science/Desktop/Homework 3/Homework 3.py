import xml.sax
import httplib
import sys

class HTMLContentHandler(xml.sax.ContentHandler):


	def __init__(self):
		xml.sax.ContentHandler.__init__(self)
		self.refs = []
	
	def startElement(self, name, attrs):
		if(name == "a"):
			url = attrs.getValue('href')
			self.refs.append(str(url))

	"""def getUrls(sourceFileName):
		source = open(sourceFileName)
		contentHandler = HTMLContentHandler()
		xml.sax.parse(source, contentHandler)
		refs = contentHandler.refs
		return refs"""


	
def getPage(hostname, link, name):
	conn = httplib.HTTPConnection(hostname)
	conn.request("GET", link)
	r1 = conn.getresponse()
	print r1.status, r1.reason
	if (r1.status != 200):
		print error
		sys.exit(-1)
	data1 = r1.read()
	f = open(name, 'w')
	f.writelines(data1)
	f.close()
		
def getUrls(sourceFileName):
		source = open(sourceFileName)
		contentHandler = HTMLContentHandler()
		xml.sax.parse(source, contentHandler)
		refs = contentHandler.refs
		return refs		

if __name__ == "__main__":
	getPage('homepage.cs.uiowa.edu', '/~ochipara/html-absolute/index.html','index.html')
	urls = getUrls("/index.html")
	for url in urls:
		#print url
		parts = url.split('/')
		hostname = parts[2]
		path = '/' + '/'.join(parts[3:])
		fn = parts[-1]
		getPage(hostname, path, fn)
		print fn
		new_urls = getUrls(fn)
		#print new_urls
		urls.extend(new_urls)