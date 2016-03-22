
<!DOCTYPE HTML>  
<html>
	<!-- Logout Page edited with timer and design by Victor Jereza -->
<head> 
    <meta name="author" content="Mongolian Horde" /> 
	<meta http-equiv="Refresh" content="2.25; URL=login.html">
 	<link href="style.css" rel="stylesheet" type="text/css" /> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<link rel="shortcut icon" href="images/golfBallLogo.ico">


 <title>FBBC Fantasy Golf</title> 
	
	<!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/logout.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	
</head> 
<body> 
<div class="centralBox">
	<img class="centralLogo" src="images/golfBallLogo.jpg" alt="Our Logo"/>
	<div class="test_republic_text">Fantasy Golf</div>
	
	<br /><br />
		<h1 align="center" class="thx_text">Thank you for using FBBC fantasy golf!</h1>
	
	
<div class="progress">
		<div class="progress-bar progress-bar-striped active" role="progressbar"
			aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:100%; height:50px" > Redirecting to Login Page..
		</div>
	</div>
</div>

<?php
	// Code to logout of the current page whether the user
	// be student or teacher
	// Author: David Hughen
	// Date:   2/11/2015
	session_start();
	$_SESSION = array();
	session_destroy();
	
	// TIMER CODE SHOULD GO HERE SOMEWHERE
?>
	    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
</body> 
</html> 



