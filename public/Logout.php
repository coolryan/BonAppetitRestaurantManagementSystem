<!--
Filename: Logout.php
Author: Ryan Setaruddin
BCS 350- Web Database Developement
Professor Kaplan
Date: Oct. 11, 2022
Purpose: To allow the owner of the restaurant to log out of the site
-->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Logout Page</title>
	<link rel="stylesheet" type="text/css" href="CSS/Main.css">
</head>
<body>
<div id="content">
	<?php  
		require_once($_SERVER['DOCUMENT_ROOT']."/utils.php");
		// Start the session so we know if a user is logged in and who it is
		checkAndStartSession();
		if (isset($_SESSION['email'])) {
			// IF YOU ARE HERE THEN THE USER IS LOGGED IN, AND WE CAN LOG THEM OUT
			session_destroy();

			//redirect to the welcome page
			header("Location: Welcome.php");
		}
		else
			// redirect the user back to the login page
			header("Location: Login.php");
	?>
</div>
</body>
</html>