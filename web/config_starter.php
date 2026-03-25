<?php
  

	$ROOT_DIR = '/webdev/user/jllawsn/web/';

	$LIBRARY_DIR = $ROOT_DIR . 'library/';

	$FUNCTIONS_DIR = $ROOT_DIR . 'functions/';
	$CLASSES_DIR = $ROOT_DIR . 'classes/';  //NOT USED!

	// *** Template Configuration *** //
	$BASE_URL = ''; // Question: What if you want to use the same library for multiple sites?
			// Answer:   This config file should be copied into a project specific directory, therefore 
		    	//           the $BASE_URL is unique to each project.
	
	// *** Database Configuration *** //
	$DB_HOST = 'dbdev.cs.uiowa.edu';
	$DB_USER = 'jllawsn';
	$DB_PASSWORD = 'MwomvmeTs67R'; //
	$DB_NAME = 'db_jllawsn';
	
	// *** User Management Configuration *** //
	$USER_TABLE_NAME = 'Users';
	$ROLE_TABLE_NAME = 'Role';
	$UserLoginFieldName = "Login";	// *
	$UserPwdFieldName = "Password";	// varchar(64)
	$UserSaltFieldName = "Salt";	// varchar(23)
	$UserRoleFieldName = "Role";	// *
	$UserNonceFieldName = "Nonce";	// varchar(64)
	$UserIdFieldName = "id";		// *  - there should be no reason that you are 
									// required to use anything here, however  bigint(20) 
									// auto-incremented would be suggested    
	$RoleNameFieldName = "Name";	// *
	$RoleValueFieldName = "Value";// int
	
	// * denotes that any type and of any size is allowed, however it is up to your 
	// page to agree with your database. (most applications would likely use varchar)
	
	
	// *** Site Tracking Database Tables and Columns ***//
	$SITE_TRACKING_EVENT_TABLE_NAME ='Event';
	$STEIDName = 'idEvent';    //int(11) non-null,auto-incrementing, primary key
	$STEEventTypeName = 'eventType';  //int(11) non-null foreign key into
					  //$SITE_TRACKING_EVENT_TYPE_TABLE_NAME
	$STEUserIDName = 'user';      //varchar(45) non-null
	$STETimeName = 'time';    //bigint(20) non-null
	$STEBrowserName = 'browser';        //varchar(45) non-null
	$STEIPAddressName = 'ipAddress';    //varchar(45) non-null
	
	$SITE_TRACKING_EVENT_TYPE_TABLE_NAME = 'eventType';
	$STETEventTypeName = 'eventType';           //int(11) non-null
	$STETDescriptionName = 'description'; //varchar(45) non-null
	
	
	$eventTypes = array("login"=>0,"logout"=>1,"failedLogin"=>2);

	$ADMINEmail = 'lawson.jamel@yahoo.com';		// change this address
	$EmailFrom = 'lawson.jamel@yahoo.com';	// change this address

	
	// *** End of Site Tracking Database Tables and Columns ***//
	
	// *** Error Handler Configuration *** //
	// set_error_handler("sysErrorHandler");




?>
