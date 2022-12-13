<?php

// Filename: order.php
// Author: Ryan Setaruddin
// BCS 350- Web Database Developement
// Professor Kaplan
// Date: December 09, 2022
// Purpose: This page is a ReactJS page that allows guests to order online and for waiters to take orders at tables.

// Import some needed PHP files
require_once($_SERVER['DOCUMENT_ROOT']."/utils.php");

// Start the session so we know if a user is logged in and who it is
checkAndStartSession();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Order</title>
	<link rel="stylesheet" type="text/css" href="CSS/Main.css">

	<!-- Get React library and necessary libraries via CDN -->
	<script src="https://unpkg.com/react@17/umd/react.development.js"></script>
	<script src="https://unpkg.com/react-dom@17/umd/react-dom.development.js"></script>
	<script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>

	<!-- This is the file with our React order components -->
	<script type="text/babel" src="./js/main.js" defer></script>
</head>
<body>
	<div id="content">
	<?php
		require_once($_SERVER['DOCUMENT_ROOT']."/Header.php");
	?>
	<!-- This is where React will insert itself -->
	<div id="root"></div>

	<?php include_once($_SERVER['DOCUMENT_ROOT']."/Footer.php"); ?>
	</div>
</body>
</html>