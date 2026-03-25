<?php
	include_once($FUNCTIONS_DIR . 'database.php');
	include_once($FUNCTIONS_DIR . 'themes.php');
	include_once($FUNCTIONS_DIR . 'validation.php');
	include_once($FUNCTIONS_DIR . 'xml.php');
	include_once($FUNCTIONS_DIR . 'security.php');
	include_once($FUNCTIONS_DIR . 'siteTracking.php');
	include_once($FUNCTIONS_DIR . 'sysErrorHandler.php');
	include_once($FUNCTIONS_DIR . 'themes.php');
	include_once($CLASSES_DIR. "debugClass.php");
	include_once($CLASSES_DIR. "SysErrorException.php");
	include_once($CLASSES_DIR. "mySQL_exception.php");
	
	set_error_handler("sysErrorHandler");
?>