<?php session_start() ?>

<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="jQuery.mmenu-master/dist/js/jquery.mmenu.min.all.js"></script>
<link href="jQuery.mmenu-master/dist/css/jquery.mmenu.all.css" type="text/css" rel="stylesheet" />
<link href="main-stylesheet.css" type="text/css" rel="stylesheet" />
<script type="text/javascript">
			$(function() {
				$("nav#my-menu").mmenu();
			});
		</script>
<style>
    .contact-form{
        margin-bottom:100px;
    }
</style>

<body>
<div>
<div class="wrapper mobile">
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
        <div class="main-content"> 
        <h1 id="main-title-top" class="main-title">Meet The Wizard</h1>
        <img class="main-content-image" src="images/profile-picture.png">
        <p class="contact-me-name">Jamel Lawson</p>
        <p class="contact-me-job-title">Web Developer & Software Engineer</p>
        <hr/>
        <h1 class="main-title">Contact Me</h1>
        <p class="contact-me-job-title">I am ready to work with you.</p>
        
        
        
        
        <form class="contact-form" action="mailjamel.php" method="POST">
            <input class="contact-entry" type="text" name="sender" placeholder="Your Name">
            <br/>
            <input class="contact-entry" type="email" name="email" placeholder="Your Email">
            <br/>
            <input class="contact-entry" type="text" name="subject" placeholder="Subject">
            <br/>
            <textarea name="message" placeholder="Your Message"></textarea>
            <br/>
            <button type="submit" value="Submit" class="submit-button">SEND</button>
        
        </form>
        </div><!--End of Main Content-->
        <div class="header"></div>
    </div><!--End of Placeholder-->
</div><!--End of Wrapper-->

<div class="wrapper tablet">
        <div class="banner">
        	<img class="banner-image" src="../images/images/banner-tablet-view.png"/>
            <nav>
            	<ul>
                	<li><a href="index.html">Intro</a></li>
                    <li><a href="skills.html">Skills</a></li>
                    <li><a href="education.html">Education</a></li>
                    <li><a href="experience.html">Experience</a></li>
                    <li><a href="contact-me.php">Contact</a></li>
                </ul>
            </nav>
        </div>
        
        <div class="main-content contact-tablet">
        	<h1>Meet The Wizard</h1>
            <img class="main-photo" src="../images/images/self-portrait-tablet_10.png"/>
            <div class="main-content-info-tablet">
 				<h1>Jamel Lawson</h1>
                <h2>Web Developer</h2>
                <h2>Web Developer & Software Engineer</h2>
                <h2>708-833-9788</h2>
                <h2>lawson.jamel@yahoo.com</h2>
            </div>
            
            <hr/>
            
            <h1>Contact Me</h1>
        	<h2>I am ready to work with you.</h2>
            
            <form class="contact-form" action="mailjamel.php" method="POST">
            <input class="contact-entry" type="text" name="sender" placeholder="Your Name">
            <br/>
            <input class="contact-entry" type="email" name="email" placeholder="Your Email">
            <br/>
            <input class="contact-entry" type="text" name="subject" placeholder="Subject">
            <br/>
            <textarea name="message" placeholder="Your Message"></textarea>
            <br/>
            <button type="submit" value="Submit" class="submit-button">SEND</button>
        
        	</form>
            
        </div><!--End of Main Content-->
        
    </div><!--End of Tablet Wrapper-->
</div>
</body>
</html>
