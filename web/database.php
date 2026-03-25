function connect()
{
	Global $DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME;
	
	$connection = mysql_connect($DB_HOST, $DB_USER, $DB_PASSWORD);
	
	if(!$connection) 
	{ // Make sure the connection is valid
		throw new mySQL_exception(
			'Sorry! An error prevented you from connecting to the server. ' . 
			mysql_error() , 1);
		return false;
	}
  	
	if(!mysql_select_db($DB_NAME)) 
	{ // Check to make sure the database exists
		throw new mySQL_exception('Unable to select the database '. $dbName .
			'.' . mysql_error(), 1);
		
		return false;
	}
	
    return $connection;
}