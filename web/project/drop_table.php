<?php
// Create connection
$con=mysqli_connect("dbdev.cs.uiowa.edu","jllawsn","MwomvmeTs67R","db_jllawsn");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql= "DROP TABLE people";
 
 if (mysqli_query($con,$sql))
  {
  echo "Table people dropped successfully";
  }
else
  {
  echo "Error dropping table: " . mysqli_error($con);
  }
 ?>