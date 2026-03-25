import teken

def drawstate(state):
   D = {"A":(20,10,"yellow"),"B":(35,10,"blue"),"C":(50,10,"green"),"D":(65,10,"red")}
   teken.clear()
   for i in range(3): 
    p = (90+i*100,20)
    teken.rectangle(start=p,width=10,height=100,fill="black",color="black")
    s = 110 
    for char in reversed(state[i]):
      w, h, c = D[char]
      k = 5 + p[0] - w/2
      np = (k,s)
      teken.rectangle(start=np,width=w,height=h,color=c,fill=c,rainbow=1)
      s -= 15
   print "showing"
   teken.show()
      
def Hanoi(height, goal, state):
   to,source,other = goal
   if height < 1: 
      return 
   subgoal = (other,source,to)
   Hanoi(height-1, subgoal, state)
   disk = state[source][0] 
   state[to] = disk + state[to]
   state[source] = state[source][1:]
   drawstate(state)
   subgoal = (to,other,source)
   Hanoi(height-1, subgoal, state)

startingGoal = (2,0,1)
startingState = ["ABCD",'','']
drawstate(startingState)
Hanoi(4, startingGoal, startingState)
