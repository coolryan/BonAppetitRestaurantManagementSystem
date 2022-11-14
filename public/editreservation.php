<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Reservation Page</title>
	<link rel="stylesheet" type="text/css" href="CSS/Main.css">
</head>
<body>
	<?php  
		require_once("Header.php");
		require_once("Connect.php");
		require_once("utils.php");
		checkAndStartSession();

		if (!empty($_SESSION['name'])) {
			include_once("show_reservation.php");
		} else {
			echo "<p>This page is public only</p>";
		}
		include_once('Footer.php'); 
	?>
</body>
</html>