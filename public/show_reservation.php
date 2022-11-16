<a href="/editreservationItem.php" class="button">New Reservation</a>
<a href="/reservation.php" class="button">Review Reservation</a>
<table>
	<tr>
		<th>Name</th>
		<th>Party size</th>
		<th>Email</th>
		<th>Phone</th>
		<th>Date</th>
		<th>Time</th>
	</tr>
	<?php  
		$qry_result = mysqli_query($conn, "SELECT * FROM reservation_table")->fetch_all(MYSQLI_ASSOC);
		foreach($qry_result as $reservation_item)	{
			$edit_link = "/editrersvationItem.php/?item={$reservation_item['reservation_id']}";
	?>
	<tr>
		<td><?= $reservation_item['name'] ?></td>
		<td><?= $reservation_item['party_size'] ?></td>
		<td><?= $reservation_item['email'] ?></td>
		<td><?= $reservation_item['phone'] ?></td>
		<td><?= $reservation_item['date'] ?></td>
		<td><?= $reservation_item['time'] ?></td>

		<td><a href='<?= $edit_link ?>'>Edit</a></td>
	</tr>
	<?php  
		}
	?>
</table>