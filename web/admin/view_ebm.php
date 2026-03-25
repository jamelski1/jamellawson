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
    @ $db = new mysqli($DB_HOST, $DB_USER_ID, $DB_USER_PWD, $DB_DB_NAME);
    
    // check if there was an error connecting to the database
    if ($db->connect_errno) {
        echo "Oops! We could not connect to the database.<p>\n This was the error we found: " . $db->connect_error . "\n <p>Please <a href='register.php'>try again</a>";
        exit;
    }
    
    // prepare sql statement
    $query = "SELECT people_id, firstname, lastname 
	FROM people
	ORDER BY lastname;";
    
    // execute sql statement
    $result = $db->query($query);
    
    // check if it worked
    if ($result) {
        $numberofrows = $result->num_rows;
		
		//ob_start();
		
		//$out1 = ob_get_contents();
		
        for($i=0; $i < $numberofrows; $i++) {
            $row = $result->fetch_assoc();
			$theValue = $row['people_id'];
			$theFirstname = $row['firstname'];
			$theLastname = $row['lastname'];
			
			$contentStr = '<option value="' . $theValue . '">' . $theLastname . ', ' . $theFirstname . '</option>';
        }
		
		//$out2 = ob_get_contents();
		
		//ob_end_clean();
		//$ebm_dropdown = var_dump($out2);
    } else {
        echo "Something went wrong when retrieving people from the database.<p>";
        echo "This was the error: " . $db->error . "<p>";
        echo "This was the sql statement: " . $query;
    }
    
    $db->close();
    
			
    // get a handle to the database
    //@ $db = new mysqli('dbdev.cs.uiowa.edu', 'jllawsn', 'MwomvmeTs67R', 'db_jllawsn');
	@ $db = new mysqli($DB_HOST, $DB_USER_ID, $DB_USER_PWD, $DB_DB_NAME);
    
    // check if there was an error connecting to the database
    if ($db->connect_errno) {
        echo "Oops! We could not connect to the database.<p>\n This was the error we found: " . $db->connect_error . "\n <p>Please <a href='admin.php'>try again</a>";
        exit;
    }
    
	$contentStr .= "<p>
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
  </tr>";
  
  $query = "SELECT DISTINCT firstname, lastname, email
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