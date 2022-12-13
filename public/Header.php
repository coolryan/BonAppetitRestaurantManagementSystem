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
			<a href="/Welcome.php"><img src="/images/icons/home.png" alt="Home"/>Home</a>
<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/utils.php");
	// Start the session so we know if a user is logged in and who it is
	checkAndStartSession();
	// The navigation bar will change depending on whether the user is logged in or not, and if they are logged in, what user role they have
	if(isLoggedIn()) {
		// Image from https://www.istockphoto.com/illustrations/book-a-meeting-icon
		// License: https://www.istockphoto.com/legal/license-agreement?utm_medium=organic&utm_source=google&utm_campaign=iptcurl
		echo '<a href="/staff/view_schedule.php"><img src="/images/icons/staff_schedule.jpeg" alt="order"/>Schedule</a>';

		// Image from https://iconscout.com/icon/shopping-1424 License https://creativecommons.org/licenses/by-sa/3.0/
		echo '<a href="/order.php"><img src="/images/icons/take_order.png" alt="order"/>Order</a>';
		// Image from https://creativecommons.org/licenses/by/3.0/
		// License https://iconscout.com/icon/checklist-384
		echo '<a href="/view_orders.php"><img src="/images/icons/food_orders.webp" alt="order"/>Existing Orders</a>';

		if(isOwner() or isManager()) {
			echo '<a href="/staff.php"><img src="/images/icons/restaurant_staff.png" alt="R_staff"/>Staff</a>';
			echo '<a href="/view_reservations.php"><img src="/images/icons/reservation.png" alt="Reserve"/>Reservations</a>';
			echo '<a href="/editmenu.php"><img src="/images/icons/restaurant_menu.png" alt="R_menu"/>Menu</a>';
		} else if(isOwner()) {
			echo '<a href="/restaurant_info.php"><img src="/images/icons/restaurant_info.png" alt="r_info"/>Restaurant Info</a>';	
		}
		
		// Any logged in user
		echo '<a href="/Logout.php"><img src="/images/icons/logout.png" alt="logout"/>Logout</a>';

	}
	else {
		echo '<a href="/menu.php"><img src="/images/icons/restaurant_menu.png" alt="R_menu"/>Menu</a>';
		// Image from https://iconscout.com/icon/shopping-1424 License https://creativecommons.org/licenses/by-sa/3.0/
		echo '<a href="/order.php"><img src="/images/icons/shop_order.png" alt="order"/>Order</a>';
		echo '<a href="/reservation.php"><img src="/images/icons/reservation.png" alt="Reserve"/>Reservation</a>';
		echo '<a href="/Login.php"><img src="/images/icons/login.png" alt="Login"/>Login</a>';
		echo '<a href="/Registration.php"><img src="/images/icons/register.png" alt="register"/>Register</a>';

	}
?>
		</header>
	</div>
</div>