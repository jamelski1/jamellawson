
#operation that will effect the entire list

a = [2, 4, 6]
b = [7, 8, 9]

c=[3 * i for i in a]
#this the same as
#for i in range(len(a)):
#   c.append(a[i] * 3)
print (c)

c=[3 * i for i in a if i > 5]
#this is the same as:
#for i in range(len(a)):
#   if i > 5:
#       c.append(a[i] # 3)
print (c)

c = [i + j for i in a for j in b]
#this is same as:
#c = []
#for i in range(len(a)):
#     for j in range len(b)):
#         c.append(a[i] + b[j])
print(c)