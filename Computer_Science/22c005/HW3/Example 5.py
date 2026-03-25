# example5.py

# This function takes a first, middle and last name and outputs a
#username similar to your hawkid. For this we're assuming all the
#inputs are lowercase.
def userfy(firstName, middleName, lastName):
    return firstName[0] + middleName[0] + lastName
#now we'll test if it works.
print(userfy("corey", "jon", "oliver"))
print(userfy("john", "patrick", "doe"))

#Functions can save alot of work
firstName1 = "corey"
middleName2 = "patrick"
