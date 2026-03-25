<?php
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
    
    // check if it worked
    if ($result) {
        $numberofrows = $result->num_rows;
		
		ob_start();
		
		echo '<tr>';
		echo '<td>*Field of Expertise:</td>';
        echo '<td><select name="expertise">';
		echo '<option value="" selected>Please Select ...</option>';
		
		//$out1 = ob_get_contents();
		
        for($i=0; $i < $numberofrows; $i++) {
            $row = $result->fetch_assoc();
			$theExpertise = $row['expertise_name'];
			echo '\n <option value="' . $theExpertise . '">' . $theExpertise . '</option>';
        }
        echo "\n </tr>";
		
		$out2 = ob_get_contents();
		
		//ob_end_clean();
		$expertise_dropdown = var_dump($out2);
    } else {
        echo "Something went wrong when retrieving people from the database.<p>";
        echo "This was the error: " . $db->error . "<p>";
        echo "This was the sql statement: " . $query;
    }
    
    $db->close();
    
?>    