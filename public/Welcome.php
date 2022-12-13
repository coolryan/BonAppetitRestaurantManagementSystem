<!--
Filename: Welcome.php
Author: Ryan Setaruddin
BCS 350- Web Database Developement
Professor Kaplan
Date: Oct. 11, 2022
Purpose: A welcome page for customers, or dashboard for admin/managers
-->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home Page</title>
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
			$logged_in = isLoggedIn();

			// Connect to MySQL
			require_once($_SERVER['DOCUMENT_ROOT']."/Connect.php");
			// Get all the restaurants
			$qry_result = mysqli_query($conn, "SELECT * FROM restaurant")->fetch_assoc();
			// Get the name and restaurant id for the first restaurant. Currently we only support one.
			$restaurantName = $qry_result['name'];
			$restaurantID = $qry_result['restaurant_id'];
			if($logged_in) {
		?>
		<button><a href="/restaurant_info.php/?id=<?= $restaurantID ?>">Edit Restaurant</a></button>
		<?php
			}
		?>
		<h1>Welcome To <?= $restaurantName ?></h1>
		<b><h2>Here's Our Story</h2></b>
		<p><?= $qry_result['back_story']?></p>
		<?php
			// Display the reservations and staff schedule if the user is an owner or manager
			$isPrivileged = isOwner() || isManager();
			if($isPrivileged) {
		?>
		<h3>Reservations</h3>
		<div class="actionbtn">
			<button>
				<a href="view_reservations.php" class="button">Edit Reservations</a>
			</button>
		</div>
		<br>
		<?php
			// Pull in the reservation table
			include_once($_SERVER['DOCUMENT_ROOT']."/reservation_table.php");

		?>
		<h3>Staff Schedule</h3>
		<div class="actionbtn">
			<button>
				<a href="staff/view_schedule.php">Edit Schedules</a>
			</button>
		</div>
		<br>
		<?php
			// Pull in the staff schedule
			include_once($_SERVER['DOCUMENT_ROOT']."/staff/schedule_table.php");
		}
		// Display the food=ter
		include_once($_SERVER['DOCUMENT_ROOT']."/Footer.php");
		?>
	</div>
</body>
</html>