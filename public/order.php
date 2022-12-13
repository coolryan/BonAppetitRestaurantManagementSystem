<?php
require_once($_SERVER['DOCUMENT_ROOT']."/utils.php");
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

	<script type="text/babel" src="./js/main.js" defer></script>
</head>
<body>
	<div id="content">
	<?php
		require_once($_SERVER['DOCUMENT_ROOT']."/Header.php");
	?>
	<div id="root"></div>

	<?php include_once($_SERVER['DOCUMENT_ROOT']."/Footer.php"); ?>
	</div>
</body>
</html>