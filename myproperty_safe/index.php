<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Property Manager</title>
<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=yes'>
<link href='http://fonts.googleapis.com/css?family=Codystar' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="mobile.css">
</head>

<body>
	<div id="wrapper">
	<h1 id="mainTitle">Property Manager</h1>
    <div id="mainText">
    
    <form id="createAccount">
    <input class="information" type="text" placeholder="First Name" required/>
    <input class="information"type="text" placeholder="Last Name" required/>
    <input class="information"type="text" placeholder="Email" required/>
    <input class="information"type="text" placeholder="Password" required/>
    <input class="information"type="text" placeholder="Confirm Password" required/>
    <p id="helperText">Sign up as:</p>
    <input class="user" type="checkbox">Tenant<br>
    <input class="user" type="checkbox">Landlord
    <p id="terms">
    By clicking Sign Up, you agree to our Terms and that you
    have read our Data Use Policy, including our Cookie Use.
    </p>
    <input id="submitButton" type="submit" value="Submit"/>
    <a id="auth" href="login.php">Log In</a>
    </form>
    </div><!--End of mainText-->
    </div><!--Wrapper-->
</body>
</html>
