<?php	// reviewers

include_once('../includes/local-config.php');
include_once('../includes/config.php');
include_once($INCLUDES_DIR . 'functions.php');

//This variable tells the page builder that we're on an reviewer's page

$_SESSION['page_name']='reviewer';
$id = $_SESSION['id'];

if(!isLoggedIn()){
		echo ('You do not have permission to be on this page. <a href="' . $SITE_URL . '">Create an Account or Log In</a>');
		exit;
	}

if($pageStr = file_get_contents($TEMPLATES_DIR . 'default.html'))
{
	$pageStr = doGlobalSubstitutions($pageStr);
	$pageStr = str_replace('<!--banner-->', makeBanner("Reviewer's Dashboard"), $pageStr);
    
    // get a handle to the database
    @ $db = new mysqli($DB_HOST, $DB_USER_ID, $DB_USER_PWD, $DB_DB_NAME);

// check if there was an error connecting to the database
if ($db->connect_errno) {
	echo "Oops! We could not connect to the database.<p>\n This was the error we found: " . $db->connect_error . "\n <p>Please <a href='admin.php'>try again</a>";
	exit;
}

	$contentStr = '
<h3>Submit a Review</h3>
	    <form action="insertreview.php" method="post" enctype="multipart/form-data">
		<table id="myTable">
				<tr>
					<td>*Select article to Review:</td>';
					 // execute sql statement

				 $query = "SELECT articles.title, articles.abstract, articles.status, articles.rating, articles.article_id
						FROM articles, reviewer
						WHERE reviewer.people_id = $id
						AND articles.article_id = reviewer.article_id
						AND reviewer.status = 'accept'
						AND reviewer.decision IS NULL
						ORDER BY article_id;";
						
				$result = $db->query($query);
				
				if ($result) {
					$numberofrows = $result->num_rows;
				  
					$contentStr .= '<td><select name="tobereviewed">';
					//$contentStr .= '<option value="0" selected="selected">Select</option>';
					$i=0;
					
					$contentStr .= '\n <option value="">Please Select...</option>';
					for($i=0; $i<$numberofrows;$i++){
						$row = $result->fetch_assoc();
						$theValue = $row['article_id'];
						$theName = $row['title'];
						$contentStr .= '\n <option value="' . $theValue . '">' . $theName . '</option>';
						
					}
					$contentStr .= "\n </tr>";
					} else {
					echo "Something went wrong when retrieving articles from the database.<p>";
					echo "This was the error: " . $db->error . "<p>";
					echo "This was the sql statement: " . $query;
					}

					 $contentStr .='   </select></td>
					
				</tr>
				<tr>
					<td>*Decision:</td>
					<td><select name="decision">
					    <option value="accept">Accept</option>
					    <option value="acceptwminor">Accept with minor changes</option>
					    <option value="acceptwmajor">Accept with major changes</option>
					    <option value="reject"> Reject</option></select></td>
				</tr>
				
				<tr>
					<td><label for="addcomments">*Additional Comments:</label></td>
					<td><textarea rows="10" cols="50" name="addcomments"></textarea></td>
				</tr>
				
				<tr>
					<td><label for="ebmcomments">Comments to EB member:</label></td>
					<td><textarea rows="5" cols="50" name="ebcomments"></textarea></td>
				</tr>

				<tr>
					<td><input type="submit" value="Submit Review" name="upload"/></td>
				</tr>
				</table>

				</form>';
					$pageStr = str_replace('<!--content-->',$contentStr, $pageStr);
	
	echo $pageStr;

}
else{
	reportErrorAndDie('unable to render page because HTML template could not be read...');
}
/*
	//Code-in-progress for pulling articles from database to populate drop-down menu
		//    <?php foreach ($row as $article) { ?>
		// <option value="<?php echo $article['article_id']; ?>">
	       //               <?php echo $article['name']; ?> </option> <?php
	       //               } ?>
*/
?>
