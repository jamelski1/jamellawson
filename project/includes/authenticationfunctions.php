<?php

/*

Authentication functions

*/

function isLoggedIn()
{
	if(!isset($_SESSION))
		session_start();
	
	return isset($_SESSION['id']);
}

// returns a user row with role id and role title
function getLoggedInUser()
{
	if(!isset($_SESSION))
		session_start();
	
	if(!isLoggedIn())
		return null;
	
	return getUserRowWithRole($_SESSION['id']);
}

function isAdmin()
{
	global $ADMIN_ROLE;
	
	if(!isset($_SESSION))
		session_start();
	
	if(!isLoggedIn())
		return false;
	
	$currUserRow = getLoggedInUser();
	
//<<<<<<< BEGIN MERGE CONFLICT: local copy shown first <<<<<<<<<<<<<<<
	//return isset($currUserRow) && $currUserRow['admin'] == $ADMIN_ROLE;
//======= COMMON ANCESTOR content follows ============================
	//return isset($currUserRow) && $currUserRow['administration'] == $ADMIN_ROLE;
//======= MERGED IN content follows ==================================
	return isset($currUserRow) && $currUserRow['role_id'] == $ADMIN_ROLE;
//>>>>>>> END MERGE CONFLICT >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
}

function isMember()
{
	if(!isset($_SESSION))
		session_start();
	
	if(!isLoggedIn())
		return false;
	
	$currUserRow = getLoggedInUser();
	
	return isset($currUserRow) && $currUserRow['RoleID'] == $MEMBER_ROLE;
}

function makeSalt()
{
	return md5(mt_rand());
}

?>
