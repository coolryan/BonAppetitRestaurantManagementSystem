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
                <th>Party Size</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
    <?php 
        foreach($qry_result as $reservation_item)  {
            $edit_link = "/reservation.php/?item={$reservation_item['reservation_id']}";
            $date_time = "{$reservation_item['reservation_date']} {$reservation_item['reservation_time']}"; 
    ?>
        <!-- <div class="reservationItem">
            <div class="reservationDate">
                <label for="reservationDate">Date:</label>
                <?= $date_time ?>
            </div>
            <div class="reservationParty_size">
                <label for="party_size">Party Size:</label>
                <?= $reservation_item["party_size"]; ?>
            </div>
            <div class="reservationName">
                <label for="name">Name:</label>
                <?= $reservation_item["name"]; ?>
                </div>
            <div class="reservationEmail">
                <label for="email">Email:</label>
                <?= $reservation_item["email"]; ?>
            </div>
            <div class="reservationPhone">
                <label for="phone">Phone:</label>
                <?= $reservation_item["phone"]; ?>
            </div>
        </div> -->

        <tr>
            <td><?= $reservation_item['reservation_date'] ?></td>
            <td><?= $reservation_item['reservation_time'] ?></td>
            <td><?= $reservation_item['party_size'] ?></td>
            <td><?= $reservation_item['name'] ?></td>
            <td><?= $reservation_item['email'] ?></td>
            <td><?= $reservation_item['phone'] ?></td>
            <td><a href='<?= $edit_link ?>'>Edit</a></td>
        </tr>
    <?php } ?>
    </table>
    <?php require_once("Footer.php");?>
</body>
</html>