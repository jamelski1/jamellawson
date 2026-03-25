<?php	// EBM

include_once('../includes/local-config.php');
include_once('../includes/config.php');
include_once($INCLUDES_DIR . 'functions.php');

//Checks if user is logged in
if(!isLoggedIn()){
		echo ('You do not have permission to be on this page. <a href="' . $SITE_URL . '">Create an Account or Log In</a>');
		exit;
	}

$id = $_SESSION['id'];
//Tells the page building function what page we're on to build the sidebar
$_SESSION['page_name']='ebm';

if(!isset($_POST['submit']))	// we need to present the form and get the data
  {
	if(!isset($_SESSION)){
		session_start();
	}
	
	if($pageStr = file_get_contents($TEMPLATES_DIR . 'default.html'))
	{
			$pageStr = doGlobalSubstitutions($pageStr);
			
			$pageStr = str_replace('<!--banner-->', makeBanner('Board Member Dashboard'), $pageStr);
			
			
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
			<h3>Articles</h3>
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
				<td>Reviews</td>
			</tr> ';
    
    
    // prepare sql statement
    $query = "SELECT DISTINCT articles.title, articles.abstract, articles.theTime, articles.status, articles.rating, articles.article_id
	FROM articles, ebm_detail
	WHERE ebm_detail.people_id=$id
	AND articles.article_id = ebm_detail.article_id";
    
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
			$contentStr .= "\n <td><form action='view_review.php' method='post'>
								<button name='view_review' type='submit' value=" . $row['article_id'] . ">View Reviews</button>
								</form></td>";
            $contentStr .= "\n </tr>";
        }
		$contentStr .= "</table></center>";
        
    } else {
        echo "Something went wrong when retrieving people from the database.<p>";
        echo "This was the error: " . $db->error . "<p>";
        echo "This was the sql statement: " . $query;
    }
	$contentStr .= '
		<p>
			<br/>
			<br/>
			<h3>Make Decision</h3>
		</p>
	    <form action="insertdecision.php" method="post" enctype="multipart/form-data">
		<table id="myTable">
				<tr>
					<td>Select article:</td>';
					 // execute sql statement
				$query = "SELECT DISTINCT articles.name, articles.article_id
				FROM articles, ebm_detail
				WHERE ebm_detail.people_id=$id
				AND articles.article_id = ebm_detail.article_id
				AND articles.rating = 'Incomplete'";
				
				$result = $db->query($query);
				
				if ($result) {
					$numberofrows = $result->num_rows;
					
					$contentStr .= '<td><select name="tobeapproved">';
					//$contentStr .= '<option value="0" selected="selected">Select</option>';
					$i=0;
					$contentStr .= '\n <option value="">Please Select...</option>';
					for($i=0; $i<$numberofrows;$i++){
						$row = $result->fetch_assoc();
						$theValue = $row['article_id'];
						$theName = $row['name'];
						$contentStr .= '\n <option value="' . $theValue . '">' . $theName . '</option>';
						
					}
					$contentStr .= "\n </tr>";
					} else {
					echo "Something went wrong when retrieving articles from the database.<p>";
					echo "This was the error: " . $db->error . "<p>";
					echo "This was the sql statement: " . $query;
					}	
		$contentStr .='
		<tr>
		<td>Decision:</td>
		
			<td><select name="decision">
				<option value="">Please Select...</option>
				<option value="accept">Accept</option>
				<option value="acceptwminor">Accept with minor changes</option>
				<option value="acceptwmajor">Accept with major changes</option>
				<option value="reject"> Reject</option></select></td>
		</tr>		
		<tr>
			<td><label for="addcomments">Comments:</label></td>
			<td><textarea rows="10" cols="50" name="addcomments"></textarea></td>
		</tr>
		<tr>
			<td><input type="submit" value="Submit Decision" name="upload"/></td>
		</tr>
		</table>
		</form>';
					$pageStr = str_replace('<!--content-->',$contentStr, $pageStr);
	
	echo $pageStr;

}
	else
		reportErrorAndDie('unable to render "admin" page because HTML template could not be read...');
		
}
else	// the POST array is filled and we need to authenticate the user
{
      $conn = mysqli_connect($DB_HOST, $DB_USER_ID, $DB_USER_PWD, $DB_DB_NAME);
      if (mysqli_connect_errno($conn))
      	   reportErrorAndDie('unable to connect to the database'); 
	
      $queryStr = 'SELECT * FROM `User` where `Handle`="' . $_POST['Handle'] . '";';
      
      if(!$result = mysqli_query($conn, $queryStr))
	    reportErrorAndDie('unable to process database query string: ', $conn . $queryStr);
      
      
      if(mysqli_num_rows($result) != 1)
	    reportErrorAndDie('unable to authenticate user');
	
      $userRow = mysqli_fetch_assoc($result);
      
      releaseMemAndCloseDB($conn, $result);
      
      $hashedPasswordFromUser = hash('sha512', $_POST['Password'] . $userRow['Salt']);
      
      if($hashedPasswordFromUser != $userRow['Password'])
	    reportErrorAndDie('unable to authenticate user');
	
      if(!isset($_SESSION))
		session_start();
	
      $_SESSION['id'] = $userRow['uid'];
      
      header('location:' . $SITE_URL . 'index.php');
}

?>
