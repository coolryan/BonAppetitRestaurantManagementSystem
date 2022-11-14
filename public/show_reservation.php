<a href="/editreservationItem.php" class="button">New Reservation</a>
<a href="/reservation.php" class="button">Review Reservation</a>
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
			$edit_link = "/editrersvationItem.php/?item={$menu_item['id']}";
	?>
	<tr>
		<td><?= $menu_item['name'] ?></td>
		<td><?= $menu_item['description'] ?></td>
		<td><?= $menu_item['category'] ?></td>
		<td><?= $menu_item['price'] ?></td>
		<td><?= $menu_item['active'] ?></td>
	
		<td><a href='<?= $edit_link ?>'>Edit</a></td>
	</tr>
	<?php  
		}
	?>
</table>