<?php	// login

include_once('includes/local-config.php');
include_once('includes/config.php');
include_once($INCLUDES_DIR . 'functions.php');

//Tells the page builder function what page we're on to build the sidebar
$_SESSION['page_name']='home';

if(!isset($_POST['submit']))	// we need to present the form and get the data
  {
	if(!isset($_SESSION))
		session_start();
	
	if(isLoggedIn())
		reportErrorAndDie('You are already logged in. <a href="' . $HOME_URL . '">Home</a>' );
		
	if($pageStr = file_get_contents($TEMPLATES_DIR . 'default.html'))
	{
			$pageStr = doGlobalSubstitutions($pageStr);
			
			$pageStr = str_replace('<!--banner-->', 
			
				'<h1>Notebook</h1>
				<div id="logon">
			<form method=POST action=' . $LOGIN_URL . 'index.php' . 
			' onsubmit="return validateLoginForm(this);">' .
			'<table>
				<tr>
					<td>Email</td>
					<td>Password</td>
				</tr>
				<tr>
					<td><input type=text name=email size=20 maxlength=64 /></td>
					<td><input type=password name=password size=20 maxlength=64 /></td>
					<td><input id="normalLogin" type=submit name=submit value=Login /></td>
				</tr>
				<tr>
					<td><input type=checkbox name=keep/>Keep me logged in</td>
					<td><a href="newpassword.php">Forgot your password?</a></td>
				</tr>
			</table>
			</form>
		<!--End of Log In-->
				', $pageStr);
				
			$contentStr = '
			
			<h2>Create Account</h2>
			<div id="leftbox">
				<p class="description">Publish your work in a professional academic journal!</p>
				
				<p><br><ul><li>1. Submit Article</li><br/>
					<li>2. Receive Reviews</li><br/>
					<li>3. Get Published</li><br/>
				</ul></p>
				<p>Get Started Today!</p></p>
			</div>';
			
			$contentStr .= '
			
			<div id="rightbox">
			<form method=POST action=' . $REGISTER_URL . 'index.php' . 
			' onsubmit="return validateLoginForm(this);">' . "\n" .
			'<table class="formTable">
				<tr>
					<td><b>*First Name:</b></td>
					<td><input type=text name=firstname size=20 maxlength=64 /></td>
				</tr>
				<tr>
					<td><b>Middle Name:</b></td>
					<td><input type=text name=middlename size=20 maxlength=64 /></td>
				</tr>
				
				<tr>
					<td><b>*Last Name:</b></td>
					<td><input type=text name=lastname size=20 maxlength=64 /></td>
				</tr>
				
				<tr>
					<td><b>*Email:</b></td>
					<td><input type=text name=email size=20 maxlength=64 /></td>
				</tr>
				
				<tr>
					<td><b>*Password:</b></td>
					<td><input type=password name=password size=20 maxlength=64 /></td>
				</tr>
				
				<tr>
					<td><b>*Confirm Password:</b></td>
					<td><input type=password name=confirm_password size=20 maxlength=64 /></td>
				</tr>
				
			</table>
			<p>By clicking Sign Up, you agree to our Terms and that you
			have read our Data Use Policy, including our Cookie Use.</p>
			<input id="makeGreen" type=submit name=submit value="Sign Up"/>
			</form>
			</div>
			<hr/>
			';
			
			$pageStr = str_replace('<!--content-->',$contentStr, $pageStr);
			
			echo $pageStr;
	}
	else
		reportErrorAndDie('unable to render "login" page because HTML template could not be read...');
		
}
else	// the POST array is filled and we need to authenticate the user
{
      $salt = makeSalt();
	
	$_POST['password'] = hash('sha512', $_POST['password'] . $salt);
	$_POST = cleanPost($_POST);
	
	$queryStr = 'INSERT INTO User (';
	
	foreach ($usersFieldNameArray as $name => $value)
		$queryStr .= ' ' . $name . ',';
	$queryStr .= 'Salt';
	$queryStr .= ') VALUES (';
	
	foreach ($usersFieldNameArray as $name => $value)
		$queryStr .= '"' . $_POST[$name] . '",';
	
	$queryStr .= ' "' . $salt . '");';
	
	$link = mysqli_connect($DB_HOST, $DB_USER_ID, $DB_USER_PWD, $DB_DB_NAME);
	if(mysqli_connect_errno())
		reportErrorAndDie('Unable to connect to the server');
	
	$result = mysqli_query($link, $queryStr);
	if(mysqli_errno($link))
		reportErrorAndDie("unable to add the user to the database", $queryStr);

		
	releaseMemAndCloseDB($result);
	
	header('location:index.php');
}

?>
