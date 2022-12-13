<!--
Filename: editmenu.php
Author: Ryan Setaruddin
BCS 350- Web Database Developement
Professor Kaplan
Date: November 26, 2022
Purpose: To allow staff members to edit the restaurant menu
-->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Menu Page</title>
	<link rel="stylesheet" type="text/css" href="CSS/Main.css">
</head>
<body>
	<div id="content">
		<?php
		// Display the header
		require_once($_SERVER['DOCUMENT_ROOT']."/Header.php");
		// Import some needed PHP files
		require_once($_SERVER['DOCUMENT_ROOT']."/Connect.php");
		require_once($_SERVER['DOCUMENT_ROOT']."/utils.php");
		// Start the session so we know if a user is logged in and who it is
		checkAndStartSession();

		if (isManager() || isOwner() || isStaff()) {
			// Show the menu
			include_once($_SERVER['DOCUMENT_ROOT']."/show_menu.php");
		} else {
			// Only allow logged in users to edit the menu
			echo "<p>This page is for restaurant staff only</p>";
		}
		include_once($_SERVER['DOCUMENT_ROOT']."/Footer.php"); 
		?>
	</div>
</body>
</html>