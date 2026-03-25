<?php

include_once('../includes/local-config.php');
include_once('../includes/config.php');
include_once($INCLUDES_DIR . 'functions.php');

require('../fpdf/fpdf.php');

function decodeAsciiHex($input) {
    $output = "";

    $isOdd = true;
    $isComment = false;

    for($i = 0, $codeHigh = -1; $i < strlen($input) && $input[$i] != '>'; $i++) {
        $c = $input[$i];

        if($isComment) {
            if ($c == '\r' || $c == '\n')
                $isComment = false;
            continue;
        }

        switch($c) {
            case '\0': case '\t': case '\r': case '\f': case '\n': case ' ': break;
            case '%': 
                $isComment = true;
            break;

            default:
                $code = hexdec($c);
                if($code === 0 && $c != '0')
                    return "";

                if($isOdd)
                    $codeHigh = $code;
                else
                    $output .= chr($codeHigh * 16 + $code);

                $isOdd = !$isOdd;
            break;
        }
    }

    if($input[$i] != '>')
        return "";

    if($isOdd)
        $output .= chr($codeHigh * 16);

    return $output;
}
function decodeAscii85($input) {
    $output = "";

    $isComment = false;
    $ords = array();
    
    for($i = 0, $state = 0; $i < strlen($input) && $input[$i] != '~'; $i++) {
        $c = $input[$i];

        if($isComment) {
            if ($c == '\r' || $c == '\n')
                $isComment = false;
            continue;
        }

        if ($c == '\0' || $c == '\t' || $c == '\r' || $c == '\f' || $c == '\n' || $c == ' ')
            continue;
        if ($c == '%') {
            $isComment = true;
            continue;
        }
        if ($c == 'z' && $state === 0) {
            $output .= str_repeat(chr(0), 4);
            continue;
        }
        if ($c < '!' || $c > 'u')
            return "";

        $code = ord($input[$i]) & 0xff;
        $ords[$state++] = $code - ord('!');

        if ($state == 5) {
            $state = 0;
            for ($sum = 0, $j = 0; $j < 5; $j++)
                $sum = $sum * 85 + $ords[$j];
            for ($j = 3; $j >= 0; $j--)
                $output .= chr($sum >> ($j * 8));
        }
    }
    if ($state === 1)
        return "";
    elseif ($state > 1) {
        for ($i = 0, $sum = 0; $i < $state; $i++)
            $sum += ($ords[$i] + ($i == $state - 1)) * pow(85, 4 - $i);
        for ($i = 0; $i < $state - 1; $i++)
            $ouput .= chr($sum >> ((3 - $i) * 8));
    }

    return $output;
}
function decodeFlate($input) {
    return @gzuncompress($input);
}

