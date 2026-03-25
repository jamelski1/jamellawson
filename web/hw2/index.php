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
        Homepage
    </h2>
    <!--Navigation Bar-->
    <ul>
        <div class="header"
    <?php include 'navigation.php'?>
        </div>
    </ul>
    </br>
    <?php
 $date=date_create(null,timezone_open("America/Chicago"));
 echo date_format($date,"Y-m-d H:i:s");
?>
    </br>
    
    <!--Conent-->
    <img src="Jean_Nouvel_Light.jpg" alt="Jean Nouvel">
        
    <p>
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
        sed diam nonummy nibh euismod tincidunt ut laoreet dolore
        magna aliquam erat volutpat. Ut wisi enim ad minim veniam,
        quis nostrud exerci tation ullamcorper suscipit lobortis
        nisl ut aliquip ex ea commodo consequat. Duis autem vel
        eum iriure dolor in hendrerit in vulputate velit esse
        molestie consequat, vel illum dolore eu feugiat nulla
        facilisis at vero eros et accumsan et iusto odio dignissim
        qui blandit praesent luptatum zzril delenit augue duis
        dolore te feugait nulla facilisi. Nam liber tempor cum
        soluta nobis eleifend option congue nihil imperdiet doming
        id quod mazim placerat facer possim assum. Typi non habent
        claritatem insitam; est usus legentis in iis qui facit eorum
        claritatem. Investigationes demonstraverunt lectores legere
        me lius quod ii legunt saepius.
    </p>
    
    <!--Footer-->
    <div class="footer">
        <?php include 'footer.php'; ?>
    </div>
</body>
</html>