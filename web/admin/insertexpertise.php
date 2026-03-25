<html>

<head>
    <title>Insert expertise feedback</title>
</head>

<body>

<h1>
    Insert expertise feedback
</h1>

<?php
include_once('../includes/local-config.php');
include_once('../includes/config.php');
include_once($INCLUDES_DIR . 'functions.php');

    // get data from fields
    $expertiseName = $_POST['expertise_name'];
    
    // check required fields
	
	// Expertise Name
	if (!$expertiseName) {
        echo "Hey, you didn't add an expertise. Please <a href='add_expertise.php'>try again</a>";
        exit;
    }
    
	
    // get a handle to the database
    @ $db = new mysqli($DB_HOST, $DB_USER_ID, $DB_USER_PWD, $DB_DB_NAME);
    
    // check if there was an error connecting to the database
	if ($db->connect_errno) {
        echo "Oops! We could not connect to the database.<p>\n This was the error we found: " . $db->connect_error . "\n <p>Please <a href='add_expertise.php'>try again</a>";
        exit;
    }
    
    // prepare sql statement
	//$query = "insert into people (firstname, middlename, lastname, author, reviewer) values ('" . $firstname . "', '" . $middlename . "', '" . $lastname . "', '" . $author . "');";
	
	
	$query = "insert into expertise 
		(expertise_name)

		values ('"
		. $expertiseName . 

		"');";	
	
    // execute sql statement
    $result = $db->query($query);
    
    // check if it worked
    if ($result) {
        echo $expertiseName . " was added to the database.";
        echo "<p>";
		echo "<a href='add_expertise.php'/>Return to Dashboard</a><br>";
    } else {
        echo "Something went horribly wrong when adding " . $expertiseName . ".";
        echo "<p>This was the error: " . $db->error;
        echo "<p>This was the sql statement: " . $query;
        echo "<p>Please <a href='add_expertise.php'>try again</a>";
    }
	
    $db->close();
?>

</body>

</html>