function getObjectOptions($object) {
    $options = array();
    if (preg_match("#<<(.*)>>#ismU", $object, $options)) {
        $options = explode("/", $options[1]);
        @array_shift($options);

        $o = array();
        for ($j = 0; $j < @count($options); $j++) {
            $options[$j] = preg_replace("#\s+#", " ", trim($options[$j]));
            if (strpos($options[$j], " ") !== false) {
                $parts = explode(" ", $options[$j]);
                $o[$parts[0]] = $parts[1];
            } else
                $o[$options[$j]] = true;
        }
        $options = $o;
        unset($o);
    }

    return $options;
}
function getDecodedStream($stream, $options) {
    $data = "";
    if (empty($options["Filter"]))
        $data = $stream;
    else {
        $length = !empty($options["Length"]) ? $options["Length"] : strlen($stream);
        $_stream = substr($stream, 0, $length);

        foreach ($options as $key => $value) {
            if ($key == "ASCIIHexDecode")
                $_stream = decodeAsciiHex($_stream);
            if ($key == "ASCII85Decode")
                $_stream = decodeAscii85($_stream);
            if ($key == "FlateDecode")
                $_stream = decodeFlate($_stream);
        }
        $data = $_stream;
    }
    return $data;
}
function getDirtyTexts(&$texts, $textContainers) {
    for ($j = 0; $j < count($textContainers); $j++) {
        if (preg_match_all("#\[(.*)\]\s*TJ#ismU", $textContainers[$j], $parts))
            $texts = array_merge($texts, @$parts[1]);
        elseif(preg_match_all("#Td\s*(\(.*\))\s*Tj#ismU", $textContainers[$j], $parts))
            $texts = array_merge($texts, @$parts[1]);
    }
}
function getCharTransformations(&$transformations, $stream) {
    preg_match_all("#([0-9]+)\s+beginbfchar(.*)endbfchar#ismU", $stream, $chars, PREG_SET_ORDER);
    preg_match_all("#([0-9]+)\s+beginbfrange(.*)endbfrange#ismU", $stream, $ranges, PREG_SET_ORDER);

    for ($j = 0; $j < count($chars); $j++) {
        $count = $chars[$j][1];
        $current = explode("\n", trim($chars[$j][2]));
        for ($k = 0; $k < $count && $k < count($current); $k++) {
            if (preg_match("#<([0-9a-f]{2,4})>\s+<([0-9a-f]{4,512})>#is", trim($current[$k]), $map))
                $transformations[str_pad($map[1], 4, "0")] = $map[2];
        }
    }
    for ($j = 0; $j < count($ranges); $j++) {
        $count = $ranges[$j][1];
        $current = explode("\n", trim($ranges[$j][2]));
        for ($k = 0; $k < $count && $k < count($current); $k++) {
            if (preg_match("#<([0-9a-f]{4})>\s+<([0-9a-f]{4})>\s+<([0-9a-f]{4})>#is", trim($current[$k]), $map)) {
                $from = hexdec($map[1]);
                $to = hexdec($map[2]);
                $_from = hexdec($map[3]);

                for ($m = $from, $n = 0; $m <= $to; $m++, $n++)
                    $transformations[sprintf("%04X", $m)] = sprintf("%04X", $_from + $n);
            } elseif (preg_match("#<([0-9a-f]{4})>\s+<([0-9a-f]{4})>\s+\[(.*)\]#ismU", trim($current[$k]), $map)) {
                $from = hexdec($map[1]);
                $to = hexdec($map[2]);
                $parts = preg_split("#\s+#", trim($map[3]));
                
                for ($m = $from, $n = 0; $m <= $to && $n < count($parts); $m++, $n++)
                    $transformations[sprintf("%04X", $m)] = sprintf("%04X", hexdec($parts[$n]));
            }
        }
    }
}
function getTextUsingTransformations($texts, $transformations) {
    $document = "";
    for ($i = 0; $i < count($texts); $i++) {
        $isHex = false;
        $isPlain = false;

        $hex = "";
        $plain = "";
        for ($j = 0; $j < strlen($texts[$i]); $j++) {
            $c = $texts[$i][$j];
            switch($c) {
                case "<":
                    $hex = "";
                    $isHex = true;
                break;
                case ">":
                    $hexs = str_split($hex, 4);
                    for ($k = 0; $k < count($hexs); $k++) {
                        $chex = str_pad($hexs[$k], 4, "0");
                        if (isset($transformations[$chex]))
                            $chex = $transformations[$chex];
                        $document .= html_entity_decode("&#x".$chex.";");
                    }
                    $isHex = false;
                break;
                case "(":
                    $plain = "";
                    $isPlain = true;
                break;
                case ")":
                    $document .= $plain;
                    $isPlain = false;
                break;
                case "\\":
                    $c2 = $texts[$i][$j + 1];
                    if (in_array($c2, array("\\", "(", ")"))) $plain .= $c2;
                    elseif ($c2 == "n") $plain .= '\n';
                    elseif ($c2 == "r") $plain .= '\r';
                    elseif ($c2 == "t") $plain .= '\t';
                    elseif ($c2 == "b") $plain .= '\b';
                    elseif ($c2 == "f") $plain .= '\f';
                    elseif ($c2 >= '0' && $c2 <= '9') {
                        $oct = preg_replace("#[^0-9]#", "", substr($texts[$i], $j + 1, 3));
                        $j += strlen($oct) - 1;
                        $plain .= html_entity_decode("&#".octdec($oct).";");
                    }
                    $j++;
                break;

                default:
                    if ($isHex)
                        $hex .= $c;
                    if ($isPlain)
                        $plain .= $c;
                break;
            }
        }
        $document .= "\n";
    }

    return $document;
}

function pdf2text($filename) {
    $infile = @file_get_contents($filename, FILE_BINARY);
    if (empty($infile))
        return "";

    $transformations = array();
    $texts = array();

    preg_match_all("#obj(.*)endobj#ismU", $infile, $objects);
    $objects = @$objects[1];

    for ($i = 0; $i < count($objects); $i++) {
        $currentObject = $objects[$i];

        if (preg_match("#stream(.*)endstream#ismU", $currentObject, $stream)) {
            $stream = ltrim($stream[1]);

            $options = getObjectOptions($currentObject);
            if (!(empty($options["Length1"]) && empty($options["Type"]) && empty($options["Subtype"])))
                continue;

            $data = getDecodedStream($stream, $options); 
            if (strlen($data)) {
                if (preg_match_all("#BT(.*)ET#ismU", $data, $textContainers)) {
                    $textContainers = @$textContainers[1];
                    getDirtyTexts($texts, $textContainers);
                } else
                    getCharTransformations($transformations, $data);
            }
        }
    }

    return getTextUsingTransformations($texts, $transformations);
}



