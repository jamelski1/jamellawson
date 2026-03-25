<?php

include_once('../includes/local-config.php');
include_once('../includes/config.php');
include_once($INCLUDES_DIR . 'functions.php');

include('../includes/pdf2text.php');
require('../fpdf/fpdf.php');

if(isset($_GET['fid']))
{
// connect to the database
// get a handle to the database
    @ $db = new mysqli($DB_HOST, $DB_USER_ID, $DB_USER_PWD, $DB_DB_NAME);
    
    // check if there was an error connecting to the database
	if ($db->connect_errno) {
        echo "Oops! We could not connect to the database.<p>\n This was the error we found: " . $db->connect_error . "\n <p>Please <a href='view_article.php'>try again</a>";
        exit;
    }
	


// query the server for the file
$fid = $_GET['fid'];
$query = "SELECT name, size, type, content FROM articles WHERE article_id = '$fid'";
$result = $db->query($query) or die(mysqli_error());

// define results into variables

$row = $result->fetch_assoc();
$name = $row['name'];
$size = $row['size'];
$type = $row['type'];
$content = $row['content'];




// give our file the proper headers...otherwise our page will be confused
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,$content);
$pdf->Output($name, 'D');

//if(!get_magic_quotes_gpc()){
//$name = mysqli_real_escape_string($name);
//}

//$content = mysqli_real_escape_string($content);

//header("Content-Disposition: attachment; filename=" . $name );
//header("Content-length:" . $size );
//header("Content-type:" . $type );
//echo $content;

$db->close();
}else{
die("No file ID given...");
}

?>