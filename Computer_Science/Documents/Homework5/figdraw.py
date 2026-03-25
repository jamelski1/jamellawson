import teken

teken.rectangle(start=(50,20),color="cyan",
		fill="palegreen",height=200,width=200)

teken.circle(start=(120,120),radius=60,color="yellow",
		fill="white")

spec = "yellow orange red purple blue green" 
for i,c in enumerate(spec.split()):
  teken.line(start=(150,0),end=(50+20*i,100),color=c)

teken.label(start=(150,150),angle=45,
           text="Draw",color="darkviolet")

teken.show()
