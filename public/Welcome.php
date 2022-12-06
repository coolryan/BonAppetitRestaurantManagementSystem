<!--
Filename: Welcome.php
Author: Ryan Setaruddin
BCS 350- Web Database Developement
Professor Kaplan
Date: Oct. 11, 2022
Purpose: To create a welcome page for customers
-->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home Page</title>
	<style type="text/css"><?php include 'CSS/Main.css';?></style>
</head>
<body>
	<div id="content">
		<?php
			// AT TOP
			require_once("Header.php");
			require_once("utils.php");
			checkAndStartSession();
			$logged_in = isLoggedIn();

			//include our connect
			require_once("Connect.php");
			$qry_result = mysqli_query($conn, "SELECT * FROM restaurant")->fetch_assoc();
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
			// Only if manager or admin
			$isPrivileged = isOwner() || isManager();
			if($isPrivileged) {
		?>
		<h3>Reservations</h3>
		<div class="actionbtn">
			<button>
				<a href="view_reservations.php" class="button">Edit Reservations</a>
			</button>
		</div>
		<?php
			include_once("reservation_table.php");

			?><h3>Staff Schedule</h3><a href="staff/view_schedule.php">Edit Schedules</a><?php
			include_once("staff/schedule_table.php");
		}

		include_once('Footer.php');
	?>
</div>

</body>
</html>