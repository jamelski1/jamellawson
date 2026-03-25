# Automatic solver for substitution ciphers, using CHURN algorithm
#import python module to make random numbers
from random import randrange
# .....declarations of strings, lists and variables.....
alphabet='abcdefghijklmnopqrstuvwxyz'
cipher=''
plain=''
parent=['A']*26
child = ['A'] * 26
value = [0,0,0,0,0,1,1,1,1,1,2,2, 2, 3, 4, 4, 5, 6, 8, 15]
bestscore=0
length=0
nok=0
#... This is table of digraph frequencies.....
frequency= [
4,7,8,7,4,6,7,5,7,3,6,8,7,9,3,7,3,9,8,9,6,7,6,5,7,4,
7,4,2,0,8,1,1,1,6,3,0,7,2,1,7,1,0,6,5,3,7,1,2,0,6,0,
8,2,5,2,7,3,2,8,7,2,7,6,2,1,8,2,2,6,4,7,6,1,3,0,4,0,
7,6,5,6,8,6,5,5,8,4,3,6,6,5,7,5,3,6,7,7,6,5,6,0,6,2,
9,7,8,8,8,7,6,6,7,4,5,8,7,9,7,7,5,9,9,8,5,7,7,6,7,3,
7,4,5,3,7,6,4,4,7,2,2,6,5,3,8,4,0,7,5,7,6,2,4,0,5,0,
7,5,5,4,7,5,5,7,7,3,2,6,5,5,7,5,2,7,6,6,6,3,5,0,5,1,
8,5,4,4,9,4,3,4,8,3,1,5,5,4,8,4,2,6,5,7,6,2,5,0,5,0,
7,5,8,7,7,7,7,4,4,2,5,8,7,9,7,6,4,7,8,8,4,7,3,5,0,5,
5,0,0,0,4,0,0,0,3,0,0,0,0,0,5,0,0,0,0,0,6,0,0,0,0,0,
5,4,3,2,7,4,2,4,6,2,2,4,3,6,5,3,1,3,6,5,3,0,4,0,5,0,
8,5,5,7,8,5,4,4,8,2,5,8,5,4,8,5,2,4,6,6,6,5,5,0,7,1,
8,6,4,3,8,4,2,4,7,1,0,4,6,4,7,6,1,3,6,5,6,1,4,0,6,0,
8,6,7,8,8,6,9,6,8,4,6,6,5,6,8,5,3,5,8,9,6,5,6,3,6,2,
6,6,7,7,6,8,6,6,6,3,6,7,8,9,7,7,3,9,7,8,9,6,8,4,5,3,
7,3,3,3,7,3,2,6,7,2,1,7,3,2,7,6,0,7,6,6,6,0,3,0,4,0,
0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,6,0,0,0,0,0,
8,6,6,7,9,6,6,5,8,3,6,6,6,6,8,6,3,6,8,8,6,5,6,0,7,1,
8,6,7,6,8,6,5,7,8,4,6,6,6,6,8,7,4,5,8,9,7,4,7,0,6,2,
8,6,6,5,8,6,5,9,8,3,3,6,6,5,9,6,2,7,8,8,7,4,7,0,7,2,
6,6,7,6,6,4,6,4,6,2,3,7,7,8,5,6,0,8,8,8,3,3,4,3,4,3,
6,1,0,0,8,0,0,0,7,0,0,0,0,0,5,0,0,0,1,0,2,1,0,0,3,0,
7,3,3,4,7,3,2,8,7,2,2,4,4,6,7,3,0,5,5,5,2,1,4,0,3,1,
4,1,4,2,4,2,0,3,5,1,0,1,1,0,3,5,0,1,2,5,2,0,2,2,3,0,
6,6,6,6,6,6,5,5,6,3,3,5,6,5,8,6,3,5,7,6,4,3,6,2,4,2,
4,0,0,0,5,0,0,0,3,0,0,2,0,0,3,0,0,0,1,0,2,0,0,0,4,4,]
def decipher(key):
    plain=''
    print key
    for j in range(length):
        for k in range(26):
            if(cipher[j]==key[k]):
                plain = plain + alphabet[k]
                break
    return(plain)
def get_score():
    #...add scores of all digraphs.......... 
    score=0
    for j in range(length-1):
        fi=alphabet.index(plain[j])
        se=alphabet.index(plain[j+1])
        product=26*fi+se
        score=score+frequency[product]
    #...if a plain letter is same as its cipher, reduce score..........     
    flag=0
    for j in range(length):
        x=ord(cipher[j])-65;y=ord(plain[j])-97
        if(x==y):
            flag=1
            break
    if(flag==1):
        score=score-100
    return(score)
def show_best():
    #...if score is best to date, print out score, key & plaintext..........       
    print 'score=',bestscore,'   nr of keys=',nok
    print 'key = ',
    a=''
    for m in range(26):
        a=a+child[m]
        print a
        print
        a=''
        for m in range(length):
            a=a+plain[m]  
        print a 
        print    
# ---------------------------------------------------------------------------
ciphertext = '''ACRMQ IFNFU DQFQZ OMOHM HIHAD TFKQZ OPHEE FTQZO KRDDA DIQAN
OAMHU AENPH EEHDN HPEOH KPHEE QZHQC HWDFQ YONOD AONHD NHEEA HMLAM HUADN WNHWU
AQZQZ OUZAQ OPEFR NMTEW ADIHD NQZOT ERDIM GKHWH DNQZO YEFUD MGRCO HDNQZ OMOHI
REEMP KWADI''' 

print "hjfds"
length=len(ciphertext);
for j in range(length):
    if(ciphertext[j]>='A' and ciphertext[j] <='Z'):
        cipher=cipher+ciphertext[j]
length=len(cipher)        
print length
#...make 1st parent key.......... 
key =  'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
for m in range(26):
    parent[m]=key[m]
#..decipher & score with 1st parent.... 
plain=decipher(parent)
parentscore=get_score()
print parentscore
#......CHURN  process.......
repeat=1
while repeat>0:
    print "tesT"
    #........make child key.....
    for m in range(26):
        child[m]=parent[m]
    print child
    p=randrange(26);q=randrange(26)
    buff=child[p]; child[p]=child[q];child[q]=buff
    nok+=1  
    #........decipher with child key & score.....
    plain=decipher(child)
    childscore=get_score()
    print childscore
    #....if childscore passes test, make child into parent.....
    x=randrange(20)
    if(childscore>parentscore-value[x]):
        parentscore=childscore
        for m in range(26):
            parent[m]=child[m]
    #....if childscore best to date show key,plaintext
    if(childscore>bestscore):
        bestscore=childscore        
        show_best()