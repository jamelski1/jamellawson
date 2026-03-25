<?php	// ADMIN

include_once('../includes/local-config.php');
include_once('../includes/config.php');
include_once($INCLUDES_DIR . 'functions.php');

//Tells the page building function what page we're on to build the sidebar
$_SESSION['page_name']='admin';

if(!isset($_POST['submit']))	// we need to present the form and get the data
  {
	if(!isset($_SESSION)){
		session_start();
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
			<h3>New Associations</h3>
		</p>

		<table>
			
			<!-- Titles for table -->
			<tr>
				<td>Submitted By</td>
				<td>Article</td>
				<td>Open File</td>
				<td>Confirm Association</td>
			</tr> ';
    
    
    // prepare sql statement
    $query = "SELECT inviter, title, email, article_id
	FROM invited_authors
	WHERE email ='" . $_SESSION['email'] .
	"' ORDER BY title;";
    
    // execute sql statement
    $result = $db->query($query);
    
    // check if it worked
    if ($result) {
        $numberofrows = $result->num_rows;
		
        
        for($i=0; $i < $numberofrows; $i++) {
            $row = $result->fetch_assoc();
    
			$contentStr .= "\n <tr>";
            $contentStr .= "\n <td>" . $row['inviter'] . "</td>";
			$contentStr .= "\n <td>" . $row['title'] . "</td>";
			$contentStr .= "\n <td> <a href='../author/submitted_articles.php?fid=" . $row['article_id'] . "'>View Article</a></td>";
			$contentStr .= "\n <td><form action='confirm_art.php' method='post'>
								<button name='confirm' type='submit' value=" . $row['article_id'] . ">Confirm</button>
								</form></td>";
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
