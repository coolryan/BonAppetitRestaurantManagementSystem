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
	<link rel="stylesheet" type="text/css" href="CSS/Main.css">
</head>
<body>
	<?php  
		// Header
		require_once("Header.php");
		require_once("utils.php");
		checkAndStartSession();
		$logged_in = isLoggedIn();

        // Todo: if not owner/mangaer can exit
        $allowed = isOwner() || isManager();

        if(!$allowed) {
            echo "You shouldn't be here!";
            include_once('Footer.php');
            exit();
        }

		// Connect to MySQL
		require_once("Connect.php");

        $qry_result = mysqli_query($conn, "SELECT * FROM reservation_table ORDER BY reservation_date, reservation_time DESC")->fetch_all(MYSQLI_ASSOC);
    ?>
        <table>
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Table</th>
                <th>Party Size</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
    <?php 
        foreach($qry_result as $reservation_item)  {
            $edit_link = "/reservation.php?reservation_id={$reservation_item['reservation_id']}";
            $date_time = "{$reservation_item['reservation_date']} {$reservation_item['reservation_time']}"; 
    ?>

        <tr>
            <td><?= $reservation_item['reservation_date'] ?></td>
            <td><?= $reservation_item['reservation_time'] ?></td>
            <td><?= $reservation_item['table_id'] ?></td>
            <td><?= $reservation_item['party_size'] ?></td>
            <td><?= $reservation_item['patron_name'] ?></td>
            <td><?= $reservation_item['patron_email'] ?></td>
            <td><?= $reservation_item['patron_phone'] ?></td>
            <td><a href='<?= $edit_link ?>'>Edit</a></td>
        </tr>
    <?php } ?>
    </table>
    <?php require_once("Footer.php");?>
</body>
</html>