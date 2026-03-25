<?php

include_once('../includes/local-config.php');
include_once('../includes/config.php');
include_once($INCLUDES_DIR . 'functions.php');

include_once('../includes/pdf2text.php');


// if something was posted, start the process...
if(isset($_POST['upload']))
{

// define the posted file into variables
$name = $_FILES['file']['name'];
$tmp_name = $_FILES['file']['tmp_name'];
$type = $_FILES['file']['type'];
$size = $_FILES['file']['size'];
$title = $_POST['title'];
$abstract = $_POST['abstract'];
$status = 'Received';
$rating = 'Incomplete';


$authorFName = $_POST['firstname'];
$authorLName = $_POST['lastname'];
$authorEmail = $_POST['email'];

}

if(!$title){
	echo "You didn't enter a title!";
	die();
	}
// if the file size is larger than 350 KB, kill it
if($size>'350000') {
echo $name . " is over 350KB. Please make it smaller.";
echo  "\n <p>Please <a href='submit_article.php'>try again</a>";
die();
}
//echo $authorFName[0] . '<br/>';
//echo $authorLName[0] . '<br/>';
//echo $authorEmail[0] . '<br/>';

//echo $authorFName[1] . '<br/>';
//echo $authorLName[1] . '<br/>';
//echo $authorEmail[1] . '<br/>';
$content = pdf2text ($tmp_name);

// connect to the database
// get a handle to the database
    @ $db = new mysqli($DB_HOST, $DB_USER_ID, $DB_USER_PWD, $DB_DB_NAME);
    
    // check if there was an error connecting to the database
    if ($db->connect_errno) {
        echo "Oops! We could not connect to the database.<p>\n This was the error we found: " . $db->connect_error . "\n <p>Please <a href='submit_article.php'>try again</a>";
        exit;
    }

		// the query that will add this to the database  
		$query = "insert into articles 
		(name,
		size,
		type,
		content,
		title,
		abstract,
		status,
		rating)

		values ('"
		. $name . "', '" . $size . "', '" . $type .
		"', '" . $content . "', '" . $title .
		"', '" . $abstract .
		"', '" . $status .
		"', '" . $rating .

		"');";

		$result = $db->query($query);
		
		
		// check if it worked
    if ($result) {
        echo $name . " was added to the database.";
        echo "<p>";
        echo "<a href='" . $HOME_URL . "'>Go to your dashboard</a><br>";
		echo "<a href='" . $ADMIN_URL . "'>Check Database (Testing Purposes)</a><br>";
    } else {
        echo "Something went horribly wrong when adding " . $name . ".";
        echo "<p>This was the error: " . $db->error;
        echo "<p>This was the sql statement: " . $query;
        echo "<p>Please <a href='" . $AUTHOR_URL . "'>try again<br></a>";
    }
	

	echo "<a href='submitted_articles.php?fid=1'>This Should Open File 1</a>";

// get the last inserted ID if we're going to display this image next
//$inserted_fid = mysql_insert_id();



//get expertise id query
	$get_article_id_query = "SELECT article_id
	FROM articles
	WHERE articles.title = '" . $title . "';";
	
	// execute sql statement
	$article_id = $db->query($get_article_id_query);
	
	if ($article_id) {
        echo "Got expertise object id<br>";
        
    } else {
        echo "Something went wrong when retrieving article ID from the database.<p>";
        echo "This was the error: " . $db->error . "<p>";
        echo "This was the sql statement: " . $get_article_id_query;
    }
	
	if ($article_id) {
        $numberofrows = $article_id->num_rows;
        $row = $article_id->fetch_assoc();
		$the_actual_article = $row['article_id'];
    
        
    } else {
        echo "Something went wrong when retrieving article from the database.<p>";
        echo "This was the error: " . $db->error . "<p>";
    }

$connect_article_detail = "INSERT INTO article_detail(
	people_id,
	article_id)
	
	VALUES('" . $_SESSION['id'] . 
	"', '" . $the_actual_article .
	"');";
	
	// execute sql statement
	$connect_article_detail = $db->query($connect_article_detail);
	
	if($connect_article_detail){
		echo "Article added to Article Detail Table.<br>";
	
	} else {
        echo "Something went wrong when adding article to the database.<p>";
        echo "This was the error: " . $db->error . "<p>";
		
	}

	$it=0;
foreach($authorFName as $value){
	$fname=$value;
	$lname=$authorLName[$it];
	$email=$authorEmail[$it];
	$it +=1;
	
	$invite_author = "INSERT INTO invited_authors(
						firstname, lastname, email, article_id, title, inviter)
						
						VALUES('" . $fname . "','" .$lname . "','" . $email . "','" . $the_actual_article . "','" . $title . "','" . $_SESSION['fname'] . ' ' . $_SESSION['lname'] .
						"');";
// execute sql statement
	$invite_author = $db->query($invite_author);
	if($connect_article_detail){
		echo "$fname $lname added to Invited Authors Table.<br>";
	
	} else {
        echo "Something went wrong when adding $fname $lname to the Invited Authors Table.<p>";
        echo "This was the error: " . $db->error . "<p>";
		
	}
	}
	
$db->close();

?>