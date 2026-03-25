<?php

// "cleans" all of the entries in the array passed in to protect against injections
function cleanPost($link, $post, $pwdFieldName='Password')
{
	foreach($post as $key => $value)
		if($key!=$pwdFieldName)
			$post[$key] = htmlentities(mysqli_real_escape_string($link, $value));
				
	return $post;
}

function getWoodFieldNameArray()
{
	return array('name'=>'Name','density'=>'Density',
		'hardness'=>'Hardness', 'workability'=>'Workability','color'=>'Color',
						'notes'=>'Comments');
}

function getUserFieldNameArray($includePassord = false, $includeAdmin = true)
{
	$retArray = array('FirstName'=>'First Name', 'LastName'=>'Last Name', 
		'FavoriteWood'=>'Favorite Wood');
	
	if($includePassord)
	{
		$retArray['Password'] = 'Password';
		//$retArray['Salt'] = 'Salt';
	}
	
	if($includeAdmin)
	{
		$retArray['Handle'] = 'Login ID';
		$retArray['RoleID'] = 'Role';
	}
	
	return $retArray;
}

// handles foreign key fields being able to display more than the foreign key
function getUserIndexFieldNameArray($includePassord = false)
{
	$retArray = array('FirstName'=>'First Name', 'LastName'=>'Last Name', 
		'Handle' => 'Login ID', 'Title' => 'Role', 'name' => 'Favorite Wood',
		'ToolName' => 'Certifications');
	
	if($includePassord)
		$retArray['Password'] = 'Password';
	$retArray['name'] = 'Favorite Wood';
	
	return $retArray;
}

function getToolFieldNameArray()
{
	return array('ToolName'=>'Name', 'Description'=>'Description', 
		'SafetyIssues' => 'Safety Issues');
}

function getValuesArray($tableName, $valueFieldName, $idFieldName)
{
	$toolsResource = getAllRows($tableName, $valueFieldName);
	$returnArray = array();
	while($row = mysqli_fetch_assoc($toolsResource))
		$returnArray[$row[$idFieldName]] = $row[$valueFieldName];
	
	return $returnArray;
}

function getCertValuesArray()
{
	$retArray = array();
	
	$tools = getAllRows('Tool', 'ToolName');
	while($toolRow = mysqli_fetch_assoc($tools))
		$retArray[$toolRow['tid']] = $toolRow['ToolName'];
	
	return $retArray;
}

function makeSelect($name, $resultSet, $idFieldName, $descFieldName, $selectedItemNumber = -1)
{
	$returnStr = '<select name=' . $name . '>';
	
	while($row = mysqli_fetch_assoc($resultSet))
	{
		$returnStr .= '<option value=' . $row[$idFieldName]; 
		if($selectedItemNumber == $row[$idFieldName])
			$returnStr .= ' selected=selected ';
		$returnStr .= '>' . $row[$descFieldName] . '</option>';;
	}
	$returnStr .= '</select>';
	
	return $returnStr;
}

function makeCheckBoxStr($tableName, $keyFieldName, $valueFieldName, $results = null)
{
	// on our "to do" list!
}

?>
