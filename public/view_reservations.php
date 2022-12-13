<!--
Filename: view_reservation.php
Author: Ryan Setaruddin
BCS 350- Web Database Developement
Professor Kaplan
Date: November 26, 2022
Purpose: For owners/managers to view the listed reservations and possibly make edits
-->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>View Reservation Page</title>
	<link rel="stylesheet" type="text/css" href="CSS/Main.css">
</head>
<body>
    <div id="content">
	<?php
        // Display the header
        require_once($_SERVER['DOCUMENT_ROOT']."/Header.php");
        // Import some needed PHP files
        require_once($_SERVER['DOCUMENT_ROOT']."/utils.php");
        // Start the session so we know if a user is logged in and who it is
        checkAndStartSession();

        // To make sure editing is allowed in reservation_Table page:
        $allow_editing = True;
        // Bring in the reservation table page
        require_once("reservation_table.php");
        // Display the footer
        require_once($_SERVER['DOCUMENT_ROOT']."/Footer.php");
    ?>
    </div>
</body>
</html>