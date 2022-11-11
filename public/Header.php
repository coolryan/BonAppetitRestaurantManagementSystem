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
			<a href="">Inventory</a>
			<a href="">Staff</a>
			<a href="">Reservation/Schedule</a>
<?php
	require_once("utils.php");
	if(isLoggedIn()) {
		echo '<a href="/Logout.php">Logout</a>';
		echo '<a href="/editmenu.php">Menu</a>';
	}
	else {
		echo '<a href="/menu.php">Menu</a>';
		echo '<a href="/Login.php">Login</a>';
		echo '<a href="/Registration.php">Register</a>';
		echo '<a href="/restaurant_info.php">Restaurant Info</a>';
	}
?>
		</header>
	</div>
</div>
