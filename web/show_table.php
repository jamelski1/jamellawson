<?php
// Create connection
$con=mysqli_connect("dbdev.cs.uiowa.edu","jllawsn","MwomvmeTs67R","db_jllawsn");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con,"SELECT * FROM Persons");

while($row = mysqli_fetch_array($result))
  {
  echo $row['FirstName'] . " " . $row['LastName'];
  echo "<br>";
  }
 mysqli_close($con);
 ?>