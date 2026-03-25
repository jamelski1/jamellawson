<?php

function reportErrorAndDie($errMessage, $queryStr = '')
{
     $lastPart = '';
     
     if($queryStr != '')
         $lastPart .= 'Error Number: ' . mysqli_errno() . '<br>' .
                      'Description: ' . mysqli_error() . '<br>' .
                      'Query String: ' . $queryStr . '<br>';

     echo($errMessage . '<br>' . $lastPart);

}

function connect($dbHost, $dbUserID, $dbPassword, $dbName)
{
	//$connection = mysqli_connect("dbdev.cs.uiowa.edu","jllawsn","MwomvmeTs67R","db_jllawsn");
	@ $connection = new mysqli('dbdev.cs.uiowa.edu', 'jllawsn', 'MwomvmeTs67R', 'db_jllawsn');
	
	if ($connection->connect_errno) {
        echo "Oops! We could not connect to the database.<p>\n This was the error we found: "
		. $connection->connect_error . "\n <p>Please <a href='input.php'>try again</a>";
        exit;
		}
	// @if($connection->connect_errno){
	 
		//echo "Oops! We could not connect to the database. 
			//<p>\n This was the error we found: " . $connection->connect_error . "\n <p>Please <a href='input.php'>try again</a>";
			//exit;
	 //}
     //@if(!isset($connection))
        //  reportErrorAndDie('Unable to connect to the server');
		  

     //@if(!mysqli_select_db($connection, $dbName))
         // reportEorrorAndDie('Unable to select the database');
		  
	return $connection;

}

$db = new mysqli('dbdev.cs.uiowa.edu', 'jllawsn', 'MwomvmeTs67R', 'db_jllawsn');



?>
