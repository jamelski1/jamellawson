import types
'''
  teken module for SVG drawing

  module variable _canvas is used to hold a drawing, which is built
  up to include SVG code for drawing  
'''
_canvas = str()     
_loaded = False
_width = 400
_height = 400
_colors = {
    'aliceblue': '#f0f8ff',
    'antiquewhite': '#faebd7',
    'aqua': '#00ffff',
    'aquamarine': '#7fffd4',
    'azure': '#f0ffff',
    'beige': '#f5f5dc',
    'bisque': '#ffe4c4',
    'black': '#000000',
    'blanchedalmond': '#ffebcd',
    'blue': '#0000ff',
    'blueviolet': '#8a2be2',
    'brown': '#a52a2a',
    'burlywood': '#deb887',
    'cadetblue': '#5f9ea0',
    'chartreuse': '#7fff00',
    'chocolate': '#d2691e',
    'coral': '#ff7f50',
    'cornflowerblue': '#6495ed',
    'cornsilk': '#fff8dc',
    'crimson': '#dc143c',
    'cyan': '#00ffff',
    'darkblue': '#00008b',
    'darkcyan': '#008b8b',
    'darkgoldenrod': '#b8860b',
    'darkgray': '#a9a9a9',
    'darkgrey': '#a9a9a9',
    'darkgreen': '#006400',
    'darkkhaki': '#bdb76b',
    'darkmagenta': '#8b008b',
    'darkolivegreen': '#556b2f',
    'darkorange': '#ff8c00',
    'darkorchid': '#9932cc',
    'darkred': '#8b0000',
    'darksalmon': '#e9967a',
    'darkseagreen': '#8fbc8f',
    'darkslateblue': '#483d8b',
    'darkslategray': '#2f4f4f',
    'darkslategrey': '#2f4f4f',
    'darkturquoise': '#00ced1',
    'darkviolet': '#9400d3',
    'deeppink': '#ff1493',
    'deepskyblue': '#00bfff',
    'dimgray': '#696969',
    'dimgrey': '#696969',
    'dodgerblue': '#1e90ff',
    'firebrick': '#b22222',
    'floralwhite': '#fffaf0',
    'forestgreen': '#228b22',
    'fuchsia': '#ff00ff',
    'gainsboro': '#dcdcdc',
    'ghostwhite': '#f8f8ff',
    'gold': '#ffd700',
    'goldenrod': '#daa520',
    'gray': '#808080',
    'grey': '#808080',
    'green': '#008000',
    'greenyellow': '#adff2f',
    'honeydew': '#f0fff0',
    'hotpink': '#ff69b4',
    'indianred': '#cd5c5c',
    'indigo': '#4b0082',
    'ivory': '#fffff0',
    'khaki': '#f0e68c',
    'lavender': '#e6e6fa',
    'lavenderblush': '#fff0f5',
    'lawngreen': '#7cfc00',
    'lemonchiffon': '#fffacd',
    'lightblue': '#add8e6',
    'lightcoral': '#f08080',
    'lightcyan': '#e0ffff',
    'lightgoldenrodyellow': '#fafad2',
    'lightgray': '#d3d3d3',
    'lightgrey': '#d3d3d3',
    'lightgreen': '#90ee90',
    'lightpink': '#ffb6c1',
    'lightsalmon': '#ffa07a',
    'lightseagreen': '#20b2aa',
    'lightskyblue': '#87cefa',
    'lightslategray': '#778899',
    'lightslategrey': '#778899',
    'lightsteelblue': '#b0c4de',
    'lightyellow': '#ffffe0',
    'lime': '#00ff00',
    'limegreen': '#32cd32',
    'linen': '#faf0e6',
    'magenta': '#ff00ff',
    'maroon': '#800000',
    'mediumaquamarine': '#66cdaa',
    'mediumblue': '#0000cd',
    'mediumorchid': '#ba55d3',
    'mediumpurple': '#9370d8',
    'mediumseagreen': '#3cb371',
    'mediumslateblue': '#7b68ee',
    'mediumspringgreen': '#00fa9a',
    'mediumturquoise': '#48d1cc',
    'mediumvioletred': '#c71585',
    'midnightblue': '#191970',
    'mintcream': '#f5fffa',
    'mistyrose': '#ffe4e1',
    'moccasin': '#ffe4b5',
    'navajowhite': '#ffdead',
    'navy': '#000080',
    'oldlace': '#fdf5e6',
    'olive': '#808000',
    'olivedrab': '#6b8e23',
    'orange': '#ffa500',
    'orangered': '#ff4500',
    'orchid': '#da70d6',
    'palegoldenrod': '#eee8aa',
    'palegreen': '#98fb98',
    'paleturquoise': '#afeeee',
    'palevioletred': '#d87093',
    'papayawhip': '#ffefd5',
    'peachpuff': '#ffdab9',
    'peru': '#cd853f',
    'pink': '#ffc0cb',
    'plum': '#dda0dd',
    'powderblue': '#b0e0e6',
    'purple': '#800080',
    'red': '#ff0000',
    'rosybrown': '#bc8f8f',
    'royalblue': '#4169e1',
    'saddlebrown': '#8b4513',
    'salmon': '#fa8072',
    'sandybrown': '#f4a460',
    'seagreen': '#2e8b57',
    'seashell': '#fff5ee',
    'sienna': '#a0522d',
    'silver': '#c0c0c0',
    'skyblue': '#87ceeb',
    'slateblue': '#6a5acd',
    'slategray': '#708090',
    'slategrey': '#708090',
    'snow': '#fffafa',
    'springgreen': '#00ff7f',
    'steelblue': '#4682b4',
    'tan': '#d2b48c',
    'teal': '#008080',
    'thistle': '#d8bfd8',
    'tomato': '#ff6347',
    'turquoise': '#40e0d0',
    'violet': '#ee82ee',
    'wheat': '#f5deb3',
    'white': '#ffffff',
    'whitesmoke': '#f5f5f5',
    'yellow': '#ffff00',
    'yellowgreen': '#9acd32',
    }

