<?php	// authors

include_once('../includes/local-config.php');
include_once('../includes/config.php');
include_once($INCLUDES_DIR . 'functions.php');

//This variable tells the page builder that we're on an author's page
$_SESSION['page_name']='author';

if(!isLoggedIn()){
		echo ('You do not have permission to be on this page. <a href="' . $SITE_URL . '">Create an Account or Log In</a>');
		exit;
	}

if($pageStr = file_get_contents($TEMPLATES_DIR . 'default.html'))
{
	$pageStr = doGlobalSubstitutions($pageStr);
	$pageStr = str_replace('<!--banner-->', makeBanner("Author's Dashboard"), $pageStr);

	$contentStr = '
	<h3>Submit Article</h3>
						<form action="insertarticle.php" method="post" enctype="multipart/form-data">

							<div class="authorLabel">		
							<label for="file">*Article PDF:</label>
							</div>
							
							<div>
							<input type="file" name="file" id="file">
							</div>
							
							<div class="authorLabel">
							<label for="title">*Article Title:</label>
							</div>
							
							<div>
							<input type="text" name="title" size="20"/>
							</div>
							
							<div class="authorLabel">
							<label for="abstract">*Article Abstract:</label>
							</div>
							
							<div>
							<textarea rows="10" cols="50" name="abstract"></textarea>
							</div>
							
							<div id="authorTitle">
							<label for="">Additional Authors:</label>
							</div>
						
							<div class="authorLabel">
							<label for="firstname">First Name:</label>
							</div>
							
							<div>
							<input type="text" name="firstname">
							</div>
							
							<div class="authorLabel">
							<label for="lastname">Last Name:</label>
							</div>
							
							<div>
							<input type="text" name="lastname">
							</div>
							
							<div class="authorLabel">
							<label for="email">Email:</label>
							</div>
							
							<div>
							<input type="text" name="email">
							</div>
						
							<div id="authorSubmit">
							<input type="submit" value="Submit Form" name="upload"/>
							</div>

						</form>';
	
	$pageStr = str_replace('<!--content-->',$contentStr, $pageStr);
	
	echo $pageStr;
}
else
	reportErrorAndDie('unable to render page because HTML template could not be read...');

?>