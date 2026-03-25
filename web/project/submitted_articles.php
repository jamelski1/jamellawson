 <html>
 
 <body>
 

 
<?php
if(isset($_GET['fid']))
{
// connect to the database
// get a handle to the database
    @ $db = new mysqli('dbdev.cs.uiowa.edu', 'jllawsn', 'MwomvmeTs67R', 'db_jllawsn');
    
    // check if there was an error connecting to the database
	if ($db->connect_errno) {
        echo "Oops! We could not connect to the database.<p>\n This was the error we found: " . $db->connect_error . "\n <p>Please <a href='admin.php'>try again</a>";
        exit;
    }

// query the server for the file
$fid = $_GET['fid'];
$query = "SELECT * FROM files WHERE fid = '$fid'";
$result = $db->query($query) or die(mysqli_error());

// define results into variables

$row = $result->fetch_assoc();
$name = $row['name'];
$size = $row['size'];
$type = $row['type'];
$content = $row['content'];

// give our file the proper headers...otherwise our page will be confused
header("Content-Disposition: attachment; filename=$name");
header("Content-length: $size");
header("Content-type: $type");
echo $content;

$db->close();
}else{
die("No file ID given...");
}

?> 

</body>

</html>