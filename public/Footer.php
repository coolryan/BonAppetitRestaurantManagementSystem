<!--
Filename: Footer.php
Author: Ryan Setaruddin
BCS 350- Web Database Developement
Professor Kaplan
Date: Oct. 11, 2022
Purpose: For side note to knowing who created this app
-->
<footer>
	<hr>
	<address>
		Web Site: <a href="index.php">BonAppetit</a><br>
		<?php
			require_once("Connect.php"); 
			$qry_result = mysqli_query($conn, "SELECT * FROM restaurant")->fetch_assoc();
			$address = $qry_result['address'];
		?>
		<p>Visit us at <?=$address?></p>
		<a href="mailto:bonappetit@example.com">bonappetit@example.com</a><br>
		<a href="tel:+1516-387-354-0925">Contact Us</a><br>
	</address>
</footer>