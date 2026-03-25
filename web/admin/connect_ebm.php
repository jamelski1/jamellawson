<html>

<head>
    <title>Connect EBM feedback</title>
</head>

<body>

<h1>
    Connect EBM	feedback
</h1>

<?php
include_once('../includes/local-config.php');
include_once('../includes/config.php');
include_once($INCLUDES_DIR . 'functions.php');

if(!isLoggedIn()){
		echo ('You do not have permission to be on this page. <a href="' . $SITE_URL . '">Create an Account or Log In</a>');
		exit;
	}
	

    // get data from fields
    $ebm_id = $_POST['apply'];
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
	
	
	$query = "insert into ebm_detail 
		(people_id, article_id)

		values ('"
		. $ebm_id .
		"','" . $article_id .

		"');";	
	
    // execute sql statement
    $result = $db->query($query);
    
    // check if it worked
    if ($result) {
        echo "Article was assigned to Editorial Board Member to the database.";
        echo "<p>";
		echo "<a href='index.php'>Return to Dashboard</a><br>";
    } else {
        echo "Something went horribly wrong when adding Editorial Board Member.";
        echo "<p>This was the error: " . $db->error;
        echo "<p>This was the sql statement: " . $query;
        echo "<p>Please <a href='index.php'>try again</a>";
    }
	
	$query = "UPDATE articles
		SET status = 'Assigned'
		WHERE article_id =" . $article_id;
	
	// execute sql statement
    $result = $db->query($query);
    
    // check if it worked
    if ($result) {
        echo "Article status set to Assigned.";
    } else {
        echo "Something went setting article status.";
        echo "<p>This was the error: " . $db->error;
        echo "<p>This was the sql statement: " . $query;
        echo "<p>Please <a href='index.php'>try again</a>";
    }
	
    $db->close();
?>

</body>

</html>