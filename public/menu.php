<!--
Filename: menu.php
Author: Ryan Setaruddin
BCS 350- Web Database Developement
Professor Kaplan
Date: November 26, 2022
Purpose: To create menu page for the customers
-->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Menu Page</title>
	<link rel="stylesheet" type="text/css" href="CSS/Main.css">
</head>
<body>
	<div id="content">
		<?php
			// Display the header
			require_once($_SERVER['DOCUMENT_ROOT']."/Header.php");
			// Import some needed PHP files
			require_once($_SERVER['DOCUMENT_ROOT']."/Connect.php");
			require_once($_SERVER['DOCUMENT_ROOT']."/utils.php");
			// Start the session so we know if a user is logged in and who it is
			checkAndStartSession();
		?>
		<h1>Menu</h1>
		<?php
			// Separate the menu items by menu category
			function getByCategory($qry_result) {
				$menu_by_cat = array();
				foreach($qry_result as $menu_item) {
					$cat = $menu_item['category'];
					if(!array_key_exists($cat, $menu_by_cat)) {
						$menu_by_cat[$cat] = array();
					}
					array_push($menu_by_cat[$cat], $menu_item);
				}
				return $menu_by_cat;
			}

			$qry_result = mysqli_query($conn, "SELECT * FROM menu_item WHERE active>0")->fetch_all(MYSQLI_ASSOC);
			// Get the menu items by category
			$menu_by_cat = getByCategory($qry_result);

			// This is the order which we want to display the menu categories
			$category_order = array("Appetizers", "Main Dishes", "Desserts");

			echo "<div id='menu'>";

		// Lets iterate over the menu by category first
		foreach($category_order as $cat) {
			$menu_items = $menu_by_cat[$cat];
			if(!array_key_exists($cat, $menu_by_cat)) {
				continue;
			}
			echo "<div class='menucategory'> <div class='categoryheading'><h4>{$cat}</h4></div>";
			// Now we will render each menu item
			foreach($menu_items as $menu_item) {
		?>
			<div class="menuItem">
				<div class="menuItemName"><?= $menu_item["name"]; ?></div>
				<div class="menuItemPrice"><?= $menu_item["price"]; ?></div>
				<div class="menuItemDescription"><?= $menu_item["description"]; ?></div>
		<?php
		// Add the image if the menu item has one
			if(!empty($menu_item["image_path"])) {
				$img = "<img class='menuItemImage' src='{$menu_item["image_path"]}'>";
				echo $img;
			}
		?>
			</div>
		<?php
			}
			echo "</div>";
		}
		echo "</div>";

			include_once($_SERVER['DOCUMENT_ROOT']."/Footer.php"); 
		?>
	</div>
</body>
</html>