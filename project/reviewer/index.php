<?php	// reviewers

include_once('../includes/local-config.php');
include_once('../includes/config.php');
include_once($INCLUDES_DIR . 'functions.php');

//This variable tells the page builder that we're on an reviewer's page
$_SESSION['page_name']='reviewer';

if(!isLoggedIn()){
		echo ('You do not have permission to be on this page. <a href="' . $SITE_URL . '">Create an Account or Log In</a>');
		exit;
	}

if($pageStr = file_get_contents($TEMPLATES_DIR . 'default.html'))
{
	$pageStr = doGlobalSubstitutions($pageStr);
	$pageStr = str_replace('<!--banner-->', makeBanner("Reviewer's Dashboard"), $pageStr);

	$contentStr = '
<h3>Submit an Article</h3>
	    <form action="insertreview.php" method="post" enctype="multipart/form-data">
		<table id="myTable">
                    						<tr>
									<td>*Select article to Review:</td>
									<td><select name="tobereviewed">
                                                                            <option value="article">articles get pulled here</option></select></td>
								</tr>
								<tr>
									<td>*Decision:</td>
									<td><select name="decision">
                                                                            <option value="accept">Accept</option>
                                                                            <option value="acceptwminor">Accept with minor changes</option>
                                                                            <option value="acceptwmajor">Accept with major changes</option>
                                                                            <option value="reject"> Reject</option></select></td>
								</tr>
								
								<tr>
									<td><label for="abstract">*Additional Comments:</label></td>
									<td><textarea rows="10" cols="50" name="abstract"></textarea></td>
								</tr>

								<tr>
									<td><input type="submit" value="Submit Review" name="upload"/></td>
								</tr>
								</table>

								</form>';
									$pageStr = str_replace('<!--content-->',$contentStr, $pageStr);
	
	echo $pageStr;
}
else
	reportErrorAndDie('unable to render page because HTML template could not be read...');

?>