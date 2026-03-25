<?php

function doGlobalSubstitutions($pageStr, $STYLES_FILE = 'ourcss.css',
					$JAVASCRIPT_FILE = 'base.js', $FAVICON_FILE = 'favicon.ico')
{
	global $SITE_TITLE, $KEY_WORDS, $JAVASCRIPT_URL, $CSS_URL, $FAVICON_URL;
	
	$pageStr = str_replace('<!--sitetitle-->', $SITE_TITLE, $pageStr);
	$pageStr = str_replace('<!-- key words -->', $KEY_WORDS, $pageStr);
	$pageStr = str_replace('<!-- javascript functions -->', $JAVASCRIPT_URL . $JAVASCRIPT_FILE, $pageStr);
	$pageStr = str_replace('<!-- styles -->', $CSS_URL . $STYLES_FILE , $pageStr);
	$pageStr = str_replace('<!-- favicon -->', $FAVICON_URL . $FAVICON_FILE , $pageStr);
	$pageStr = str_replace('<!--navbar-->', makeNavBarStr(), $pageStr);
	$pageStr = str_replace('<!--sidebar-->', makeSideBarStr(), $pageStr);
	$pageStr = str_replace('<!--footer-->', makeFooterStr(), $pageStr);
	
	return $pageStr;
}

/*
functions to create strings to substitute into HTML templates
*/

function makeBanner($bannerStr = 'Unamed Notebook Page', $bannerImage = null)
{
	if(isset($bannerImage))
		return '<img src=' . $bannerImage . '/>' . "\n";
	
	return '<h1>' . $bannerStr . '</h1>';
}

function makeNavBarStr()
{
	
	Global $SITE_URL, $AUTHOR_URL, $REVIEWER_URL, $EBM_URL, $ADMIN_URL, $USERS_URL, $LOGIN_URL, $LIBRARY_URL;
	
	$loggedIn = isLoggedIn();
	$admin = isAdmin();
	
	$retStr = '';
	
	//Links to dashboard LATER BREAK UP INTO IF STATEMENTS FOR PERMISSIONS TO PAGES
	if($loggedIn)
	{
		$retStr .= "
				<a href=$AUTHOR_URL />Author</a>
				<a href=$REVIEWER_URL />Reviewer</a>
				<a href=$EBM_URL />Board Member</a>
		";
	}
	// user/profile/no link
	if($admin && $loggedIn)
	{
		$retStr .= "
			<a href=$ADMIN_URL />Admin</a>
	";
	}
	else if($loggedIn)
	{
		$userRow = getLoggedInUser();
		
		$retStr .= '
			<a href=' . $USERS_URL . 'edit.php?id=' . $userRow['people_id'] . '>Edit Profile</a>';
	}
	
	// login/logout link
	if($loggedIn)
	{
		$retStr .= '
			<a href=' . $LOGIN_URL . 'logout.php />Log Out</a>';
	}
	//else
	//{
		//$retStr .= 
			//'<a href=' . $LOGIN_URL . ' />Log In</a><br />';
	//}
	
	// home link
	//$retStr .= "
		//<a href=$SITE_URL />Home</a>";

	return $retStr;

}
function makeSideBarStr()
{
	
	Global $SITE_URL, $AUTHOR_URL, $REVIEWER_URL, $EBM_URL, $ADMIN_URL, $USERS_URL, $LOGIN_URL, $LIBRARY_URL;
	
	$loggedIn = isLoggedIn();
	$admin = isAdmin();
	
	
	$retStr = '';
	
	
	// user/profile/no link
	if($_SESSION['page_name']=='author' && $loggedIn)
	{
		$retStr .= "
			<ul>
				<li><a href=$AUTHOR_URL/>Submit Articles</a></li>
				<li><a href=$AUTHOR_URL/new_associations.php />New Associations</a></li>
				<li><a href=$AUTHOR_URL/view_articles.php />View Articles</a></li>
				<li><a href=$AUTHOR_URL/my_reviews.php>My Reviews</a></li>
				<li><a href=$AUTHOR_URL/resubmit.php>Resubmit Article</a></li>
			</ul>
	";
	}
	elseif($_SESSION['page_name']=='admin' && $loggedIn)
	{
		$retStr .= "
			<ul>
				<li><a href=" . $ADMIN_URL . ">New Articles</a></li>
				<li><a href=" . $ADMIN_URL . "assigned_articles.php>Assigned Articles</a></li>
				<li><a href=" . $ADMIN_URL . "add_expertise.php/>Add Expertise</a></li>
				<li><a href=" . $ADMIN_URL . "user_permissions.php>User Permissions</a></li>
				<li><a href=" . $ADMIN_URL . "view_users.php>View Users</a></li>
				<li><a href=" . $ADMIN_URL . "view_articles.php>View Articles</a></li>
				<li><a href=" . $ADMIN_URL . "view_ebm.php>View EBM</a></li>
			</ul>
	";
	}

	return $retStr;

}

