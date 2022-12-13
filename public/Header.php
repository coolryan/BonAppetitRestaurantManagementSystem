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
			<a href="/Welcome.php"><img src="images/icons/home.png" alt="Home"/>Home</a>
<?php
	require_once("utils.php");
	checkAndStartSession();
	if(isLoggedIn()) {
		echo '<a href="/staff/view_schedule.php">Schedule</a>';

		if(isOwner() or isManager()) {
			echo '<a href="/staff.php"><img src="images/icons/restaurant_staff.png" alt="R_staff"/>Staff</a>';
			echo '<a href="view_reservations.php"><img src="images/icons/reservation.png" alt="Reserve"/>Reservations</a>';
			echo '<a href="/editmenu.php"><img src="images/icons/restaurant_menu.png" alt="R_menu"/>Menu</a>';
		} else if(isOwner()) {
			echo '<a href="/restaurant_info.php"><img src="images/icons/restaurant_info.png" alt="r_info"/>Restaurant Info</a>';	
		}
		
		// Any logged in user
		// echo '<a href="">Inventory</a>';
		echo '<a href="/Logout.php"><img src="images/icons/logout.png" alt="logout"/>Logout</a>';

	}
	else {
		echo '<a href="/menu.php"><img src="images/icons/restaurant_menu.png" alt="R_menu"/>Menu</a>';
		echo '<a href="/reservation.php"><img src="images/icons/reservation.png" alt="Reserve"/>Reservation</a>';
		echo '<a href="/Login.php"><img src="images/icons/login.png" alt="Login"/>Login</a>';
		echo '<a href="/Registration.php"><img src="images/icons/register.png" alt="register"/>Register</a>';
	}
?>
		</header>
	</div>
</div>