def clear():
  global _canvas
  _canvas = str()

def setsize(width=400,height=400):
  global _width, _height
  _width, _height = width, height
  
def get():
  global _canvas
  return _canvas 

_htmlprefix = '''
<html>
<head>
<script type="text/JavaScript">
<!--
function timedRefresh(timeoutPeriod) {
	setTimeout("location.reload(true);",timeoutPeriod);
}
//   -->
</script>
</head>
<body onload="JavaScript:timedRefresh(5000);">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
'''
def show(delay=5):
  global _canvas, _loaded, _htmlprefix 
  import time, subprocess, os, platform
  try: 
     outfile = open("render.html",'w')
     outfile.write(_htmlprefix)
     outfile.write(_canvas)
     outfile.write('''\n</svg></body></html>\n''')
     outfile.close()
     if platform.system() == 'Windows':
        fullname = os.getcwd() + "\\render.html"
        time.sleep(delay)
        if not _loaded:
          subprocess.Popen([r'C:\Program Files (x86)\Google\Chrome\Application\chrome','file:\\\\\\'+fullname])
        _loaded = True
     elif platform.system() == 'Linux':
        time.sleep(delay)
        if not _loaded:
          subprocess.Popen("/usr/bin/google-chrome render.html".split())
        _loaded = True
     elif platform.system() == "Darwin":
     	time.sleep(delay)
        if not _loaded:
          subprocess.Popen("open render.html".split())
        _loaded = True
  except:
     pass

def bounceForm(duration=2,count="indefinite",
    attr="y", values="0; -45; 0; 16; -7; 0; 3; 0; -2; 0; 1; 0"):
  global _canvas, _width, _height, _colors
  _canvas += '\n<animate attributeName="{0}" dur="2s" '.format(attr)
  _canvas += 'values="'+values+'" repeatCount="{0}" />'.format(count)

def jiggleForm(duration=2,count="indefinite",attr="y"):
  xattr, yattr = "x", "y"
  if attr.startswith("c"): xattr, yattr = "cx", "cy" 
  bounceForm(duration=duration,count=count,attr=yattr)
  bounceForm(duration=duration,count=count,attr=xattr,
    values="0; 12; 2; 0; 10; 0; -8; 0; -15; 0; 4; 0; -1; 0")

def rainbowForm(duration=2,count="indefinite"):
  global _canvas, _width, _height, _colors
  values = "#ffffff; #ffddff; #ff88dd; #dddd88; #88ffdd; #ddffff; #ffffff"
  _canvas += '\n<animate attributeName="fill" dur="2s" '
  _canvas += 'values="'+values+'" repeatCount="{0}" />'.format(count)

def spinForm(pivot,duration=5,count="indefinite"):
  global _canvas, _width, _height, _colors
  x,y = pivot 
  _canvas += '\n<animateTransform '
  _canvas += 'attributeName="transform" '
  _canvas += 'attributeType="XML" '
  _canvas += 'type="rotate" '
  _canvas += 'from="0 {0} {1}" to="360 {0} {1}" '.format(x,y)
  _canvas += 'begin="0s" dur="{0}s" repeatCount="{1}"'.format(duration,count)
  _canvas += '>\n</animateTransform>\n'  

