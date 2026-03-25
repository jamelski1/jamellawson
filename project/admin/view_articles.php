<?php	// ADMIN

include_once('../includes/local-config.php');
include_once('../includes/config.php');
include_once($INCLUDES_DIR . 'functions.php');

//Tells the page building function what page we're on to build the sidebar
$_SESSION['page_name']='admin';

if(!isset($_SESSION)){
	session_start();
}
if(!isAdmin()){
	echo ('You do not have permission to be on this page. <a href="' . $AUTHOR_URL . '">Home</a>');
	exit;
}
if($pageStr = file_get_contents($TEMPLATES_DIR . 'default.html'))
{
		$pageStr = doGlobalSubstitutions($pageStr);
		
		$pageStr = str_replace('<!--banner-->', makeBanner('Administration'), $pageStr);
		
		
// get a handle to the database
//@ $db = new mysqli('dbdev.cs.uiowa.edu', 'jllawsn', 'MwomvmeTs67R', 'db_jllawsn');
@ $db = new mysqli($DB_HOST, $DB_USER_ID, $DB_USER_PWD, $DB_DB_NAME);

// check if there was an error connecting to the database
if ($db->connect_errno) {
	echo "Oops! We could not connect to the database.<p>\n This was the error we found: " . $db->connect_error . "\n <p>Please <a href='admin.php'>try again</a>";
	exit;
}
	$contentStr = '<!---------------->
	<!-- List data  -->
	<!---------------->

	<p>
		<br/>
		<br/>
		<h3>Articles in the database</h3>
	</p>

	<table>
		
		<!-- Titles for table -->
		<tr>
			<td>Article</td>
			<td>Abstract</td>
			<td>Date & Time</td>
			<td>Status</td>
			<td>Rating</td>
			<td>Open File</td>
		</tr> ';


// prepare sql statement
$query = "SELECT title, abstract, theTime, status, rating, article_id
FROM articles
ORDER BY title;";

// execute sql statement
$result = $db->query($query);

// check if it worked
if ($result) {
	$numberofrows = $result->num_rows;
	
	
	for($i=0; $i < $numberofrows; $i++) {
		$row = $result->fetch_assoc();

		$contentStr .= "\n <tr>";
		$contentStr .= "\n <td>" . $row['title'] . "</td>";
		$contentStr .= "\n <td>" . $row['abstract'] . "</td>";
		$contentStr .= "\n <td>" . $row['theTime'] . "</td>";
		$contentStr .= "\n <td>" . $row['status'] . "</td>";
		$contentStr .= "\n <td>" . $row['rating'] . "</td>";
		$contentStr .= "\n <td> <a href='../author/submitted_articles.php?fid=" . $row['article_id'] . "'>View Article</a></td>";
		$contentStr .= "\n </tr>";
	}
	$contentStr .= "</table></center>";
	
} else {
	echo "Something went wrong when retrieving people from the database.<p>";
	echo "This was the error: " . $db->error . "<p>";
	echo "This was the sql statement: " . $query;
}

$db->close();



		
		$pageStr = str_replace('<!--content-->',$contentStr, $pageStr);
		
		echo $pageStr;
}
else {
	reportErrorAndDie('unable to render "admin" page because HTML template could not be read...');
	
}


?>
