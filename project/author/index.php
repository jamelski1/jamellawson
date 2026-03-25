<?php	// authors

include_once('../includes/local-config.php');
include_once('../includes/config.php');
include_once($INCLUDES_DIR . 'functions.php');

//This variable tells the page builder that we're on an author's page
$_SESSION['page_name']='author';
$authorNumber = 1;

if(!isLoggedIn()){
		echo ('You do not have permission to be on this page. <a href="' . $SITE_URL . '">Create an Account or Log In</a>');
		exit;
	}

if($pageStr = file_get_contents($TEMPLATES_DIR . 'default.html'))
{
	$pageStr = doGlobalSubstitutions($pageStr);
	$pageStr = str_replace('<!--banner-->', makeBanner("Author's Dashboard"), $pageStr);
$str = <<<EOD
Example of string
spanning multiple lines
using heredoc syntax.
EOD;
	$contentStr = <<<EOD
	<h3>Submit Article</h3>
						<form action="insertarticle.php" method="post" enctype="multipart/form-data">
								<div id="articleSubmit">
									<div id="articleLabels">
									<ul><li>Article PDF:</li>
										<li>Article Title:</li>
										<li>Article Abstract:</li>
									</ul>
									</div>
									<div id="articleFields">
									<ul><li><input type="file" name="file" id="file"></li>
										<li><input type="text" name="title" size="20"/></li>
										<li><textarea rows="10" cols="50" name="abstract"></textarea></li>
									</ul>
									</div>
									<div id="submitAuthors">
									<p>Additional Authors:</p>
									<div id="authorNames">
									<ul><li><p>First Name:</p><input type="text" name="firstname[]"></li>
										<li><p>Last Name:</p><input type="text" name="lastname[]"></li>
										<li><p>Email:</p><input type="text" name="email[]"></li>
									</ul><br/>
									
									</div>
									
									
									<script>

										function myFunction(authorNumber)
											{
											$("#authorNames").append('<ul><li><p>First Name:</p><input type=text name="firstname[]"></li><li><p>Last Name:</p><input type=text name="lastname[]"></li><li><p>Email:</p><input type=text name="email[]"></li></ul><br/>');
											}
									</script>
									<div id="myButton">
									<button type="button" onclick="myFunction()">+Add Author</button>
									</div>
									
									<div id="articleSubmit">
									<input type="submit" value="Submit Form" name="upload"/>
									</div>
									
									</div>
								</div>
						</form>'
EOD;
	
	$pageStr = str_replace('<!--content-->',$contentStr, $pageStr);
	
	echo $pageStr;
}
else
	reportErrorAndDie('unable to render page because HTML template could not be read...');

?>