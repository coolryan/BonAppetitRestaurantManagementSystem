<!--
Filename: view_reservation.php
Author: Ryan Setaruddin
BCS 350- Web Database Developement
Professor Kaplan
Date: November 26, 2022
Purpose: To view the listed reservations by owners/managers
-->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>View Reservation Page</title>
	<style type="text/css"><?php include 'CSS/Main.css';?></style>
</head>
<body>
    <div id="content">
	<?php
        // AT TOP
        require_once("Header.php");
        require_once("utils.php");
        checkAndStartSession();

        // To make sure editing is allowed in reservation_Table page:
        $allow_editing = True;
        require_once("reservation_table.php");
        require_once("Footer.php");
    ?>
    </div>
</body>
</html>