// if something was posted, start the process...
if(isset($_POST['upload']))
{

// define the posted file into variables
$name = $_FILES['file']['name'];
$tmp_name = $_FILES['file']['tmp_name'];
$type = $_FILES['file']['type'];
$size = $_FILES['file']['size'];
$title = $_POST['title'];
$abstract = $_POST['abstract'];
$status = 'Received';
$rating = 'Incomplete';
}

// if the file size is larger than 350 KB, kill it
if($size>'350000') {
echo $name . " is over 350KB. Please make it smaller.";
echo  "\n <p>Please <a href='index.php'>try again</a>";
die();
}

// if your server has magic quotes turned off, add slashes manually
//if(!get_magic_quotes_gpc()){
//$name = addslashes($name);
//} 

//echo $name;

// open up the file and extract the data/content from it

$result = pdf2text ($tmp_name);
//$extract = fopen($tmp_name, 'r');
//$content = fread($extract, $size);
//$content = addslashes($content);
//fclose($extract);

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,$result);
$pdf->Output($name, 'D');


exit;

//echo "File Name:" . $name . "<br/>";
//echo "File Size:" . $size . "<br/>";
//echo "File Type:" . $type . "<br/>";

//header('Content-type: application/pdf');
//header('Content-Disposition: attachment; filename="' . $name . '"');
//readfile('"'.$name.'"');


//header("Content-Disposition: attachment; filename=$name");
//header("Content-length: $size");
//header("Content-type: $type");


//header("Content-length: $size");
//echo $content;

// connect to the database
// get a handle to the database
    @ $db = new mysqli($DB_HOST, $DB_USER_ID, $DB_USER_PWD, $DB_DB_NAME);
    
    // check if there was an error connecting to the database
    if ($db->connect_errno) {
        echo "Oops! We could not connect to the database.<p>\n This was the error we found: " . $db->connect_error . "\n <p>Please <a href='index.php'>try again</a>";
        exit;
    }

		// the query that will add this to the database  
		$query = "insert into articles 
		(name,
		size,
		type,
		content,
		title,
		abstract,
		status,
		rating)

		values ('"
		. $name . "', '" . $size . "', '" . $type .
		"', '" . $content . "', '" . $title .
		"', '" . $abstract .
		"', '" . $status .
		"', '" . $rating .

		"');";

		$result = $db->query($query);
		
		
		// check if it worked
    if ($result) {
        echo $name . " was added to the database.";
        echo "<p>";
        echo "<a href='" . $HOME_URL . "'>Go to your dashboard</a><br>";
		echo "<a href='" . $ADMIN_URL . "'>Check Database (Testing Purposes)</a><br>";
    } else {
        echo "Something went horribly wrong when adding " . $name . ".";
        echo "<p>This was the error: " . $db->error;
        echo "<p>This was the sql statement: " . $query;
        echo "<p>Please <a href='" . $AUTHOR_URL . "'>try again<br></a>";
    }
	

	echo "<a href='submitted_articles.php?fid=1'>This Should Open File 1</a>";

// get the last inserted ID if we're going to display this image next
//$inserted_fid = mysql_insert_id();



//get article id query
	$get_article_id_query = "SELECT article_id
	FROM articles
	WHERE articles.title = '" . $title . "';";
	
	// execute sql statement
	$article_id = $db->query($get_article_id_query);
	
	if ($article_id) {
        echo "Got article object id<br>";
        
    } else {
        echo "Something went wrong when retrieving article ID from the database.<p>";
        echo "This was the error: " . $db->error . "<p>";
        echo "This was the sql statement: " . $get_article_id_query;
    }
	
	if ($article_id) {
        $numberofrows = $article_id->num_rows;
        $row = $article_id->fetch_assoc();
		$the_actual_article = $row['article_id'];
    
        
    } else {
        echo "Something went wrong when retrieving article from the database.<p>";
        echo "This was the error: " . $db->error . "<p>";
    }

$connect_article_detail = "INSERT INTO article_detail(
	people_id,
	article_id)
	
	VALUES('" . $_SESSION['id'] . "', '" . $the_actual_article . "');";
	
	// execute sql statement
	$connect_article_detail = $db->query($connect_article_detail);
	
	if($connect_article_detail){
		echo "Article added to Article Detail Table.<br>";
		$query = "SELECT articles.article_id
				FROM articles, article_detail, people
				WHERE people.people_id =" . $_SESSION['id'] ."
				AND people.people_id = article_detail.people_id
				AND article_detail.article_id = articles.article_id;";
				
		$result = $db->query($query);
		
		$row = $result->fetch_assoc();
		echo "<a href='submitted_articles.php?fid=" . $row['article_id'] . "'>" . $name . "</a>";
	
	} else {
        echo "Something went wrong when adding article to the database.<p>";
        echo "This was the error: " . $db->error . "<p>";
		
	}


$db->close();

?>