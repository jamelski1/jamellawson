<?php

	include_once('../includes/local-config.php');
	include_once('../includes/config.php');
	include_once($INCLUDES_DIR . 'functions.php');

	if(!isLoggedIn())
		reportErrorAndDie('you are not logged in...');
	
	// log them out	
	session_destroy();
	
	header('location:' . $SITE_URL);
	
?>