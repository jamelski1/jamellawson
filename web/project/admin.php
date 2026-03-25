<html>

<head>
    <title>Admin Page</title>
</head>

<body>

<h1>Administration</h1>

<form action="insertexpertise.php" method="post">

<table>
    <tr>
        <td>*Expertise Name:</td>
        <td><input type="text" name="expertise_name" size="20"/></td>
    </tr>
	
</table>

<input type="submit" value="Add Expertise"/>

</form>

<!---------------->
<!-- List data  -->
<!---------------->
<p>
    <br/>
    <br/>
    <h2>Expertises in Database</h2>
</p>

<table>
    
    <!-- Titles for table -->
    <tr>
        <td>Expertise ID</td>
		<td>Expertise Name</td>
    </tr>
    
<?php
    // get a handle to the database
    @ $db = new mysqli('dbdev.cs.uiowa.edu', 'jllawsn', 'MwomvmeTs67R', 'db_jllawsn');
    
    // check if there was an error connecting to the database
    if ($db->connect_errno) {
        echo "Oops! We could not connect to the database.<p>\n This was the error we found: " . $db->connect_error . "\n <p>Please <a href='admin.php'>try again</a>";
        exit;
    }
    
    // prepare sql statement
    $query = "SELECT *
	FROM expertise
	ORDER BY expertise_name;";
    
    // execute sql statement
    $result = $db->query($query);
    
    // check if it worked
    if ($result) {
        $numberofrows = $result->num_rows;
		
        
        for($i=0; $i < $numberofrows; $i++) {
            $row = $result->fetch_assoc();
            echo "\n <tr>";
            echo "\n <td>" . $row['expertise_id'] . "</td>";
			echo "\n <td>" . $row['expertise_name'] . "</td>";
            echo "\n </tr>";
        }
        
    } else {
        echo "Something went wrong when retrieving people from the database.<p>";
        echo "This was the error: " . $db->error . "<p>";
        echo "This was the sql statement: " . $query;
    }
    
    $db->close();
    
?>    
    
</table>

</body>
</html>