function makeFooterStr()
{
	return '<small>Copyright &copy; 2013. This is an Informatics Project. Design ideas came from facebook. Code utilized from Stack Over and Univeristy of Iowa’s Professor Steve Strong.</small>';
}

function makeTableStr($table, $idFieldName, $fieldNameArray, $displayModifiers, $currDir = '', $orderBy = '', $resultSet = null, $thirdModifier = false)
{
	
	global $DB_HOST, $DB_USER_ID, $DB_USER_PWD, $DB_DB_NAME;
	
	if($thirdModifier)
		$colSpanNum = 3;
	else
		$colSpanNum = 2;
		
	$conn = mysqli_connect($DB_HOST, $DB_USER_ID, $DB_USER_PWD, $DB_DB_NAME);
	if (mysqli_connect_errno($conn))
		reportErrorAndDie('unable to connect to the database'); 
	
	if(!isset($resultSet))
		$resultSet = getAllRows($table, $orderBy);
	
	$returnStr = '';
	
	if($displayModifiers)
		$returnStr .= '<a href=' . $currDir . 'add.php><p>add</p></a>';
	
	$returnStr .=  '<table border=1 cellpadding=2 width=100%>';
	
	$returnStr .=  '<tr>' . "\n";
		foreach($fieldNameArray as $heading) 
			$returnStr .=  '<th>' . $heading . '</th>' . "\n";
		if($displayModifiers)
			$returnStr .= '<td colspan=' . $colSpanNum . '><center><b>Modify</b></center></td>' . "\n";
	$returnStr .= '</tr>' . "\n";
	
	while($row = mysqli_fetch_assoc($resultSet)) 
	{
		$returnStr .= '<tr>' . "\n";
		
		foreach($fieldNameArray as $fieldName => $description) 
		{
			if($row[$fieldName] == '')
				$value = '&nbsp;';
			else
				$value = $row[$fieldName];
				
			$returnStr .=  '<td>' . $value .'</td>' . "\n";
		}
		
		if($displayModifiers)
		{
			$returnStr .= '<td align=center><a href=' . $currDir .
				'edit.php?id=' . $row[$idFieldName] . 
				'>edit</a></td>' . "\n";
			$returnStr .= '<td align=center><a href=' . $currDir .
				'delete.php?id=' . 
				$row[$idFieldName] . '>delete</a></td>' . "\n";
				
			if($thirdModifier)
				$returnStr .= '<td align=center><a href=' . $currDir .
					'edit-certs.php?id=' . 
					$row[$idFieldName] . '>certs</a></td>' . "\n";
		}
		
		$returnStr .= '</tr>' . "\n";
	}
	$returnStr .= '</table>' . "\n";
	
	if($displayModifiers)
		$returnStr .=('<br /><a href=' . $currDir . 'add.php><p>add</p></a>' . "\n");
		
	releaseMemAndCloseDB($conn, $resultSet);
	
	return $returnStr;
}

?>
