<?php	// login

include_once('../includes/local-config.php');
include_once('../includes/config.php');
include_once($INCLUDES_DIR . 'functions.php');

if(!isset($_POST['submit']))	// we need to present the form and get the data
  {
	if(!isset($_SESSION))
		session_start();
	
	if(isLoggedIn())
		reportErrorAndDie('you are already logged in...');

	if($pageStr = file_get_contents($TEMPLATES_DIR . 'default.html'))
	{
			$pageStr = doGlobalSubstitutions($pageStr);
			
			$pageStr = str_replace('<!--banner-->', makeBanner('Notebook'), $pageStr);
			
			// this page layout should be done with CSS and NOT an html table!
			$contentStr = '
			<form method=POST action=' . $LOGIN_URL . 'index.php' . 
			' onsubmit="return validateLoginForm(this);">' . "\n" .
			'<table class="formTable">
				<tr>
					<td align=right><b>Login ID (your email):</b></td>
					<td align=left><input type=text name=email size=32 maxlength=64 /></td>
				</tr>
				<tr>
					<td align=right><b>Password:</b></td>
					<td align=left><input type=password name=password size=32 maxlength=64 /></td>
				</tr>
				<tr>
					<td align=right>&nbsp;</td>
					<td align=left>
						<input type=reset value=reset />
						<input type=button value=cancel onclick=moveTo("' . $SITE_URL . '") />
						<input type=submit name=submit value=submit />
					</td>
				</tr>
			</table>
			</form>
			<p>Not a user yet? <a href="' . $SITE_URL . '">Create An Account</a></p>
			';
			
			$pageStr = str_replace('<!--content-->',$contentStr, $pageStr);
			
			echo $pageStr;
	}
	else
		reportErrorAndDie('unable to render "login" page because HTML template could not be read...');
		
}
else	// the POST array is filled and we need to authenticate the user
{
      $conn = mysqli_connect($DB_HOST, $DB_USER_ID, $DB_USER_PWD, $DB_DB_NAME);
      if (mysqli_connect_errno($conn))
      	   reportErrorAndDie('unable to connect to the database'); 
	
      $queryStr = 'SELECT * FROM people where email="' . $_POST['email'] . '";';
      
      if(!$result = mysqli_query($conn, $queryStr))
	    reportErrorAndDie('unable to process database query string: ', $conn . $queryStr);
      
      
      if(mysqli_num_rows($result) != 1)
	    reportErrorAndDie('email not in system');
	
      $userRow = mysqli_fetch_assoc($result);
      
      releaseMemAndCloseDB($conn, $result);
      
      $hashedPasswordFromUser = hash('sha512', $_POST['password'] . $userRow['salt']);
      //echo "$hashedPasswordFromUser";
      if($hashedPasswordFromUser != $userRow['password'])
	    reportErrorAndDie('wrong password');
	
      if(!isset($_SESSION))
		session_start();
	
      $_SESSION['id'] = $userRow['people_id'];
	  $_SESSION['fname'] = $userRow['firstname'];
	  $_SESSION['lname'] = $userRow['lastname'];
	  $_SESSION['email'] = $userRow['email'];
      
      
      header('location:' . $AUTHOR_URL . 'index.php');
}

?>
