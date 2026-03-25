<html>

<head>
    <title>Insert people feedback</title>
</head>

<body>

<h1>
    Insert people feedback
</h1>

<?php

include_once('../includes/local-config.php');
include_once('../includes/config.php');
include_once($INCLUDES_DIR . 'functions.php');

	global $AUTHOR_URL;
    // get data from fields
    $firstname = $_POST['firstname'];
	$middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
	//$author = isset($_POST['author']) && $_POST['author'] ? "1" : "0";
	//$reviewer = isset($_POST['reviewer']) && $_POST['reviewer'] ? "1" : "0";
	$email = $_POST['email'];
	$salt = makeSalt();
	$password = $_POST['password'] = hash('sha512', $_POST['password'] . $salt);
	$confirm_password = $_POST['confirm_password'] = hash('sha512', $_POST['confirm_password'] . $salt);
	
	//$expertise1 = $_POST['expertise1'];
    
    // check required fields
	
	// First Name
	if (!$firstname) {
        echo "Hey, you didn't add a first name. Please <a href='../index.php'>try again</a>";
        exit;
    }
    
    // Last Name
    if (!$lastname) {
        echo "Hey, you didn't add a last name. Please <a href='../index.php'>try again</a>";
        exit;
    }
	
	// Check that the user checked to be at least an author or reviewer
	//if (!$author && !$reviewer){
		//echo "Hey, you didn't check either auhtor or reviewer. Please <a href='register.php'>try again</a>";
		//exit;
	//}
	
	// Email
	if (!$email) {
		echo "Hey, you didn't add an email. Please <a href='../index.php'> try again</a>";
		exit;
	}
	
	// Password
	if (!$password) {
		echo "Hey, you didn't add a password. Please <a href='../index.php'> try again</a>";
		exit;
	}
	
	// Confirm Password
	if (!$confirm_password) {
		echo "Hey, you didn't confirm your password. Please <a href='../index.php'> try again</a>";
		exit;
	}
	
	if ($confirm_password != $password) {
		echo "Hey, both password fields don't match. Please <a href='../index.php'> try again</a>";
		exit;
	}
	
	//if (!$expertise1){
		//echo "Hey, you didn't select an expertise. Please <a href='register.php'> try again</a>";
		//exit;
	//}
	
	
    // get a handle to the database
    @ $db = new mysqli($DB_HOST, $DB_USER_ID, $DB_USER_PWD, $DB_DB_NAME);
    
    // check if there was an error connecting to the database
	if ($db->connect_errno) {
        echo "Oops! We could not connect to the database.<p>\n This was the error we found: " . $db->connect_error . "\n <p>Please <a href='../index.php'>try again</a>";
        exit;
    }
	
	//check if email is in database already
	$checkEmailQuery = "SELECT email FROM people;";
	
	$result = $db->query($checkEmailQuery);
	
	if ($result){
			$numberofrows = $result->num_rows;
			
			for($i=0; $i < $numberofrows; $i++) {
            $row = $result->fetch_assoc();
				if ($email == $row['email']){
					echo "Hey, that email is already registered. Please <a href='../index.php'> try again</a>";
					exit;
				}
			}
	}
	
	// $checkAdminQuery = "SELECT administration FROM people;";
	
	//$result = $db->query($checkAdminQuery);
	
	if($result){
		$numberofrows = $result->num_rows;
		if($numberofrows > 0){
			$admin = '1';
		}
	}else{
		@ $admin = '0';
		}
    // prepare sql statement
	//$query = "insert into people (firstname, middlename, lastname, author, reviewer) values ('" . $firstname . "', '" . $middlename . "', '" . $lastname . "', '" . $author . "');";
	
	
	$query = "insert into people 
		(firstname,
		middlename,
		lastname,
		email,
		salt,
		password)

		values ('"
		. $firstname . "', '" . $middlename . "', '" . $lastname . 
		"', '" .$email .
		"', '" . $salt .
		"', '" .$password .

		"');";

	
	
	//$query = "insert into people (firstname, middlename, lastname, author, reviewer) values ('" . $firstname . "', '" . $middlename . "', '" . $lastname . "');";
	
		
	
    // execute sql statement
    $result = $db->query($query);
    
    // check if it worked
    if ($result) {
        echo $firstname . " " . $lastname . " was added to the database.";
        echo "<p>";
        echo "<a href='". $AUTHOR_URL . "'>Go to your dashboard</a><br>";
		echo "<a href='../admin/index.php'>Check Admin Page (Testing Purposes)</a><br>";
    } else {
        echo "Something went horribly wrong when adding " . $firstname . " " . $lastname . ".";
        echo "<p>This was the error: " . $db->error;
        echo "<p>This was the sql statement: " . $query;
        echo "<p>Please <a href='../index.php'>try again</a>";
    }
	
	//get user id
	$get_user_id_query = "SELECT people_id
	FROM people
	WHERE people.email = '" .$email . "'
	AND people.password = '" .$password . "';";
	
	// execute sql statement
	$user_id = $db->query($get_user_id_query);
	
	if ($user_id) {
        echo "Got user object id<br>";
        
    } else {
        echo "Something went wrong when retrieving USER ID from the database.<p>";
        echo "This was the error: " . $db->error . "<p>";
        echo "This was the sql statement: " . $get_user_id_query;
    }
	
	if ($user_id) {
        $numberofrows = $user_id->num_rows;
        $row = $user_id->fetch_assoc();
		$the_actual_id = $row['people_id'];
    
        
    } else {
        echo "Something went wrong when retrieving people from the database.<p>";
        echo "This was the error: " . $db->error . "<p>";
        echo "This was the sql statement: " . $query;
    }
	
	
	//Gets the user row in order to set up the Session variables for later use
	$queryStr = 'SELECT * FROM people where email="' . $_POST['email'] . '";';
      
      if(!$result = mysqli_query($db, $queryStr))
	    reportErrorAndDie('unable to process database query string: ', $conn . $queryStr);
      
      
      if(mysqli_num_rows($result) != 1)
	    reportErrorAndDie('email not in system');
	
      $userRow = mysqli_fetch_assoc($result);
      
	
	$_SESSION['id'] = $the_actual_id;
	
	  $_SESSION['fname'] = $userRow['firstname'];
	  $_SESSION['lname'] = $userRow['lastname'];
	  $_SESSION['email'] = $userRow['email'];

	if ($the_actual_id == 1) {
		$assign_admin_query = "INSERT INTO role_user (people_id, role_id) values ('$the_actual_id', '1')";
		$assign_role = $db->query($assign_admin_query);
		
	} else {
		$assign_member_query = "INSERT INTO role_user (people_id, role_id) values ('$the_actual_id', '3')";
		$assign_role = $db->query($assign_member_query);
	}
	
	if ($assign_role) {
		 echo "Added user role";
	
	} else {
		echo "Something went wrong assigning the user a role.<p>";
		echo "This was the error: " . $db->error . "<p>";
		echo "This was the sql statement: " . $assign_role;
	}


	
	

	
	
	
	
	
    $db->close();
?>

</body>

</html>