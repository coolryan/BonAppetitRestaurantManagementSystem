<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Staff page</title>
	<link rel="stylesheet" type="text/css" href="CSS/Main.css">
</head>
<body>
	<?php  
		// Header
		require_once("Header.php");
		require_once("utils.php");
		checkAndStartSession();
		$logged_in = isLoggedIn();

		// Connect to MySQL
		require_once("Connect.php");
	?>
	<?php
		// Footer 
		require_once("Footer.php"); 
	?>
</body>
</html>