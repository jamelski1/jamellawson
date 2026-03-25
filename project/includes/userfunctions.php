<?php

/**
*	@package User_Mangement
*/

/**
*	returns a row from the User table give the user's ID.
*	@param int $id the ID of the user
*	@return the row from the User table or null
*/
function getUserFromID($id)
{
	return getOneRow('User', 'uid', $id);
}

// get one user row with Role description
function getUserRowWithRole($id)
{
	global $DB_HOST, $DB_USER_ID, $DB_USER_PWD, $DB_DB_NAME;
	
	$conn = mysqli_connect($DB_HOST, $DB_USER_ID, $DB_USER_PWD, $DB_DB_NAME);
	if(mysqli_connect_errno($conn))
		reportErrorAndDie('Unable to connect to the server');
	
	
	$queryStr = 'SELECT *';
	$queryStr .= ' From role_user, people, role';
	$queryStr .= " WHERE role_user.people_id= " . $id . " AND people.people_id = role_user.people_id AND role_user.role_id = role.role_id";
	$result = mysqli_query($conn, $queryStr);
	if(mysqli_errno($conn))
		reportErrorAndDie('there was a database error',$conn , $queryStr);
		
	if(mysqli_num_rows($result) != 1)
		reportErrorAndDie('could not get a unique row from the database', $conn, $queryStr);
		
	$row = mysqli_fetch_assoc($result);
	if(mysqli_errno($conn))
		reportErrorAndDie('unable to get the row from the database'); 
	
	return $row;
}

// get a user row with the user's role title and favorite wood name
function getUserWithWoodAndRole($id)
{
	global $DB_HOST, $DB_USER_ID, $DB_USER_PWD, $DB_DB_NAME;
	
	$conn = mysqli_connect($DB_HOST, $DB_USER_ID, $DB_USER_PWD, $DB_DB_NAME);
	if(mysqli_connect_errno($conn))
		reportErrorAndDie('Unable to connect to the server');
		
	$queryStr = 'SELECT * From User, Role, Wood';
	$queryStr .= " WHERE User.RoleID=Role.rid and User.FavoriteWood=Wood.wid and ";
	$queryStr .= "User.uid=" . $id . ";";
	$result = mysqli_query($conn, $queryStr);
	if(mysqli_errno($conn))
		reportErrorAndDie('there was a database error', $conn, $queryStr);
		
	if(mysqli_num_rows($result) != 1)
		reportErrorAndDie('could not get a unique row from the database', $conn, $queryStr);
	
	$row = mysqli_fetch_assoc($result);
	if(mysqli_errno($conn))
		reportErrorAndDie('unable to get the row from the database'); 
	
	return $row;
}

function getCertsArray($userID)
{
	if(!isset($userID) || is_nan($userID))
		reportErrorAndDie('unable to get certification information...');
	
	global $DB_HOST, $DB_USER_ID, $DB_USER_PWD, $DB_DB_NAME;
	
	$conn = mysqli_connect($DB_HOST, $DB_USER_ID, $DB_USER_PWD, $DB_DB_NAME);
	if(mysqli_connect_errno($conn))
		reportErrorAndDie('Unable to connect to the server');
	
	$queryStr = 'select Tool.tid,Tool.ToolName from Tool,User,Certification where Certification.ToolID=Tool.tid and Certification.UserID=User.uid and User.uid ="' . $userID . '" order by Tool.ToolName;';
	
	$results = mysqli_query($conn, $queryStr);
	if(mysqli_errno($conn))
		reportErrorAndDie('unable to get certifications for this user', $conn, $queryStr);
	
	$retArray = array();
	while($certRow = mysqli_fetch_assoc($results))
		$retArray[$certRow['tid']] = $certRow['ToolName'];
	
	return $retArray;
}

function getCertsAsString($userID)
{
	if(!isset($userID) || is_nan($userID))
		reportErrorAndDie('unable to get certification information...');
	
	$certArray = getCertsArray($userID);
	$certStr = '';
	$numCerts = count($certArray);
	$index = 0;
	foreach($certArray as $cert)
	{
		$certStr .= $cert;
		if($index < $numCerts - 1)
			$certStr .= (', ');
		$index++;
	}
	
	return $certStr;
}

?>
