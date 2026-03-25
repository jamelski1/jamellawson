def squares(n = 0):
    list = []

    if type(n) is int and n > 0:
        for i in range(1, n+1):
            list.append(i**2)
    return list
n = input("Enter a positive integer:")
if type(n) is int and n > 0:
    print list
else:
    print list

print squares(n)