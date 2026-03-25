<?php

/**
*       @package security
*/

/*
* createRole
*
* This function creates a role in the Role table.
*
* @param string $role Name of role to be created.
* @return boolean Result of creation
* @author Isaac Schlichtemeier
* @version 1.0
*/
function createRole($role, $val) 
{
	global $ROLE_TABLE_NAME;
	global $RoleNameFieldName;
	global $RoleValueFieldName;
	
	$attributes = array( $RoleNameFieldName => $role, $RoleValueFieldName => $val);
	
	$connection = connect();
	insertRecord($connection, $ROLE_TABLE_NAME, $attributes);
	closeDb($connection);
	
	return true;
}

/*
* alterRole
*
* This function alters a role in the Role table.
*
* @param string $role Name of role to be altered.
* @param int $val New value for the role being altered.
* @return boolean Result of alteration.
* @author Isaac Schlichtemeier
* @version 1.0
*/
function alterRole($role, $val) {
	global $ROLE_TABLE_NAME;
	global $RoleValueFieldName;
	
	$attributes = array( $RoleValueFieldName => $val);
	$where = array( $RoleNameFieldName => $role);
	
	$connection = connect();
	updateRecord($connection, $ROLE_TABLE_NAME, $attributes, $where);
	closeDb($connection);	
	
	return true;
}

/*
* deleteRole
*
* This function deletes the role from the Role table.
*
* @param string $role Name of role to be deleted.
* @return boolean Result of deletion
* @author Isaac Schlichtemeier
* @version 1.0
*/
function deleteRole($role) {
	global $ROLE_TABLE_NAME;
	
	$connection = connect();
	deleteRecord($connection, $USER_TABLE_NAME, $role);
	closeDb($connection);	
	
	return true;
}

/*
* hasPermissionFromRoleName
*
* This function takes a role name and checks to see if the current user has a permission of at least
* the value provided.
*
* @param string $name The Role name that you are checking against.
* @return boolean Result of role check.
* @author Isaac Schlichtemeier
* @version 1.0
*/
function hasPermissionFromRoleName($name) {
	global $ROLE_TABLE_NAME;
	global $RoleNameFieldName;
	global $RoleValueFieldName;
	
	$connection = connect();
	$row = getRecordByCriteria($connection, $ROLE_TABLE_NAME, $RoleNameFieldName, $name);	
	closeDb($connection);
	
	return hasPermissionFromRole($row[$RoleValueFieldName]);
}

/*
* hasPermissionFromRole
*
* This function takes a role value and checks to see if the current user has a permission of at least
* the value provided.
*
* @param int $val The value that you are checking against.
* @return boolean Result of role check.
* @author Isaac Schlichtemeier
* @version 1.0
*/
function hasPermissionFromRole($val) {
	global $RoleValueFieldName;
	global $RoleNameFieldName;
	global $ROLE_TABLE_NAME;
	global $UserNonceFieldName;
	
	if (!isLoggedIn())
		{return false;}
	else {
		$role = getRole($_SESSION['id']); // returns a string
		
		$connection = connect();
		$row = getRecordByCriteria($connection, $ROLE_TABLE_NAME, $RoleNameFieldName, $role);	
		closeDb($connection);				
		
		if (isset($row[$RoleValueFieldName]))
			{return $val >= $row[$RoleValueFieldName];}
		else return false;
	}		
}


/*
* getIdFromNonce
*
* This function takes the nonce that is being used as the session ID and returns the auto
* incremented ID from the database of the user that is static on each login.
*
* @param string $nonce the nonce that is found in $_SESSION["id"]
* @return int auto incremented id from database
* @author Isaac Schlichtemeier
* @version 1.0
*/
function getIdFromNonce($nonce) {
	
	global $USER_TABLE_NAME;
	global $UserNonceFieldName;
	global $UserIdFieldName;


	$connection = connect();
	$row = getRecordByCriteria($connection, $USER_TABLE_NAME, $UserNonceFieldName, $nonce);
	
	closeDb($connection);
	
	return $row[$UserIdFieldName];

}

/**
* addUser
*
* This function takes arrays in key => value pairs and attempts to add that information
* to the database as a new user. Return value is TRUE if succesful, FALSE if unsuccesful.
*
* You are required to pass all values that are in the config.php file for $USER_TABLE_VALUES 
*
* @param array $attributes this is an associative array containing all the user's information
* @return boolean this will true if the user was successfully added to the database
* @author Isaac Schlichtemeier
* @version 1.0
*
*/
function addUser($attributes)
{
		global $USER_TABLE_NAME;
		global $UserLoginFieldName;
		global $UserPwdFieldName;
		global $UserSaltFieldName;
		global $UserRoleFieldName;
		global $UserNonceFieldName;

		if(isUser( $attributes[$UserLoginFieldName] )) {
			return false;			
		}
		else {
			$salt = createSalt();
			$attributes[$UserPwdFieldName] = hash("sha256", ($attributes[$UserPwdFieldName] . $salt));

			$attributes[$UserSaltFieldName] = $salt;
			$attributes[$UserNonceFieldName] = "not_set";
			
			$connection = connect();
			insertRecord($connection, $USER_TABLE_NAME, $attributes);
			closeDb($connection);
			return true;
		}
}

