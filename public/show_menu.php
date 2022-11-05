<a href="editmenuitem.php" class="button">New Menu Item</a>
<table>
<tr>
	<th>Menu Item</th>
	<th>Category</th>
	<th>Price</th>
	<th>Active</th>
</tr>
<?php
$qry_result = mysqli_query($conn, "SELECT * FROM menu_item")->fetch_all(MYSQLI_ASSOC);
foreach($qry_result as $menu_item)	{
	echo "<tr>";
	echo "<td>{$menu_item['name']}</td><td>{$menu_item['category']}</td><td>{$menu_item['price']}</td><td>{$menu_item['active']}</td>";
	$edit_link = "editmenuitem.php/?item={$menu_item['id']}";
	echo "<td><a href='$edit_link'>Edit</a></td>";
	echo "</tr>";
}
?>
</table>