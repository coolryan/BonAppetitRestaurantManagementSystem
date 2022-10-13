<!--
Filename: Connect.php
Author: Ryan Setaruddin
BCS 350- Web Database Developement
Professor Kaplan
Date: Oct. 11, 2022
Purpose: To create database called "bonappetit" and to connect to MySQL
-->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MySQL Database Connection</title>
</head>
<body>
	<?php
		//varaiables
		$dbhost = "localhost";
		$dbroot = "root";
		$dbpass = NULL;
		$dbname = "bonappetit";  
		$conn = mysqli_connect($dbhost, $dbroot, $dbpass, $dbname);

		// To check if mysqli connection is connected
		if ($conn->connect_error) {
			die("connection failed: ". $conn->connect_error);
		}
	?>
</body>
</html>