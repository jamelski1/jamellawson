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
		
		// this page layout should be done with CSS and NOT an html table!
// get a handle to the database
//@ $db = new mysqli('dbdev.cs.uiowa.edu', 'jllawsn', 'MwomvmeTs67R', 'db_jllawsn');
@ $db = new mysqli($DB_HOST, $DB_USER_ID, $DB_USER_PWD, $DB_DB_NAME);

// check if there was an error connecting to the database
if ($db->connect_errno) {
	echo "Oops! We could not connect to the database.<p>\n This was the error we found: " . $db->connect_error . "\n <p>Please <a href='admin.php'>try again</a>";
	exit;
}

$contentStr = "<p>
<br/>
<br/>
<h3>People in the database</h3>
</p>

<table>

<!-- Titles for table -->
<tr>
<td>First Name</td>
<td>Middle Name</td>
<td>Last Name</td>
<td>Admin</td>
<td>Email</td>
</tr>";

$query = "SELECT firstname, middlename, lastname, role_user.role_id, email
FROM people, role_user, role
WHERE people.people_id = role_user.people_id AND role_user.role_id = role.role_id
ORDER BY lastname;";

// execute sql statement
$result = $db->query($query);

// check if it worked
if ($result) {
	$numberofrows = $result->num_rows;
	
	
	for($i=0; $i < $numberofrows; $i++) {
		$row = $result->fetch_assoc();
		$contentStr .= "\n <tr>";
		$contentStr .= "\n <td>" . $row['firstname'] . "</td>";
		$contentStr .= "\n <td>" . $row['middlename'] . "</td>";
		$contentStr .= "\n <td>" . $row['lastname'] . "</td>";
		$contentStr .= "\n <td>" . $row['role_id'] . "</td>";
		$contentStr .= "\n <td>" . $row['email'] . "</td>";
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
	
}

?>
