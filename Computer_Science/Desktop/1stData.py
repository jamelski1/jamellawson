import sqlite3


def myDatabase():
    con = sqlite3.connect('myDatabase.db')
    cur = con.cursor()
    #cur.execute("""CREATE TABLE Database_Records( First Name text,
    #Last Name text, City text, State text, Gender text, Age int, Health Insurance Status text)""")
    
    people = [['Joe', 'Jackson', 'Iowa City', 'IA', 'Male', '32', 'YES'],['Steve', 'Jobs', 'New York', 'NY', 'Male', '54', 'YES'], ['Alice', 'Rudin', 'Seattle', 'WA', 'Female', '22', 'NO']]
    
    for i in range(len(people)):
        
        cur.execute("""INSERT INTO Database_Records VALUES (?,?,?,?,?,?,?)""", people[i])
        
    
    cur.execute('SELECT * FROM Database_Records')
    print cur.fetchall()
    con.commit()
    con.close()