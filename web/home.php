<?php	// authors

include_once('includes/local-config.php');
include_once('includes/config.php');
include_once($INCLUDES_DIR . 'functions.php');

if(!isLoggedIn()){
		echo ('You do not have permission to be on this page. <a href="' . $SITE_URL . '">Create an Account or Log In</a>');
		exit;
	}

if($pageStr = file_get_contents($TEMPLATES_DIR . 'default.html'))
{
	$pageStr = doGlobalSubstitutions($pageStr);
	$pageStr = str_replace('<!--banner-->', makeBanner("Dashboard"), $pageStr);

	$contentStr = "<h2>Home</h2>
					<h3>Updates</h3>
						<p>
							<ul>
								<li>Don't forget to check your email! (10/15/13 8:57 am)</li>
								<li>Seeking reviewers for topics in Computer Science<br/>
									Computer Engineering, and Informatics! (10/14/13)</li>
							</ul>
						</p>";
	
	$pageStr = str_replace('<!--content-->',$contentStr, $pageStr);
	
	echo $pageStr;
}
else
	reportErrorAndDie('unable to render page because HTML template could not be read...');

?>