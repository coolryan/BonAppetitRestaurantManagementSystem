<!--
Filename: editmenu.php
Author: Ryan Setaruddin
BCS 350- Web Database Developement
Professor Kaplan
Date: November 26, 2022
Purpose: To check if the edited menu is started by the restauarant staff
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
		require_once($_SERVER['DOCUMENT_ROOT']."/Header.php");
		require_once($_SERVER['DOCUMENT_ROOT']."/Connect.php");
		require_once($_SERVER['DOCUMENT_ROOT']."/utils.php");
		checkAndStartSession();

		if (isManager() || isOwner() || isStaff()) {
			include_once($_SERVER['DOCUMENT_ROOT']."/show_menu.php");
		} else {
			echo "<p>This page is for restaurant staff only</p>";
		}
		include_once($_SERVER['DOCUMENT_ROOT']."/Footer.php"); 
		?>
	</div>
</body>
</html>