/**
* isUser
*
* Checks to see if the Login name is already in use in the database.
*
* @param string $Login this is the Login name to see if it exists in the User table
* @return boolean returns result of user existing in database
* @author Isaac Schlichtemeier
*/
function isUser($Login)
{
		global $USER_TABLE_NAME;
		global $UserLoginFieldName;

		$connection = connect();
		$row = getRecordByCriteria($connection, $USER_TABLE_NAME, $UserLoginFieldName, $Login);
		closeDb($connection);	
		
		if ($row == false ) { return false;}
		else {return true;}		
		
		//return !((mysql_num_rows($row) > 0));
}

/**
* updateUser
*
* This function takes input of a userID and an array of key => value pairs and
* attempts to modify the user associated with the userID with the information
* given in the array.  Return value is TRUE if succesful, FALSE if unsuccesful.
*
* Your values that are to be updated must be in the config.php file for $USER_TABLE_VALUES
*
* @param int $userid userID of users row to be edited
* @param array $attributes key => value pairs
* @return boolean result of change
* @author Isaac Schlichtemeier
* @version 1.0
*
*/
function updateUser($id, $attributes)
{

		global $USER_TABLE_NAME;
		global $UserIdFieldName;
			
		$connection = connect();
		$where = array ($UserIdFieldName => $id);
		$test  = updateRecord($connection, $USER_TABLE_NAME, $attributes, $where);
		closeDb($connection);
		
		//var_dump($test);
		return true;
}

/**
* deleteUser
*
* This function takes input of a userID attempts to delete the user associated
* with the userID.  Return value is TRUE if succesful, FALSE if unsuccesful.
*
* @param int $userid userID of users row to be deleted
* @return boolean result of removal
* @author Isaac Schlichtemeier
* @version 1.0
*
*/
function deleteUser($id)
{

		global $USER_TABLE_NAME;
		global $UserIdFieldName;
		
		$connection = connect();
		deleteRecord($connection, $USER_TABLE_NAME,$UserIdFieldName, $id);
		closeDb($connection);

		return true;
}

/**
* createNonce
*
* This function creates a Nonce and verifies that it is not in use by any other user
* so that there is no overlap for session IDs.  Return value is a unique nonce as a string.
*
* @return string the new nonce
* @author Roy Zhang
* @version 1.0
*
*/
function createNonce()
{
       $hash = hash("sha256", time());
       return (string) $hash;
}

/**
* createSalt
*
* This function creates a Salt to be stored in user row for combining with password.
* This currently makes no guarentees about the Salt's uniqueness but may change in future.
* Return value is a Salt as a string.
*
* @return string the Salt
* @author Roy Zhang
* @version 1.0
*
*/
function createSalt(){

	return (string)uniqid(mt_rand());

}


/**
* getNonce
*
* This function looks for the unique Nonce then returns the value
*
* @uses $USR
* @uses $SALT
* @param $id
* @return string
* @author Jason Larson
* @version 1.0
*
*/

function getNonce($id){

		global $USER_TABLE_NAME;
		global $UserIdFieldName;
		global $UserNonceFieldName;
		
		$connection = connect();
		$row = getRecordByCriteria($connection, $USER_TABLE_NAME, $UserIdFieldName, $id);
		closeDb($connection);

		return $row[$UserNonceFieldName];
}


/**
* isLoggedIn
*
* This function checks whether a user is logged in using session variables, and returns a boolean. It also ensures that the user hasn't timed out
*
*@
* @return boolean true if $_SESSION[$UserIdFieldName] is set, otherwise returns false
* @author Steve Strong, Shawn Salat
* @version 1.0
*
*/
function isLoggedIn(){
	
	return(isset($_SESSION['id']));
}


/**
* getUserFromId
*
* This function returns the row of te User from the provided Id
*
*
* @param string $id this is the id of the user to be looked up in the database
* @return array this returns an associative array of the values that match with that user's id in the database
* @author Isaac Schlichtemeier
* @version 1.0
*
*/
function getUserFromId($id){
	global $USER_TABLE_NAME;
	global $UserIdFieldName;
	
	$connection = connect();
	$row = getRecordByCriteria($connection, $USER_TABLE_NAME, $UserIdFieldName, $id);
	closeDb($connection);
	
	return $row;

}

