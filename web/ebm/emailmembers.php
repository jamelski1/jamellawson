<?php	// EBM

include_once('../includes/local-config.php');
include_once('../includes/config.php');
include_once($INCLUDES_DIR . 'functions.php');

//Checks if user is logged in
if(!isLoggedIn()){
		echo ('You do not have permission to be on this page. <a href="' . $SITE_URL . '">Create an Account or Log In</a>');
		exit;
	}

//This variable tells the page builder that we're on an reviewer's page
$_SESSION['page_name']='ebm';

if(!isLoggedIn()){
		echo ('You do not have permission to be on this page. <a href="' . $SITE_URL . '">Create an Account or Log In</a>');
		exit;
	}

if($pageStr = file_get_contents($TEMPLATES_DIR . 'default.html'))
{
	$pageStr = doGlobalSubstitutions($pageStr);
	$pageStr = str_replace('<!--banner-->', makeBanner("Board Member Dashboard"), $pageStr);
	$contentStr = '
		<h3>E-mail Authors or Reviewers</h3>

		<form method="post" action="confirm_email.php" enctype="multipart/form-data">
		<table id="emailTable">
		<tr>
			<td>To:</td>
			<td><input type="text" name="to"></td>
		</tr>
		<tr>
			<td>Subject:</td>
			<td><input type="text" name="subject"></td>
		</tr>
		<tr>
			<td>Message:</td>
			<td><textarea rows="10" cols="50" name="message"></textarea></td>
		</tr>
		<tr>
			<td><input type="submit" value="Submit"</td>
		</tr>
		</table>
		</form>';
								
									$pageStr = str_replace('<!--content-->',$contentStr, $pageStr);
	
	echo $pageStr;
}
else
	reportErrorAndDie('unable to render page because HTML template could not be read...');

?>
