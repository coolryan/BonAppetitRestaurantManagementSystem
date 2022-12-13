<!--
Filename: view_orders.php
Author: Ryan Setaruddin
BCS 350- Web Database Developement
Professor Kaplan
Date: December 13, 2022
Purpose: To view all current orders
-->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Orders page</title>
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
			$allowed = isOwner() || isManager();
			
			// Only admins or managers are allowed here
			if(!$allowed) {
				echo "You shouldn't be here!";
				include_once($_SERVER['DOCUMENT_ROOT']."/Footer.php");
				exit();
			}
			// Connect to MySQL
			require_once($_SERVER['DOCUMENT_ROOT']."/Connect.php");

		?>
		<h1>All orders</h1>
		<table id="ordersTable">
			<tr>
				<th>Date</th>
				<th>Server</th>
				<th>Table</th>
				<th>Order Id</th>
				<th>Order Item Id</th>
				<th>Order Item Name</th>
				<th>Order Instructions</th>
				<th>Price</th>
				<th>Tip</th>
			</tr>
		<?php
		// Get all the orders, along with the menu item name and price and menu item details
			$qry_result = mysqli_query($conn, "SELECT mo.id as orderId, mo.server_id, mo.restaurant_table_id, mo.in_store, mo.order_date, mo.tip, mi.id as meal_item_id, mi.instructions, menu_item.id as menu_item_id, menu_item.name, menu_item.price FROM meal_order mo LEFT JOIN meal_order_menu_item mi ON mo.id = mi.meal_order_id LEFT JOIN menu_item ON mi.menu_item_id=menu_item.id ORDER BY mo.id DESC, order_date ASC")->fetch_all(MYSQLI_ASSOC);
			foreach($qry_result as $order_item)	{
				$in_store = $order_item['in_store'] == 1 ? true : false;
				// If an online order, server and table will be null, so check the in_store variable
				$server_id = $in_store ? $order_item['server_id'] : "Online Order";
				$table_id =  $in_store ? $order_item['restaurant_table_id'] : "Online Order";
				$menu_item_id = $order_item['menu_item_id'];
				$item_name = $order_item['name'];
				$order_item['instructions']
		?>
			<tr>
				<td><?= $order_item['order_date'] ?></td>
				<td><?= $server_id ?></td>
				<td><?= $table_id ?></td>
				<td><?= $order_item['orderId'] ?></td>
				<td><?= $menu_item_id ?></td>
				<td><?= $item_name ?></td>
				<td><?= $order_item['instructions'] ?></td>
				<td><?= $order_item['price'] ?></td>
				<td><?= $order_item['tip'] ?></td>
			</tr>
		<?php
			}
		?>
		</table>
		<!-- Footer  -->
		<?php require_once($_SERVER['DOCUMENT_ROOT']."/Footer.php"); ?>
	</div>
</body>
</html>