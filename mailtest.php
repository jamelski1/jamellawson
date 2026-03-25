<html>
<body>

<?php
if (isset($_REQUEST['from']))
//if "email" is filled out, send email
  {
  //send email
  $from = $_REQUEST['from'] ; 
  $toemail = $_REQUEST['toemail'] ; 
  $subject = $_REQUEST['subject'] ;
  $message = $_REQUEST['message'] ;
  mail( "$toemail", "Subject: $subject",
  $message, "From: $from" );
  echo "The form has been submitted with the following content:<br><br>";
  echo "From: $from <br>";
  echo "To: $toemail <br>";
  echo "Subject: $subject <br>";
  echo "Message: $message; <br>";

  }
else
//if "email" is not filled out, display the form
  {
  echo "<form method='post' action='mailtest.php'>
  To: <input name='toemail' type='text' /><br />
  From: <input name='from' type='text' /><br />
  Subject: <input name='subject' type='text' /><br />
  Message:<br />
  <textarea name='message' rows='15' cols='40'>
  </textarea><br />
  <input type='submit' />
  </form>";
  }
?>

</body>
</html>