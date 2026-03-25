<?php

include_once('../includes/local-config.php');
include_once('../includes/config.php');
include_once($INCLUDES_DIR . 'functions.php');

//Checks if user is logged in
if(!isLoggedIn()){
		echo ('You do not have permission to be on this page. <a href="' . $SITE_URL . '">Create an Account or Log In</a>');
		exit;
	}

// if something was posted, start the process...
if(isset($_POST['upload']))
{

// define the submitted form into variables
$addcomments = $_POST['addcomments'];
$article_id = $_POST['tobeapproved'];
$decision = $_POST['decision'];
$id = $_SESSION['id'];

if(!$addcomments){
	echo "You didn't enter any comments!";
	die();
	}
}
// connect to the database
// get a handle to the database
    @ $db = new mysqli($DB_HOST, $DB_USER_ID, $DB_USER_PWD, $DB_DB_NAME);
    
    // check if there was an error connecting to the database
    if ($db->connect_errno) {
        echo "Oops! We could not connect to the database.<p>\n This was the error we found: " . $db->connect_error . "\n <p>Please <a href='submit_article.php'>try again</a>";
        exit;
    }


    // the query that will add this review to the database  
    $query = 'UPDATE articles, ebm_detail, people SET rating="' . $decision . '", ebmcomments="' . $addcomments . '", status= "Complete"
	WHERE articles.article_id="' . $article_id . '"'; 
    $result = $db->query($query);
    
    // check if it worked
    if ($result) {
        echo "Review was submitted.";
        echo "<p>";
        echo "<a href='" . $HOME_URL . "'>Go to your dashboard</a><br>";
		echo "<a href='" . $ADMIN_URL . "'>Check Database (Testing Purposes)</a><br>";
    } else {
        echo "Something went horribly wrong when reviewing article " . $article_id . ".";
        echo "<p>This was the error: " . $db->error;
        echo "<p>This was the sql statement: " . $query;
        echo "<p>Please <a href='" . $REVIEWER_URL . "'>try again<br></a>";
    }
       
    $db->close();

?>