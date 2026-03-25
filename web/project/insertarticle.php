<?php
// if something was posted, start the process...
if(isset($_POST['upload']))
{

// define the posted file into variables
$name = $_FILES['file']['name'];
$tmp_name = $_FILES['file']['tmp_name'];
$type = $_FILES['file']['type'];
$size = $_FILES['file']['size'];
$title = $_POST['title'];
}

// if the file size is larger than 350 KB, kill it
if($size>'350000') {
echo $name . " is over 350KB. Please make it smaller.";
echo  "\n <p>Please <a href='submit_article.php'>try again</a>";
die();
}

// if your server has magic quotes turned off, add slashes manually
if(!get_magic_quotes_gpc()){
$name = addslashes($name);
} 


// open up the file and extract the data/content from it
$extract = fopen($tmp_name, 'r');
$content = fread($extract, $size);
$content = addslashes($content);
fclose($extract);  

// connect to the database
// get a handle to the database
    @ $db = new mysqli('dbdev.cs.uiowa.edu', 'jllawsn', 'MwomvmeTs67R', 'db_jllawsn');
    
    // check if there was an error connecting to the database
    if ($db->connect_errno) {
        echo "Oops! We could not connect to the database.<p>\n This was the error we found: " . $db->connect_error . "\n <p>Please <a href='submit_article.php'>try again</a>";
        exit;
    }

		// the query that will add this to the database  
		$query = "insert into articles 
		(name,
		file_size,
		file_type,
		content,
		title)

		values ('"
		. $name . "', '" . $size . "', '" . $type .
		"', '" . $content . "', '" . $title .

		"');";

		$result = $db->query($query);
		
		
		// check if it worked
    if ($result) {
        echo $name . " was added to the database.";
        echo "<p>";
        echo "<a href='submit_article.html'>Go to your dashboard</a><br>";
		echo "<a href='submit_article.php'>Check Database (Testing Purposes)</a><br>";
    } else {
        echo "Something went horribly wrong when adding " . $name . ".";
        echo "<p>This was the error: " . $db->error;
        echo "<p>This was the sql statement: " . $query;
        echo "<p>Please <a href='submit_article.php'>try again<br></a>";
    }
	

	echo "<a href='submitted_articles.php?fid=1'>" . $name . "</a>";

// get the last inserted ID if we're going to display this image next
//$inserted_fid = mysql_insert_id();


$db->close();

?>