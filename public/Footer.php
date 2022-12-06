<!--
Filename: Footer.php
Author: Ryan Setaruddin
BCS 350- Web Database Developement
Professor Kaplan
Date: Oct. 11, 2022
Purpose: For side note to knowing who created this app
-->
<footer>
	<img src="images/icons/restaurant_logo.png" alt="restaurant_logo">
	<hr>
	<address>
		<?php
			require_once("Connect.php"); 
			$qry_result = mysqli_query($conn, "SELECT * FROM restaurant")->fetch_assoc();
			$address = $qry_result['address'];
		?>
		<p>Visit us at:</p><p><?= $address ?></p>
		<div>Email us at <a href="mailto:bonappetit@example.com">bonappetit@example.com</a></div><br>
		<div>Call us at <a href="tel:+1516-387-354-0925">516-387-354-0925</a></div><br>
	</address>
</footer>