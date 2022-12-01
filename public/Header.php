<!--
Filename: Header.php
Author: Ryan Setaruddin
BCS 350- Web Database Developement
Professor Kaplan
Date: Oct. 11, 2022
Purpose: To create navigation bar for restaurant mangement system
-->
<!-- Create Navigation bar-->
<div class="Navbar">
	<div class="Navbar-links">
		<header>
			<a href="/Welcome.php">Home</a>
<?php
	require_once("utils.php");
	if(isLoggedIn()) {
		echo '<a href="/editmenu.php">Menu</a>';
		echo '<a href="/staff.php">Staff</a>';
		echo '<a href="">Inventory</a>';
		echo '<a href="view_reservations.php">Reservations</a>';
		echo '<a href="/Logout.php">Logout</a>';
	}
	else {
		echo '<a href="/menu.php">Menu</a>';
		echo '<a href="/reservation.php">Reservation</a>';
		echo '<a href="/restaurant_info.php">Restaurant Info</a>';
		echo '<a href="/Login.php">Login</a>';
		echo '<a href="/Registration.php">Register</a>';
	}
?>
		</header>
	</div>
</div>
