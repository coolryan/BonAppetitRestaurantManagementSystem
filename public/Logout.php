<!--
Filename: Logout.php
Author: Ryan Setaruddin
BCS 350- Web Database Developement
Professor Kaplan
Date: Oct. 11, 2022
Purpose: To allow the owner of Bon Appetit Paris to leave the site
-->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Logout Page</title>
</head>
<body>
	<?php  
		// verify the user is logged in
		session_start();
		if (isset($_SESSION['username']) && isset($_SESSION['userID'])) {
			// IF YOU ARE HERE THEN THE USER IS LOGGED IN, AND WE CAN LOG THEM OUT
			session_destroy();

			//redirect to the home page
			header("Location: Welcome.php");
		}
		else
			// redirect the user back to the login page
			header("Location: Login.php");
	?>
</body>
</html>