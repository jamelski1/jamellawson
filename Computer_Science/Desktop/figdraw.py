import teken

counter = 100

x,y = 0,0

while counter > 0:
  teken.rectangle(start=(x,y),color="black",
                  fill="red",height=200,width=200)
  x += 20
  y += 20
  counter -= 15
  

teken.circle(start=(120,120),radius=60,color="yellow",
		fill="white")

a,b = 150,0

spec = "black yellow black yellow black yellow" 
for i,c in enumerate(spec.split()):
  teken.line(start=(a,b),end=(50+20*i,100),color=c)
  a -=15
  b +=20

teken.label(start=(150,150),angle=45,
           text="Draw",color="darkviolet")

teken.show()
