<!--
Filename: Welcome.php
Author: Ryan Setaruddin
BCS 350- Web Database Developement
Professor Kaplan
Date: Oct. 11, 2022
Purpose: To create a welcome homepage for Bon Appetit Paris restaurant management system
-->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home Page</title>
	<link rel="stylesheet" type="text/css" href="CSS/Main.css">
</head>
<body>
	<h1>Welcome To Bon Appetit Paris</h1>
	<?php
		// AT TOP
		require_once("Header.php");
		require_once("utils.php");
		$logged_in = isLoggedIn();

		//include our connect
		// require_once("Connect.php")

		// // display the user aware navigation links
		// if ($LOGGED_IN == true) {
		// 	echo "<a href='Logout.php'>Logout</a>";
		// }
		// else {
		// 	echo "<a href='Registeration.php'>Register</a> | ";
		// 	echo "<a href='Login.php'>Login</a>";
		// }

		// if ($LOGGED_IN == true) {
		// 	echo 'Hello '.$_SESSION['username'].', how are you today?<br><br>';

		// 	// get the user's account information from the database
		// 	$query = mysqli_query($conn, "SELECT * FROM users WHERE id="{$_SESSION['userID']}"");
		// 	if (mysqli_num_rows($query) == 1) {
		// 		$_USER = mysqli_fetch_assoc($query);

		// 		echo 'Your account was created on: <u>'.date("M d, Y", $_USER['date_created']).'</u><br/><br/>';
		// 		echo 'You last logged in at <i>'.date("g:i A (T)", $_USER['last_login']).'</i> on <i>'.date("M d, Y", $_USER['last_login']).'</i><br/>';
		// 	}
		// 	else
		// 		echo "Unable to load your account information. Please logout and log back in.";
		// }
		// else
		// 	echo "Please login to your account to see some super cool stuff!";

		//AT BOTTOM
		include_once('Footer.php');
	?>
</body>
</html>