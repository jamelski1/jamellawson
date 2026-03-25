<html>

<head>
    <title>Email Feedback</title>
</head>

<body>

<h1>
    Email Feedback
</h1>

<?php
include_once('../includes/local-config.php');
include_once('../includes/config.php');
include_once($INCLUDES_DIR . 'functions.php');

//Checks if user is logged in
if(!isLoggedIn()){
		echo ('You do not have permission to be on this page. <a href="' . $SITE_URL . '">Create an Account or Log In</a>');
		exit;
	}

//Tells the page building function what page we're on to build the sidebar
$_SESSION['page_name']='ebm';
	// get data from fields
	$to = $_POST['to'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	//$from= $_POST['email'];

	if (!$to){
	echo "Hey, you didn't enter an e-mail address. Please <a href='emailmembers.php'> try again</a>";
	exit;
	}
	
	if (!$subject){
	echo "Hey, you didn't enter a subject. Please <a href='emailmembers.php'> try again</a>";
	exit;
	}
	
	if (!$to){
	echo "Hey, you didn't enter a message. Please <a href='emailmembers.php'> try again</a>";
	exit;
	}
	
	//$headers = 'From: ' $from . "\r\n" .
	//	'Reply-To: ' $from . "\r\n" .
	//	'X-Mailer: PHP/' . phpversion();
		
	mail($to, $subject, $message);
	
	echo "Your email has been sent. <a href='emailmembers.php'>Go back.</a>";
?>
</body>
</html>