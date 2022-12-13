<!--
Filename: show_menu.php
Author: Ryan Setaruddin
BCS 350- Web Database Developement
Professor Kaplan
Date: Novermber 26, 2022
Purpose: To view the menu items as a restaurant worker. This page is imported from editmenu.php
-->
<div class="actionbtn">
	<!-- Allow the user to add a new menu item -->
	<button><a href="/editmenuitem.php" class="button">New Menu Item</a></button>
	<!-- Allow the user to preview the menu as a guest would not logged in -->
	<button><a href="/menu.php" class="button">Preview Menu</a></button>
</div>
<br>
<table>
	<tr>
		<th>Menu Item</th>
		<th>Description</th>
		<th>Category</th>
		<th>Price</th>
		<th>Active</th>
	</tr>
<?php
// Get the menu from the database
$qry_result = mysqli_query($conn, "SELECT * FROM menu_item")->fetch_all(MYSQLI_ASSOC);
foreach($qry_result as $menu_item)	{
	$edit_link = "/editmenuitem.php?item_id={$menu_item['id']}";
?>
	<tr>
		<td><?= $menu_item['name'] ?></td>
		<td><?= $menu_item['description'] ?></td>
		<td><?= $menu_item['category'] ?></td>
		<td><?= $menu_item['price'] ?></td>
		<td><?= $menu_item['active'] ?></td>
	
		<td><a href='<?= $edit_link ?>'>Edit</a></td>
	</tr>
<?php } ?>
</table>