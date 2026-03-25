<?php

include_once($INCLUDES_DIR . 'database.php');
include_once($INCLUDES_DIR . 'userfunctions.php');
include_once($INCLUDES_DIR . 'pagebuildingfunctions.php');
include_once($INCLUDES_DIR . 'formfunctions.php');
include_once($INCLUDES_DIR . 'authenticationfunctions.php');

function reportErrorAndDie($message, $link = null, $queryStr = '')
{
	$lastPart = '';
	if($queryStr != '')	// the error resulted from a database query
		$lastPart = 	'<br />mysql error number: ' . mysqli_errno($link) .  
				'<br />mysql error description: ' . mysqli_error($link) . 
				'<br /> using this query string: ' . $queryStr;
	
	die($message . $lastPart);
}

?>
