<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Order</title>
	<style type="text/css"><?php include 'CSS/Main.css';?></style>

	<!-- Get React library and necessary libraries via CDN -->
	<script src="https://unpkg.com/react@17/umd/react.development.js"></script>
	<script src="https://unpkg.com/react-dom@17/umd/react-dom.development.js"></script>
	<script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>

	<script type="text/babel" src="./js/main.js" defer></script>
</head>
<body>
	<?php
		require_once("Header.php");
	?>
	<div id="root"></div>

	<?php include_once('Footer.php'); ?>
</body>
</html>