def line(start=(0,0),end=(0,0),color="black"):
  global _canvas, _width, _height, _colors
  if type(start) != types.TupleType or \
     type(end) != types.TupleType or \
     len(start) != 2 or \
     len(end) != 2 or \
     type(color) != types.StringType or \
     type(start[0]) != types.IntType or \
     type(start[1]) != types.IntType or \
     type(end[0]) != types.IntType or \
     type(end[1]) != types.IntType:
       raise TypeError("teken - line() got bad arguments")
  if color not in _colors:
     raise ValueError("teken - color name {0} not recognized".format(color))
  x1,y1 = start
  x2,y2 = end
  x2 -= x1
  y2 -= y1
  _canvas += '<g transform="translate({0} {1})">'.format(x1,y1)
  _canvas += '<line x1="0" y1="0" x2="{0}" y2="{1}" '.format(x2,y2) 
  _canvas += 'style="stroke: {0}; stroke-width: 3;">'.format(color)
  _canvas += "</line>"
  _canvas += "</g>"

def rectangle(start=(0,0),width=0,height=0,
              fill=None,color="black",angle=None,
	      spin=None,bounce=None,jiggle=None,rainbow=None):
  global _canvas, _width, _height, _colors
  if type(start) != types.TupleType or \
     len(start) != 2 or \
     type(color) != types.StringType or \
     type(fill) not in (type(None),types.StringType) or \
     type(start[0]) != types.IntType or \
     type(start[1]) != types.IntType or \
     type(width) != types.IntType or \
     type(height) != types.IntType or \
     angle and type(angle) != types.IntType or \
     (spin,angle,bounce,jiggle,rainbow).count(None) < 4:
        raise TypeError("teken - rect got bad arguments")
  if color not in _colors:
     raise ValueError("teken - color name not recognized")
  if fill and fill not in _colors:
     raise ValueError("teken - color name not recognized")

  x,y = start
  if not angle: angle = 0
  if spin == 0:  spin = "indefinite" 
  if bounce == 0:  bounce = "indefinite" 
  if jiggle == 0:  jiggle = "indefinite" 
  if spin or angle or bounce or jiggle: 
     _canvas += '<g transform="translate({0} {1}) rotate({2})">'.format(x,y,angle)
     x = y = 0
  pivot = (x+width/2,y+height/2)
  _canvas += '<rect x="{0}" y="{1}" width="{2}" height="{3}" '.format(x,y,width,height)
  if not fill: fill = "none"
  _canvas += 'fill="{0}" '.format(fill)
  _canvas += 'style="stroke: {0}; stroke-width: 3;">'.format(color)
  if spin: spinForm(pivot,count=spin)
  if bounce: bounceForm(count=bounce)
  if jiggle: jiggleForm(count=jiggle)
  if rainbow: rainbowForm(count=rainbow)
  _canvas += '</rect>'
  if spin or angle or bounce or jiggle:
     _canvas += '</g>'

def circle(start=(0,0),radius=0,
           fill=None,color="black",
	   bounce=None,jiggle=None,rainbow=None):
  global _canvas, _width, _height, _colors
  if type(start) != types.TupleType or \
     len(start) != 2 or \
     type(color) != types.StringType or \
     type(fill) not in (type(None),types.StringType) or \
     type(start[0]) != types.IntType or \
     type(start[1]) != types.IntType or \
     type(radius) != types.IntType or \
     (bounce,rainbow,jiggle).count(None) < 2 or \
     radius < 1:
       raise TypeError("teken - circle got bad arguments")
  if color not in _colors:
     raise ValueError("teken - color name not recognized")
  if fill and fill not in _colors:
     raise ValueError("teken - fill color name not recognized")

  x,y = start
  if bounce == 0:  bounce = "indefinite" 
  if jiggle == 0:  jiggle = "indefinite"
  if bounce or jiggle: 
     _canvas += '<g transform="translate({0} {1})">'.format(x,y)
     x = y = 0
  _canvas += '<circle cx="{0}" cy="{1}" r="{2}" '.format(x,y,radius)
  if not fill: fill = "none"
  _canvas += 'fill="{0}" '.format(fill)
  _canvas += 'style="stroke: {0}; stroke-width: 3;">'.format(color)
  if bounce: bounceForm(count=bounce,attr="cy")
  if jiggle: jiggleForm(count=jiggle,attr="cy")
  if rainbow: rainbowForm(count=rainbow)
  _canvas += '</circle>'
  if bounce or jiggle:
     _canvas += '</g>'

