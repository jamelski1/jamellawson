<html>

<head>
    <title>Register</title>
	
	<!-- Experimental Java Script to add a new Expertise drop-down -->
	<script>
		function displayResult()
		{
		var myvar = <?php echo json_encode($myVarValue); ?>;
		var rowNumber = 8;
		var table=document.getElementById("myTable");
		var row=table.insertRow(rowNumber);
		//var cell1=row.insertCell(0);
		var cell2=row.insertCell(1);
		//cell1.innerHTML= $myString;
		cell2.innerHTML=myvar;
		rowNumber = rowNumber + 1;
		}
	</script>
</head>




<!-- Beginning of the Document -->
<body>



<h1>Register</h1>

<!--Registration Form -->
<form action="insertperson.php" method="post">

<table id="myTable">
    <tr>
        <td>*First Name:</td>
        <td><input type="text" name="firstname" size="20"/></td>
    </tr>
    
	<tr>
        <td>Middle Name:</td>
        <td><input type="text" name="middlename" size="20"/></td>
    </tr>
	
    <tr>
        <td>*Last Name:</td>
        <td><input type="text" name="lastname" size="20"/></td>
    </tr>
	
	<tr>
		<td>*User Type:</td>
		<td><input type="checkbox" name="author" value="author"/>Author</td>
		<td><input type="checkbox" name="reviewer" value="reviewer"/>Reviewer</td>
	</tr>
	
	<tr>
		<td>*Email:</td>
		<td><input type="text" name="email" size="20"/></td>
	</tr>
	
	<tr>
		<td>*Password:</td>
		<td><input type="password" name="password" size="20"/></td>
	</tr>
	
	<tr>
		<td>*Confirm Password:</td>
		<td><input type="password" name="confirm_password" size="20"/></td>
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
		echo '<td>* Field of Expertise 1:</td>';
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
	<!--Old Expertise Table
	
	<tr>
		<td>*Field of Expertise:</td>
		<td><select name="expertise">
		<option value="" selected>Please Select ...</option>
		<option value="Actuary Science">Actuary Science</option>
		<option value="Computer Science">Computer Science</option>
		<option value="Informatics">Informatics</option>
		<option value="Mathematics">Mathematics</option></td>
	</tr> -->
	
	<!-- I'll Use AJAX to implement this in the Future
	<tr>
		<td><button type ="button" onclick="displayResult()">+Add Expertise</button></td>
	</tr>
	
	-->

	<!-- Other Text Field for additional Expertises not listed
	<tr>
		<td>Other:</td>
		<td><input type="text" name="other" size="20"/></td>
	</tr>
	-->
	
	
</table>

<input type="submit" value="Submit Form"/>

</form> <!--End of Registration Form -->

<!---------------->
<!-- List data  -->
<!---------------->
<p>
    <br/>
    <br/>
    <h2>People in the database</h2>
</p>

<table>
    
    <!-- Titles for table -->
    <tr>
        <td>First Name</td>
		<td>Middle Name</td>
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
    $query = "SELECT firstname, middlename, lastname, author, reviewer, email, password, expertise_name 
	FROM people, expertise_detail, expertise
	WHERE people.people_id = expertise_detail.people_id
	AND expertise_detail.expertise_id = expertise.expertise_id
	ORDER BY lastname;";
    
    // execute sql statement
    $result = $db->query($query);
    
    // check if it worked
    if ($result) {
        $numberofrows = $result->num_rows;
		
        
        for($i=0; $i < $numberofrows; $i++) {
            $row = $result->fetch_assoc();
            echo "\n <tr>";
            echo "\n <td>" . $row['firstname'] . "</td>";
			echo "\n <td>" . $row['middlename'] . "</td>";
            echo "\n <td>" . $row['lastname'] . "</td>";
			echo "\n <td>" . $row['author'] . "</td>";
			echo "\n <td>" . $row['reviewer'] . "</td>";
			echo "\n <td>" . $row['email'] . "</td>";
			echo "\n <td>" . $row['password'] . "</td>";
			echo "\n <td>" . $row['expertise_name'] . "<td>";
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