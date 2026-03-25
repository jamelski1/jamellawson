# First let's find this longest string in this ymmy list of eggies.
veggies = ["broccoli", "tomato", "peas", "cauliflower", "carrots"]

longestString = ""

for veg in veggies:
    if len(veg) > len(longestString):
        longestString = veg
        
print("The longest string is: " + longestString)

# Now we'll take a list of numbers and calculate their sum

numbers = [2, 5, 3, 9, 10]

sum =0

for number in numbers:
    sum = sum + number
    
print("The sum of the list is: " +str(sum))