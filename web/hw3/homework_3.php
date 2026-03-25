<?php
echo('<html>');
echo('<head>');
echo('<link rel="stylesheet" type = "text/css" href = "myStyles.css">');
echo('</head>');


echo('<body>');
include_once("functions.php");

// include the header, menu

//$link = mysqli_connect("dbdev.cs.uiowa.edu","jllawsn","MwomvmeTs67R","db_jllawsn") or die("Error " . mysqli_error($link));


// write a query string that selects all records from the Wood table
@ $connection = new mysqli('dbdev.cs.uiowa.edu', 'jllawsn', 'MwomvmeTs67R', 'db_jllawsn');

if ($connection->connect_errno) {
        echo "Oops! We could not connect to the database.<p>\n This was the error we found: "
		. $connection->connect_error . "\n <p>Please <a href='input.php'>try again</a>";
        exit;
		}

$queryStr = 'Select * From Wood;';


// execute the query string and handle errors

$result = $connection->query($queryStr) or reportErrorAndDie('no row returned from' .' table', $queryStr);

// build HTML table:
//      column headings
//      all of the rows

echo('<table>');
	echo('<tr>');
		echo('<th> Wood ID </th>');
		echo('<th> Name </th>');
		echo('<th> Density </th>');
		echo('<th> Hardness </th>');
		echo('<th> Workability </th>');
		echo('<th> Color </th>');
		echo('<th> Notes </th>');
	echo('</tr>');


if ($result) {
        $numberofrows = $result->num_rows;
        
        for($i=0; $i < $numberofrows; $i++) {
            $row = $result->fetch_assoc();
            echo "\n <tr>";
            echo "\n <td>" . $row['wid'] . "</td>";
            echo "\n <td>" . $row['name'] . "</td>";
			echo "\n <td>" . $row['density'] . "</td>";
			echo "\n <td>" . $row['hardness'] . "</td>";
			echo "\n <td>" . $row['workability'] . "</td>";
			echo "\n <td>" . $row['color'] . "</td>";
			echo "\n <td>" . $row['notes'] . "</td>";
            echo "\n </tr>";
        }
        
    } else {
        echo "Something went wrong when retrieving people from the database.<p>";
        echo "This was the error: " . $connection->error . "<p>";
        echo "This was the sql statement: " . $queryStr;
//while($row=mysqli_fetch_assoc($result))
	//{
	//echo('<tr>');
		//foreach($row as $fieldName => $value)
			//echo('<td>' . $value . '</td>');
		//echo('</tr>');
		
		
	//echo($row['wid'] . ' | ' . $row['name'] . ' | ' . $row['density'] . ' | ' . $row['hardness'] . ' | ' . $row['workability'] . ' | ' . $row['color'] . ' | ' . $row['notes']);
	//echo($row['name'] . $row['density']);
	}
	echo('</table>');
	
mysqli_close($connection);
// close database
// connect using a bad password

echo('<a href="error.php">Error Page</a>');

// include the footer

echo('<body>');
echo('<footer> Homework 3 | Jamel Lawson | Copyright (c) 2013 <footer>');
echo('</html>');


?>
