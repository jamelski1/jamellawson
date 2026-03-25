<?php
// Create connection
$con=mysqli_connect("dbdev.cs.uiowa.edu","jllawsn","MwomvmeTs67R","db_jllawsn");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
// Create table
//$sql="CREATE TABLE Persons(FirstName CHAR(30),LastName CHAR(30),Age INT)";

/*$sql = "CREATE TABLE Persons 
(
PID INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY(PID),
FirstName CHAR(15),
LastName CHAR(15),
Age INT
)"; */

$sql_drop = "DROP TABLE IF EXISTS people;";

// Execute query
if (mysqli_query($con,$sql_drop))
  {
  echo "Table people dropped successfully<br>";
  }
else
  {
  echo "Error dropping table: " . mysqli_error($con) . "<br>";
  }

$sql_create = "CREATE TABLE people (
    id INT NOT NULL AUTO_INCREMENT,
    firstname VARCHAR(45) NOT NULL,
    lastname VARCHAR(45) NOT NULL,
    PRIMARY KEY (ID)
);";

if (mysqli_query($con,$sql_create))
  {
  echo "Table people created successfully";
  }
else
  {
  echo "Error creating table: " . mysqli_error($con);
  }



/*mysqli_query($con,"INSERT INTO Persons (FirstName, LastName, Age)
VALUES ('Peter', 'Griffin',35)");

mysqli_query($con,"INSERT INTO Persons (FirstName, LastName, Age)
VALUES ('Glenn', 'Quagmire',33)"); */




mysqli_close($con);
?> 
