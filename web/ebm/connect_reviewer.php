<html>

<head>
    <title>Connect Reviewer feedback</title>
</head>

<body>

<h1>
    Connect Reviewer feedback
</h1>

<?php
include_once('../includes/local-config.php');
include_once('../includes/config.php');
include_once($INCLUDES_DIR . 'functions.php');

    // get data from fields
    $reviewer_id = $_POST['apply'];
	$article_id= $_POST['article_id'];
	$status = 'Assigned';
    
	
    // get a handle to the database
    @ $db = new mysqli($DB_HOST, $DB_USER_ID, $DB_USER_PWD, $DB_DB_NAME);
    
    // check if there was an error connecting to the database
	if ($db->connect_errno) {
        echo "Oops! We could not connect to the database.<p>\n This was the error we found: " . $db->connect_error . "\n <p>Please <a href='index.php'>try again</a>";
        exit;
    }
    
    // prepare sql statement
	//$query = "insert into people (firstname, middlename, lastname, author, reviewer) values ('" . $firstname . "', '" . $middlename . "', '" . $lastname . "', '" . $author . "');";
	
	
	$query = "insert into reviewer 
		(people_id, article_id)

		values ('"
		. $reviewer_id .
		"','" . $article_id .

		"');";	
	
    // execute sql statement
    $result = $db->query($query);
    
    // check if it worked
    if ($result) {
        echo "Article was assigned to Reviewer to the database.";
        echo "<p>";
		echo "<a href='index.php'>Return to Dashboard</a><br>";
    } else {
        echo "Something went horribly wrong when adding Reviewer.";
        echo "<p>This was the error: " . $db->error;
        echo "<p>This was the sql statement: " . $query;
        echo "<p>Please <a href='index.php'>try again</a>";
    }
	
    $db->close();
?>

</body>

</html>