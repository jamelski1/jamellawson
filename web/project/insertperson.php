<html>

<head>
    <title>Insert people feedback</title>
</head>

<body>

<h1>
    Insert people feedback
</h1>

<?php
    // get data from fields
    $firstname = $_POST['firstname'];
	$middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
	$author = isset($_POST['author']) && $_POST['author'] ? "1" : "0";
	$reviewer = isset($_POST['reviewer']) && $_POST['reviewer'] ? "1" : "0";
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
	$expertise1 = $_POST['expertise1'];
    
    // check required fields
	
	// First Name
	if (!$firstname) {
        echo "Hey, you didn't add a first name. Please <a href='register.php'>try again</a>";
        exit;
    }
    
    // Last Name
    if (!$lastname) {
        echo "Hey, you didn't add a last name. Please <a href='register.php'>try again</a>";
        exit;
    }
	
	// Check that the user checked to be at least an author or reviewer
	if (!$author && !$reviewer){
		echo "Hey, you didn't check either auhtor or reviewer. Please <a href='register.php'>try again</a>";
		exit;
	}
	
	// Email
	if (!$email) {
		echo "Hey, you didn't add an email. Please <a href='register.php'> try again</a>";
		exit;
	}
	
	// Password
	if (!$password) {
		echo "Hey, you didn't add a password. Please <a href='register.php'> try again</a>";
		exit;
	}
	
	// Confirm Password
	if (!$confirm_password) {
		echo "Hey, you didn't confirm your password. Please <a href='register.php'> try again</a>";
		exit;
	}
	
	if ($confirm_password != $password) {
		echo "Hey, both password fields don't match. Please <a href='register.php'> try again</a>";
		exit;
	}
	
	if (!$expertise1){
		echo "Hey, you didn't select an expertise. Please <a href='register.php'> try again</a>";
		exit;
	}
	
	
    // get a handle to the database
    @ $db = new mysqli('dbdev.cs.uiowa.edu', 'jllawsn', 'MwomvmeTs67R', 'db_jllawsn');
    
    // check if there was an error connecting to the database
	if ($db->connect_errno) {
        echo "Oops! We could not connect to the database.<p>\n This was the error we found: " . $db->connect_error . "\n <p>Please <a href='admin.php'>try again</a>";
        exit;
    }
    
    // prepare sql statement
	//$query = "insert into people (firstname, middlename, lastname, author, reviewer) values ('" . $firstname . "', '" . $middlename . "', '" . $lastname . "', '" . $author . "');";
	
	
	$query = "insert into people 
		(firstname,
		middlename,
		lastname,
		author,
		reviewer,
		email,
		password)

		values ('"
		. $firstname . "', '" . $middlename . "', '" . $lastname .
		"', '" . $author . "', '" . $reviewer . "', '" .$email .
		"', '" .$password .

		"');";

	
	
	//$query = "insert into people (firstname, middlename, lastname, author, reviewer) values ('" . $firstname . "', '" . $middlename . "', '" . $lastname . "');";
	
		
	
    // execute sql statement
    $result = $db->query($query);
    
    // check if it worked
    if ($result) {
        echo $firstname . " " . $lastname . " was added to the database.";
        echo "<p>";
        echo "<a href='submit_article.html'>Go to your dashboard</a><br>";
		echo "<a href='register.php'>Check Database (Testing Purposes)</a><br>";
    } else {
        echo "Something went horribly wrong when adding " . $firstname . " " . $lastname . ".";
        echo "<p>This was the error: " . $db->error;
        echo "<p>This was the sql statement: " . $query;
        echo "<p>Please <a href='register.php'>try again</a>";
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
	
	
	//get expertise id query
	$get_expertise_id_query = "SELECT expertise_id
	FROM expertise
	WHERE expertise.expertise_name = '" . $expertise1 . "';";
	
	// execute sql statement
	$expertise_id = $db->query($get_expertise_id_query);
	
	if ($expertise_id) {
        echo "Got expertise object id<br>";
        
    } else {
        echo "Something went wrong when retrieving USER ID from the database.<p>";
        echo "This was the error: " . $db->error . "<p>";
        echo "This was the sql statement: " . $get_expertise_id_query;
    }
	
	if ($expertise_id) {
        $numberofrows = $expertise_id->num_rows;
        $row = $expertise_id->fetch_assoc();
		$the_actual_expertise = $row['expertise_id'];
    
        
    } else {
        echo "Something went wrong when retrieving people from the database.<p>";
        echo "This was the error: " . $db->error . "<p>";
    }
	$connect_expertise_detail = "INSERT INTO expertise_detail(
	people_id,
	expertise_id)
	
	VALUES('" . $the_actual_id . "', '" . $the_actual_expertise . "');";
	
	// execute sql statement
	$connect_expertise_detail = $db->query($connect_expertise_detail);
	
	if($connect_expertise_detail){
		echo "Expertise added to Expertise Detail Table.<br>";
	
	} else {
        echo "Something went wrong when retrieving people from the database.<p>";
        echo "This was the error: " . $db->error . "<p>";
		
	}

	
	
	
	
	
    $db->close();
?>

</body>

</html>