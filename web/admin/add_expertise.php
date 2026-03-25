<?php	// ADMIN

include_once('../includes/local-config.php');
include_once('../includes/config.php');
include_once($INCLUDES_DIR . 'functions.php');

if(!isLoggedIn()){
		echo ('You do not have permission to be on this page. <a href="' . $SITE_URL . '">Create an Account or Log In</a>');
		exit;
	}
	

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
		
		// this page layout should be done with CSS and NOT an html table!
		$contentStr = '
		
		<center>
		<p>
			<br/>
			<br/>
			<h3>Add Expertise</h3>
		</p>
		<form action="insertexpertise.php" method="post">

		<table>
			<tr>
				<td>*Expertise Name:</td>
				<td><input type="text" name="expertise_name" size="20"/></td>
			</tr>
			
		</table>

		<input type="submit" value="Add Expertise"/>

		</form>';

$contentStr .= '<!---------------->
		<!-- List data  -->
		<!---------------->
		<p>
			<br/>
			<br/>
			<h3>Expertises in Database</h3>
		</p>

		<table>
			
			<!-- Titles for table -->
			<tr>
				<td>Expertise ID</td>
				<td>Expertise Name</td>
			</tr>
		';
		
// get a handle to the database
//@ $db = new mysqli('dbdev.cs.uiowa.edu', 'jllawsn', 'MwomvmeTs67R', 'db_jllawsn');
@ $db = new mysqli($DB_HOST, $DB_USER_ID, $DB_USER_PWD, $DB_DB_NAME);

// check if there was an error connecting to the database
if ($db->connect_errno) {
	echo "Oops! We could not connect to the database.<p>\n This was the error we found: " . $db->connect_error . "\n <p>Please <a href='admin.php'>try again</a>";
	exit;
}

// prepare sql statement
$query = "SELECT *
FROM expertise
ORDER BY expertise_name;";

// execute sql statement
$result = $db->query($query);

// check if it worked
if ($result) {
	$numberofrows = $result->num_rows;
	
	
	for($i=0; $i < $numberofrows; $i++) {
		$row = $result->fetch_assoc();
		$contentStr .= "\n <tr>";
		$contentStr .= "\n <td>" . $row['expertise_id'] . "</td>";
		$contentStr .= "\n <td>" . $row['expertise_name'] . "</td>";
		$contentStr .= "\n </tr>";
	}
	$contentStr .= "</table>";
	
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
header('location:' . $SITE_URL . 'index.php');
}

?>
