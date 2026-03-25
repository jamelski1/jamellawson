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
	<!-- List data  -->
	<!---------------->

	<p>
		<br/>
		<br/>
		<h3>Accept or Decline an Article to Review</h3>
	</p>

	<table>
		';


// prepare sql statement
$query = "SELECT articles.title, articles.abstract, articles.status, articles.rating, articles.article_id
FROM articles, reviewer
WHERE reviewer.people_id = $id
AND articles.article_id = reviewer.article_id
ORDER BY article_id;";

// execute sql statement
$result = $db->query($query);

// check if it worked
if ($result) {

                $contentStr .= "<form action='acceptdeclinepost.php' method='post'>";
                $newquery = "SELECT articles.title, articles.abstract, articles.status, articles.rating, articles.article_id
							FROM articles, reviewer
							WHERE reviewer.people_id = $id
							AND articles.article_id = reviewer.article_id
							AND reviewer.status IS NULL
							ORDER BY article_id;";

				$newresult = $db->query($newquery);
				
				if ($newresult) {
					$numberofrows = $newresult->num_rows;
				  
					$contentStr .= '<td><select name="tobeacceptordecline">';
			
			$contentStr .= '\n <option value="">Please Select...</option>';
					for($i=0; $i<$numberofrows;$i++){
						$row = $newresult->fetch_assoc();
						$theValue = $row['article_id'];
						$theName = $row['title'];
						$contentStr .= '\n <option value="' . $theValue . '">' . $theName . '</option>';	
					}
                $contentStr .= "\n <td> <input type='submit' value='Accept' name='acceptarticle'/>";
                $contentStr .= "\n <td> <input type='submit' value='Decline' name='declinearticle'/>";
                $contentStr .= "\n </form></tr>";
                $contentStr .= "</table></center>";

	}
	
}

$db->close();



		
		$pageStr = str_replace('<!--content-->',$contentStr, $pageStr);
		
		echo $pageStr;
}
else {
	reportErrorAndDie('unable to render "admin" page because HTML template could not be read...');
	
}


?>