def polyline(points=None,color="black"):
  global _canvas, _width, _height, _colors
  if not points or type(points) != types.ListType:
     raise TypeError("teken - polyline got no points")
  if color not in _colors:
     raise ValueError("teken - color name not recognized")
  for p in points:
     if type(p) != types.TupleType or \
        len(p) != 2 or \
	type(p[0]) != types.IntType or \
	type(p[1]) != types.IntType or \
	p[0] < 1 or \
	p[1] < 1 or \
        p[0] > _width or \
	p[1] > _height:
           raise ValueError("teken - polyline got bad point values")
  _canvas += '<polyline fill="none" points="'
  for (x,y) in points:
     _canvas += "{0},{1} ".format(x,y)
  _canvas += '" style="stroke: {0}; stroke-width: 3;">'.format(color)
  _canvas += '</polyline>'

def polygon(points=None,color="black",fill=None):
  global _canvas, _width, _height, _colors
  if not points or type(points) != types.ListType:
     raise TypeError("teken - polyline got no points")
  if color not in _colors or \
     (fill and fill not in _colors):
     raise ValueError("teken - color name not recognized")
  for p in points:
     if type(p) != types.TupleType or \
        len(p) != 2 or \
	type(p[0]) != types.IntType or \
	type(p[1]) != types.IntType or \
	p[0] < 0 or \
	p[1] < 0 or \
        p[0] > _width or \
	p[1] > _height:
           raise ValueError("teken - polyline got bad point values")
  if not fill:  fill = "none"
  _canvas += '<polygon fill="{0}" points="'.format(fill)
  for (x,y) in points:
     _canvas += "{0},{1} ".format(x,y)
  _canvas += '" style="stroke: {0}; stroke-width: 3;">'.format(color)
  _canvas += '</polygon>'

def label(start=(0,0),text=None,color="black",angle=0):
  global _canvas, _width, _height, _colors
  if type(start) != types.TupleType or \
     len(start) != 2 or \
     type(color) != types.StringType or \
     not text or \
     type(text) != types.StringType or \
     any([c==d for c in text for d in "<>&#{}'\""]) or \
     type(start[0]) != types.IntType or \
     type(start[1]) != types.IntType or \
     type(angle) != types.IntType:
       raise TypeError("teken - label got bad arguments")
  if color not in _colors:
     raise ValueError("teken - color name not recognized")

  x,y = start
  if angle:
     _canvas += '<g transform="translate({0} {1}) rotate({2})">'.format(x,y,angle)
     x = y = 0
  _canvas += '<text x="{0}" y="{1}" '.format(x,y)
  _canvas += 'font-family="Verdana" font-size="24" fill="{0}">'.format(color)
  _canvas += text  # DANGER -- should be HTMLified
  _canvas += '</text>'
  if angle:
     _canvas += '</g>'


def ellipse(start=(0,0),color="black",fill=None,xlen=1,ylen=1,angle=0):
  global _canvas, _width, _height, _colors
  if type(start) != types.TupleType or \
     len(start) != 2 or \
     type(color) != types.StringType or \
     type(fill) not in (type(None),types.StringType) or \
     type(start[0]) != types.IntType or \
     type(start[1]) != types.IntType or \
     type(xlen) != types.IntType or \
     type(ylen) != types.IntType or \
     xlen < 1 or \
     ylen < 1 or \
     type(angle) != types.IntType:
       raise TypeError("teken - ellipse got bad arguments")
  if color not in _colors:
     raise ValueError("teken - color name not recognized")
  if fill and fill not in _colors:
     raise ValueError("teken - color name not recognized")

  x,y = start
  if xlen+x > _width:
     raise ValueError("teken - drawing width exceeds canvas")
  if ylen+y > _height:
     raise ValueError("teken - drawing height exceeds canvas")
  if angle:
     _canvas += '<g transform="translate({0} {1}) rotate({2})">'.format(x,y,angle)
     x = y = 0
  _canvas += '<ellipse cx="{0}" cy="{1}" rx="{2}" ry="{3}" '.format(x,y,xlen,ylen)
  if not fill: fill = "none"
  _canvas += 'fill="{0}" '.format(fill)
  _canvas += 'style="stroke: {0}; stroke-width: 3;">'.format(color)
  _canvas += '</ellipse>'
  if angle:
     _canvas += '</g>'
