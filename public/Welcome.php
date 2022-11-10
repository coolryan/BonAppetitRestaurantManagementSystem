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
	<?php
		// AT TOP
		require_once("Header.php");
		require_once("utils.php");
		checkAndStartSession();
		$logged_in = isLoggedIn();

		//include our connect
		require_once("Connect.php");
		$qry_result = mysqli_query($conn, "SELECT * FROM restaurant")->fetch_assoc();
		$restaurantName = $qry_result['name'];
	?>
	<h1>Welcome To <?= $restaurantName ?></h1>
	<?php
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
		// 	$query = mysqli_query($conn, "SELECT * FROM user WHERE id="{$_SESSION['userID']}"");
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
	?>
	<b><h2>Our Story</h2></b>
	<b><p>
		Ted and James Bradley were born and raised in New York City, NY.<br>
		In early 1920's, they open the Bon Appetit Paris restaruarnt in small town of Glen Cove, NY.<br>
		They always holding to tehir true motto "The Best Food, The Best Restaurant,".<br>
		Many people loved so that they decide about it to their friends and family. Unforuntely,
		over the course of years since 1920's, they were grow tire the orginal location and decide to open up newer and better version the restaurant; but then the popularity went down due to the great depression.<br>
		The orginal owners got sick and malnurshed during at teh time and they decesse and the restuarnt was closed for long time.<br>
		After many years had pass. Unknown new oweners some how gain the opportunity in 21th century and decide to create website
		about this restaurant and had modern day touches to it.
	</p></b>
	<?php 
	//AT BOTTOM
		include_once('Footer.php');
	?>
</body>
</html>