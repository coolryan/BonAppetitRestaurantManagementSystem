<?php
// Filename: Connect.php
// Author: Ryan Setaruddin
// BCS 350- Web Database Developement
// Professor Kaplan
// Date: Oct. 11, 2022
// Purpose: To create database called "bonappetit" and to connect to MySQL

	// MySQL Connection details
	$dbhost = "localhost";
	$dbuser = "bonappetit";
	$dbpass = "bonappetit";
	$dbname = "bonappetit";  
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	// To check if mysqli connection is connected
	if ($conn->connect_error) {
		die("connection failed: ". $conn->connect_error);
	}
?>