/**
* getUserFromNonce
*
* This function returns the row of the User from the provided nonce
*
*
* @param string $nonce this is the nonce of the user to be looked up in the database
* @return array this returns an associative array of the values that match with 
* 	that user's id in the database or false if no row is returned
* @author Isaac Schlichtemeier
* @version 1.0
*
*/
function getUserFromNonce($nonce) {
	
	if(!isset($nonce))
		return false;
	
	$id = getIdFromNonce($nonce);
	
	return getUserFromId($id);
}

 /**
 * getRole
 *
 * returns the value in the role column or -1 if $nounce is null
 *
 *
 * @param $id the autoincremented value of the primary key in the User table
 * @return int the id
 * @author Roy Zhang
 * @version 1.0
 *
 */
 function getRole($nonce){
 	 
 	 global $USER_TABLE_NAME;
 	 global $UserIdFieldName;
 	 global $UserRoleFieldName;
	
 	 $id = getIdFromNonce($nonce);
 	 
 	 $connection = connect();
 	 $row = getRecordByCriteria($connection, $USER_TABLE_NAME, $UserIdFieldName, $id);
 	 closeDb($connection);
	
 	 return $row[$UserRoleFieldName];

 }

/**
* isAdmin
*
* This function returns true if the user is an admin and false if not
*
*
* @param string $_SESSION['role'] this defines the role of the currently logged in user
* @return boolean this returns true if $_SESSION['role'] is equal to 'admin', otherwise returns false
* @author Shawn Salat
* @version 1.0
*
*/
function isAdmin()
{
	//return hasPermissionFromRole(0);
	
	return isLoggedIn() && getRole($_SESSION['id']) == 0;
}


/**
* Authenticate
*
* This function initially calls function getOneRow from our library using the login id sent as a 
* parameter. Next the password (sent as a parameter) has the users salt concatenated to it and the 
* result us hashed using sha256. If the result of this matched the users password (stored in the database)
* and this user hasn't failed to log in 4 times in the last 15 minutes, the user is authenticated. Then 
* a nonce is retrieved and set as the nonce variable in the database and the id of the session. Finally a
* a timeout is set for the nonce which will be for 15 minutes with no activity. The session is then started and true
* is returned.     
* 
* @param $id the username of the user trying to login 
* @param $pw the password of the user trying to login
* @return boolean of whether the authentication was successful 
* @author Alex Gerard
* @version 1.0
*
*/ 
function authenticate($login, $pw){ 
	global $USER_TABLE_NAME;
	global $UserIdFieldName;
	global $UserNonceFieldName;
	global $UserLoginFieldName;
	global $UserSaltFieldName;
	global $UserPwdFieldName; 

	$connection = connect();

	$row =  getRecordByCriteria($connection, $USER_TABLE_NAME, $UserLoginFieldName, $login);
	closeDb($connection);

	$Password = hash( "sha256", $pw.$row[$UserSaltFieldName] );
	
	if( ( $row[$UserPwdFieldName] == $Password )  && getFailedLoginAttempts( $row[$UserIdFieldName] , 0,15 ) < 4){
		$n = createNonce();	
		$attr = array($UserNonceFieldName => $n); 		
		updateUser($row[$UserIdFieldName], $attr);
		$_SESSION['id'] = $n;
		siteTrackingLogin($login);
		return true; 
	}
	else{
		addFailedLoginAttempt( $login );	
		return false;
	}
}

/**
* logOut
*
* This function calls session_destroy to try and destroy a current session if it is 
* successful it also sets the time out variable in the database to 0. Otherwise false is 
* returned.   
*
* @return boolean of whether the logout was successful
* @author Alex Gerard
* @version 1.0
*
*/
function logOut(){
	
	if(!isset($_SESSION['id']))
		return false;
	
	global $UserLoginFieldName;


	if( session_destroy() ){
		$name = getLoggedInUser();
		siteTrackingLogout($name[$UserLoginFieldName]);

		return true;
	}
	else{
		return false;
	}
}

/**
* getLoggedInUser
*
* This function simply calls isLoggedIn() from our function library to see if a user is logged in, 
* and returns the session id (by calling session_id() ) if their is.  
*
* @return string of logged in users session id 
* @author Alex Gerard
* @version 1.0
*
*/
function getLoggedInUser(){
	
	if( isLoggedIn() )
		return getUserFromNonce($_SESSION['id']);
	else
		return false;
}

/**
* getSalt
*
* Returns salt based on nonce
*
* @param int
* @return int
* @author Roy Zhang
* @version 1.0
*
*/
function getSalt($nonce){

	if(!isset($nonce))
		return null;
	
	global $USER_TABLE_NAME;
	global $UserIdFieldName;
	global $UserSaltFieldName;
	

	$id = getIdFromNonce($nonce);
	
	$connection = connect();
	$row = getRecordByCriteria($connection, $USER_TABLE_NAME, $UserIdFieldName, $id); 
	closeDb($connection);
	return $row[$UserSaltFieldName];
}

?>