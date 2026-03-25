<?php

$pageStr="<head>
<meta charset='utf-8'>
<title>Property Manager</title>
<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=yes'>
<link href='http://fonts.googleapis.com/css?family=Codystar' rel='stylesheet' type='text/css'>
<link rel='stylesheet' type='text/css' href='mobile.css'>
</head>

<div id='wrapper'>
<h1 id='mainTitle'>Property Manager</h1>";


function makeSalt()
{
	return md5(mt_rand());
}
	$firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$salt = makeSalt();
	$password = $_POST['password'] = hash('sha512', $_POST['password'] . $salt);
	$confirm_password = $_POST['confirm_password'] = hash('sha512', $_POST['confirm_password'] . $salt);
	
@ $db = new mysqli("p3plcpnl1023.prod.phx3.secureserver.net","dbManageProperty", "Blacky132000!", "dbManageProperty");
    
    // check if there was an error connecting to the database
	if ($db->connect_errno) {
        echo "Oops! We could not connect to the database.<p>\n This was the error we found: " . $db->connect_error . "\n <p>Please <a href='../index.php'>try again</a>";
        exit;
    }
	
	//check if email is in database already
	$checkEmailQuery = "SELECT email FROM people;";
	
	$result = $db->query($checkEmailQuery);
	
	if ($result){
			$numberofrows = $result->num_rows;
			
			for($i=0; $i < $numberofrows; $i++) {
            $row = $result->fetch_assoc();
				if ($email == $row['email']){
					echo "Hey, that email is already registered. Please <a href='http://jamellawson.com/myproperty/index.php'> try again</a>";
					exit;
				}
			}
	}
	
	$query = "insert into people 
		(firstname,
		lastname,
		email,
		salt,
		password)

		values ('"
		. $firstname . "', '" . $lastname . 
		"', '" .$email .
		"', '" . $salt .
		"', '" .$password .

		"');";
		
    // execute sql statement
    $result = $db->query($query);
    
    // check if it worked
    if ($result) {
        $pageStr .= $firstname . " " . $lastname . " your account has been created! Follow this link to your account:<br/>";
        $pageStr .= "<p>";
        $pageStr .= "<a class='information' href='myaccount.php'>My Account</a><br>";
    } else {
        $pageStr .= "Something went horribly wrong when adding " . $firstname . " " . $lastname . ".";
        $pageStr .= "<p>This was the error: " . $db->error;
        $pageStr .= "<p>This was the sql statement: " . $query;
        $pageStr .= "<p>Please <a href='../myproperty/index.php/'>try again</a>";
    }
	
	$pageStr .="</div><!--End of Wrapper-->";

echo ($pageStr);
?>