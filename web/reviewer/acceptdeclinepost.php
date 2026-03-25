<html>

<head>
    <title>Accept or Decline feedback</title>
</head>

<body>

<h1>
    Accept or Decline feedback
</h1>

<?php
include_once('../includes/local-config.php');
include_once('../includes/config.php');
include_once($INCLUDES_DIR . 'functions.php');

    // get data from fields
    //used the @ sign so it doesnt throw errors since you can only select accept or decline, not both
    @ $acceptstatus = $_POST['acceptarticle'];
    @ $declinestatus = $_POST['declinearticle'];
    $article_id= $_POST['tobeacceptordecline'];
	$id = $_SESSION['id'];
    
    // get a handle to the database
    @ $db = new mysqli($DB_HOST, $DB_USER_ID, $DB_USER_PWD, $DB_DB_NAME);
    
    // check if there was an error connecting to the database
	if ($db->connect_errno) {
        echo "Oops! We could not connect to the database.<p>\n This was the error we found: " . $db->connect_error . "\n <p>Please <a href='index.php'>try again</a>";
        exit;
    }
    if (!$acceptstatus){
	$status = 'decline';
    } else{ $status = 'accept';}
    
    // prepare sql statement
	$query = "UPDATE reviewer SET status = '$status' WHERE article_id = $article_id AND reviewer.people_id = $id";
                
    // execute sql statement
    $result = $db->query($query);
    
    // check if it worked
    if ($result) {
        echo "You " . $status . "ed this article.";
        echo "<p>";
		echo "<a href='index.php'>Return to Dashboard</a><br>";
    } else {
        echo "Something went horribly wrong when accepting/declining this article.";
        echo "<p>This was the error: " . $db->error;
        echo "<p>This was the sql statement: " . $query;
        echo "<p>Please <a href='index.php'>try again</a>";
    }
    
	
    $db->close();
?>

</body>

</html>