<?php

/*
functions that wrap the database
*/

function releaseMemAndCloseDB($conn, $resultSet=null)
{
	if(isset($resultSet))
		mysqli_free_result($resultSet);
	mysqli_close($conn);
}

//Get all rows from a given table
function getAllRows($tableName, $orderby = '')
{
	global $DB_HOST, $DB_USER_ID, $DB_USER_PWD, $DB_DB_NAME;
	
	if(!isset($tableName))
		reportErrorAndDie('no table name supplied for database request');
		
	$conn = mysqli_connect($DB_HOST, $DB_USER_ID, $DB_USER_PWD, $DB_DB_NAME);
	if (mysqli_connect_errno($conn))
		reportErrorAndDie('unable to connect to the database');
	
	$queryStr = 'SELECT * FROM ' . $tableName;
	if(isset($orderby) && $orderby != '')
		$queryStr .= ' ORDER BY ' . $orderby;
	$queryStr .= ';';
	
	if(!$result = mysqli_query($conn, $queryStr))
		reportErrorAndDie("could not get any rows from the $tableName table", $conn, $queryStr);
	
	return $result;
}

//Get one row from a given table with a given value for a given field
function getOneRow($tableName, $fieldName, $fieldValue)
{
	global $DB_HOST, $DB_USER_ID, $DB_USER_PWD, $DB_DB_NAME;
	
	if(!isset($tableName))
		reportErrorAndDie('no table name supplied for database request');
	if(!isset($fieldValue) || !isset($fieldName))
		reportErrorAndDie('unable to get row from database');
		
	$conn = mysqli_connect($DB_HOST, $DB_USER_ID, $DB_USER_PWD, $DB_DB_NAME);
	if (mysqli_connect_errno($conn))
		reportErrorAndDie('unable to connect to the database');
	
	$queryStr = 'SELECT * FROM ' . $tableName . ' where ' . $fieldName;
	$queryStr .= "='" . $fieldValue . "';";
		
	if(!$result = mysqli_query($conn , $queryStr))
		reportErrorAndDie('could not get any rows from the ' . $tableName . 
			' table', $conn , $queryStr);
	if(mysqli_num_rows($result) != 1)
		reportErrorAndDie('could not a unique row from the ' . $tableName . 
			' table', $conn, $queryStr);
	if(!$row = mysqli_fetch_assoc($result))
		reportErrorAndDie('could not get a row from the ' . $tableName . 
			' table', $conn , $queryStr);
		
	releaseMemAndCloseDB($conn, $result);
		
	return $row;
}

?>
