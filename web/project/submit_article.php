<html>

<head>
    <title>Submit Article</title>
</head>




<!-- Beginning of the Document -->
<body>



<h1>Submit Article</h1>

<!--Registration Form -->
<form action="insertarticle.php" method="post" enctype="multipart/form-data">

<table id="myTable">
    <tr>
        <td><label for="file">*Article PDF:</label></td>
        <td><input type="file" name="file" id="file"></td>
    </tr>
    
	<tr>
        <td>*Article Title:</td>
        <td><input type="text" name="title" size="20"/></td>
    </tr>
	
    <tr>
        <td><label for="abstract">*Article Abstract:</label></td>
        <td><textarea rows="10" cols="50" name="abstract"></textarea></td>
    </tr>
	
	<tr>
		<td>Additional Authors:</td>
	</tr>
	
	<tr>
		<td><label for="firstname">First Name:</label></td>
		<td><input type="text" name="firstname"></td>
	</tr>
	
	<tr>
		<td><label for="lastname">Last Name:</label></td>
		<td><input type="text" name="lastname"></td>
	</tr>
	
	<tr>
		<td><label for="email">Email:</label></td>
		<td><input type="text" name="email"></td>
	</tr>
	
	<?php
	//This Creates the Expertise Drop Down
    // get a handle to the database
    @ $db = new mysqli('dbdev.cs.uiowa.edu', 'jllawsn', 'MwomvmeTs67R', 'db_jllawsn');
    
    // check if there was an error connecting to the database
    if ($db->connect_errno) {
        echo "Oops! We could not connect to the database.<p>\n This was the error we found: " . $db->connect_error . "\n <p>Please <a href='register.php'>try again</a>";
        exit;
    }
    
    // prepare sql statement
    $query = "SELECT expertise_name 
	FROM expertise
	ORDER BY expertise_name;";
    
    // execute sql statement
    $result = $db->query($query);
    
	//ob_start();
    // check if it worked
    if ($result) {
        $numberofrows = $result->num_rows;
		
		
		echo '<tr>';
		echo '<td>*Category of Article:</td>';
        echo '<td><select name="expertise1">';
		echo '<option value="" selected>Please Select ...</option>';
		
        for($i=0; $i < $numberofrows; $i++) {
            $row = $result->fetch_assoc();
			$theExpertise = $row['expertise_name'];
			echo '\n <option value="' . $theExpertise . '">' . $theExpertise . '</option>';
        }
        echo "\n </tr>";
    } else {
        echo "Something went wrong when retrieving people from the database.<p>";
        echo "This was the error: " . $db->error . "<p>";
        echo "This was the sql statement: " . $query;
    }
	
	//$out1 = ob_get_contents();
	
	//ob_end_clean();
	
	//$myVarValue = var_dump($out1);
	
    
    $db->close();
    
?>    


</table>

<input type="submit" value="Submit Form" name="upload"/>

</form> <!--End of Registration Form -->

<!---------------->
<!-- List data  -->
<!---------------->

<p>
    <br/>
    <br/>
    <h2>Articles in the database</h2>
</p>

<table>
    
    <!-- Titles for table -->
    <tr>
        <td>Article Title</td>
		<td>Abstract</td>
        <td>Last Name</td>
		<td>Author</td>
		<td>Reviewer</td>
		<td>Email</td>
		<td>Password</td>
		<td>Expertise</td>
    </tr>
    
<?php
    // get a handle to the database
    @ $db = new mysqli('dbdev.cs.uiowa.edu', 'jllawsn', 'MwomvmeTs67R', 'db_jllawsn');
    
    // check if there was an error connecting to the database
    if ($db->connect_errno) {
        echo "Oops! We could not connect to the database.<p>\n This was the error we found: " . $db->connect_error . "\n <p>Please <a href='register.php'>try again</a>";
        exit;
    }
    
    // prepare sql statement
    $query = "SELECT title 
	FROM articles
	ORDER BY title;";
    
    // execute sql statement
    $result = $db->query($query);
    
    // check if it worked
    if ($result) {
        $numberofrows = $result->num_rows;
		
        
        for($i=0; $i < $numberofrows; $i++) {
            $row = $result->fetch_assoc();
            echo "\n <tr>";
            echo "\n <td>" . $row['title'] . "</td>";
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