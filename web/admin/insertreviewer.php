<html>

<head>
    <title>Insert people feedback</title>
</head>

<body>

<h1>
    Insert people feedback
</h1>

<?php

include_once('../includes/local-config.php');
include_once('../includes/config.php');
include_once($INCLUDES_DIR . 'functions.php');

//Tells the page building function what page we're on to build the sidebar
$_SESSION['page_name']='admin';
    // get data from fields
	$person = $_POST['person'];
    
    // check required fields
	if (!$person){
		echo "Hey, you didn't select a person. Please <a href='index.php'> try again</a>";
		exit;
	}
	
	
    // get a handle to the database
    @ $db = new mysqli($DB_HOST, $DB_USER_ID, $DB_USER_PWD, $DB_DB_NAME);
    
    // check if there was an error connecting to the database
	if ($db->connect_errno) {
        echo "Oops! We could not connect to the database.<p>\n This was the error we found: " . $db->connect_error . "\n <p>Please <a href='admin.php'>try again</a>";
        exit;
    }
    
    // prepare sql statement
	//$query = "insert into people (firstname, middlename, lastname, author, reviewer) values ('" . $firstname . "', '" . $middlename . "', '" . $lastname . "', '" . $author . "');";
	
	
	$query = "UPDATE role_user
		SET role_id = 4 
		WHERE people_id =" . $person;
	
	
	//$query = "insert into people (firstname, middlename, lastname, author, reviewer) values ('" . $firstname . "', '" . $middlename . "', '" . $lastname . "');";
	
		
	
    // execute sql statement
    $result = $db->query($query);
    
    // check if it worked
    if ($result) {
        echo "Person with the id number " . $person . " was given reviewer priveledges.";
        echo "<p>";
        echo "<a href='user_permissions.php'>Go to your dashboard</a><br>";
    } else {
        echo "Something went horribly wrong when giving reviewer privileges to person with the id number " . $person . ".";
        echo "<p>This was the error: " . $db->error;
        echo "<p>This was the sql statement: " . $query;
        echo "<p>Please <a href='register.php'>try again</a>";
    }
	
    $db->close();
?>

</body>

</html>