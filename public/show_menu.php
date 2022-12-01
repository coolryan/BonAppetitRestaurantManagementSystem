<!--
Filename: show_menu.php
Author: Ryan Setaruddin
BCS 350- Web Database Developement
Professor Kaplan
Date: Novermber 26, 2022
Purpose: To view the menu items as a restaurant worker
-->
<a href="/editmenuitem.php" class="button">New Menu Item</a>
<a href="/menu.php" class="button">Preview Menu</a>
<table>
<tr>
	<th>Menu Item</th>
	<th>Description</th>
	<th>Category</th>
	<th>Price</th>
	<th>Active</th>
</tr>
<?php
$qry_result = mysqli_query($conn, "SELECT * FROM menu_item")->fetch_all(MYSQLI_ASSOC);
foreach($qry_result as $menu_item)	{
	$edit_link = "/editmenuitem.php?item={$menu_item['id']}";
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