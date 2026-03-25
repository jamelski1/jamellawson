<?php
$headers = "From: " . strip_tags($_POST['req-email']) . "\r\n";
$headers .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n";
$headers .= "CC: susan@example.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$email = file_get_contents('http://www.jamellawson.com/mail_test/EmailNew.html');

mail("lawson.jamel@yahoo.com", "Hello", $email, $headers);

?>