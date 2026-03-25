<?php	// ADMIN

include_once('../includes/local-config.php');
include_once('../includes/config.php');
include_once($INCLUDES_DIR . 'functions.php');

//Tells the page building function what page we're on to build the sidebar
$_SESSION['page_name']='admin';
$article_id=$_POST['assign'];

if(!isset($_POST['submit']))	// we need to present the form and get the data
  {
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
			<h3>Assign</h3>
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
	WHERE article_id = $article_id;";
    
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
	
	$contentStr .= "
	
	<p>
		<br/>
		<br/>
		<h3>Editorial Board Members</h3>
	</p>
	
	<table>
    
    <!-- Titles for table -->
    <tr>
    <td>First Name</td>
    <td>Last Name</td>
	<td>Email</td>
	<td>Assign</td>
  </tr>";
  
  $query = "SELECT DISTINCT people.people_id, firstname, lastname, email
	FROM people, role_user, role
	WHERE people.people_id = role_user.people_id AND role_user.role_id = 2
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
            $contentStr .= "\n <td>" . $row['lastname'] . "</td>";
			$contentStr .= "\n <td>" . $row['email'] . "</td>";
			$contentStr .= "\n <td><form action='connect_ebm.php' method='post'>
								<input type='hidden' id='article_id' name='article_id' value=" . $article_id . ">
								<button name='apply' type='submit' value=" . $row['people_id'] . ">Assign</button>
								</form></td>";
            $contentStr .= "\n </tr>";
        }
		$contentStr .= "</table>";
        
    } else {
        echo "Something went wrong when retrieving editorial board members from the database.<p>";
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
