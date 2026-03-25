<html>

<head>
    <title>Insert people feedback</title>
</head>

<body>

<h1>
    Insert people feedback
</h1>

<?php
    // get data from fields
    $expertiseName = $_POST['expertise_name'];
    
    // check required fields
	
	// Expertise Name
	if (!$expertiseName) {
        echo "Hey, you didn't add an expertise. Please <a href='admin.php'>try again</a>";
        exit;
    }
    
	
    // get a handle to the database
    @ $db = new mysqli('dbdev.cs.uiowa.edu', 'jllawsn', 'MwomvmeTs67R', 'db_jllawsn');
    
    // check if there was an error connecting to the database
	if ($db->connect_errno) {
        echo "Oops! We could not connect to the database.<p>\n This was the error we found: " . $db->connect_error . "\n <p>Please <a href='admin.php'>try again</a>";
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
        echo "<a href='submit_article.html'>Go to your dashboard</a><br>";
		echo "<a href='admin.php'>Check Database (Testing Purposes)</a><br>";
    } else {
        echo "Something went horribly wrong when adding " . $expertiseName . ".";
        echo "<p>This was the error: " . $db->error;
        echo "<p>This was the sql statement: " . $query;
        echo "<p>Please <a href='admin.php'>try again</a>";
    }
	
    $db->close();
?>

</body>

</html>