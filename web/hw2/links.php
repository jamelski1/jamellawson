<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd"
    >
<html lang="en">
<head>
    <title>Links</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <meta http-equiv="refresh" content="30">
</head>
<body>
    
    <?php include 'header.php'; ?>
    
    <!--Title of Page-->
    <h2>
        Links
    </h2>
    
    <!--Navigation Bar-->
    <ul>
        <div class="header">
        <?php include 'navigation.php'?>
        </div>
    </ul>
    <?php
    echo $_SERVER['REMOTE_ADDR']
    ?>
    
    </br>
    
    <!--Content-->
    <img src="Jean_Nouvel_Building.jpg" alt="Jean Nouvel">
        
    <p>
        <ul>
            <li><a href="http://www.jeannouvel.com/">Visit Jean Nouvel's personal website</a></li></br>
            <li><a href="http://architecture.about.com/od/findphotos/ig/Jean-Nouvel/">Learn more about Jean Nouvel</a></li></br>
            <li><a href="http://en.wikipedia.org/wiki/Jean_Nouvel">Visit Jean Nouvel wikipedia</a></li></br>
            <li><a href="http://www.nytimes.com/2008/03/31/arts/design/31prit.html?hp&_r=0">Jean Nouvel New York Times</a></li></br>
        </ul>
    </p>
    
    <!--Footer-->
    <div class="footer">
        <?php include 'footer.php'; ?>
    </div>
</body>
</html>