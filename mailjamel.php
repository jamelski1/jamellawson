<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Jamel Lawson</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="jQuery.mmenu-master/dist/js/jquery.mmenu.min.all.js"></script>
<link href="jQuery.mmenu-master/dist/css/jquery.mmenu.all.css" type="text/css" rel="stylesheet" />
<link href="main-stylesheet.css" type="text/css" rel="stylesheet" />
<script type="text/javascript">
    		$(function() {
				$('nav#my-menu').mmenu();
			});
</script>
<style>
    .main-content .thank-you-message{
        text-align:center;
        font-size:33px;
    }
    
    @media and (max-width:480px){
        .main-content .thank-you-message{
            font-size:24px;
        }
    }
</style>
</head>
<body>

<div class="wrapper">
    <div class="placeholder">
        <div class="header"></div>
        <div class="banner">
        	<div class="image-box"><img class="banner-background" src="images/banner-640_02.png"></div>
            <a class="banner-menu-button" href="#my-menu"></a>
            	<nav id="my-menu">
            	<ul>
                	<li><a href="index.html">Home</a></li>
                    <li><a href="skills.html">Skills</a></li>
                    <li><a href="education.html">Education</a></li>
                    <li><a href="experience.html">Experience</a></li>
                    <li><a href="contact-me.php">Contact Me</a></li>
               </ul>
               </nav>
        </div><!--End of Banner-->
    <div class="main-content" id="education-content"> 

        <?php $name=$_POST['sender'];
              $email=$_POST['email'];
              $message=$_POST['message'];
             
        
            if (isset($_REQUEST['message']))
            //if "email" is filled out, send email
              {
              //send email
              $from = 'jamel@nrhworks.com' ; 
              $toemail = 'lawson.jamel@yahoo.com' ; 
              $subject = $_REQUEST['subject'] ;
              $message = $_REQUEST['message'] ;
              mail( "$toemail", "Subject: $subject",
              $message . " " . $name . " " . $email , "From: $from" );
              echo "<p class='thank-you-message'>Thank you for your message, " . $name . ".</p>";
              echo "<p class='thank-you-message'>I'll get back to you at my earliest convenience.</p>";
            
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
       
   </div><!--End of Main Content-->
   <div class="header"></div>
    </div><!--End of Placeholder-->
</div><!--End of Wrapper-->
        
        
 </div><!--End of Tablet Wrapper-->
<body>
<html>