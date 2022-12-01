<!--
Filename: view_tables.php
Author: Ryan Setaruddin
BCS 350- Web Database Developement
Professor Kaplan
Date: December 1, 2022
Purpose: To view tables at the restaurant
-->
<?php
	if(isset($date))
		$curr_time = strtotime($date);
	else
		$curr_time = time();
	$curr_date_nice = date('Y-m-d', $curr_time);
?>
<br>
<h2>Reservations on <?= $curr_date_nice ?> </h2>
<table>
<tr>
	<th>Table Number</th>
	<th>Max Chairs</th>
	<th>Reservations</th>
</tr>

<?php
class RestaurantTable {
	public $table_id;
	public $max_chairs;
	public $reservations = array();
}
function getByTable($qry_result) {
	$resv_by_table = array();
	foreach($qry_result as $table_item) {
		$table_id = $table_item['table_id'];

		if(!array_key_exists($table_id, $resv_by_table)) {
			$rest_table = new RestaurantTable();
			$rest_table->table_id = $table_id;
			$rest_table->max_chairs = $table_item['max_chairs'];
			$resv_by_table[$table_id] = $rest_table;
		}
		if(!empty($table_item["reservation_date"])) {
			array_push($resv_by_table[$table_id]->reservations, $table_item);	
		}
	}
	return $resv_by_table;
}
function reservationsByDay($resv_by_table, $curr_time) {
	$curr_year = date('Y', $curr_time);
	$curr_month = date('m', $curr_time);
	$curr_day = date('d', $curr_time);
	foreach($resv_by_table as $rest_table) {
		$today_reservations = array();
		if(count($rest_table->reservations) == 0)
			continue;

		foreach($rest_table->reservations as $reservation) {
			$resv_dt = strtotime($reservation['reservation_date']);
			$resv_year = date('Y', $resv_dt);
			$resv_month = date('m', $resv_dt);
			$resv_day = date('d', $resv_dt);
			$resv_time = $reservation['reservation_time'];
			if($curr_year == $resv_year and $curr_month == $resv_month and $curr_day == $resv_day) {
				array_push($today_reservations, $reservation);
			}
		}
		$rest_table->reservations = $today_reservations;
	}
	return $resv_by_table;
}

// Currently we support only one restaurant. Needs to be updated if we want to support multiple restaurant locations.
$qry = "SELECT rt.restaurant_table_id as table_id, max_chairs, rsv.party_size, "
	. "rsv.reservation_date, rsv.reservation_time, rsv.reservation_id "
	. "FROM restaurant_table rt "
	. "LEFT JOIN reservation_table rsv ON rt.restaurant_table_id = rsv.restaurant_table_id "
	. "WHERE rt.restaurant_id=(select restaurant_id FROM restaurant LIMIT 1)";

$qry_result = mysqli_query($conn, $qry)->fetch_all(MYSQLI_ASSOC);
$resv_by_table = getByTable($qry_result);

$resv_by_table = reservationsByDay($resv_by_table, $curr_time);

$curr_year = date('Y');
$curr_month = date('m');
$curr_day = date('d');
foreach($resv_by_table as $rest_table) {
	$resv_count = count($rest_table->reservations);
	$reservations = "";
	foreach($rest_table->reservations as $resv) {
		$resv_id = $resv['reservation_id'];
		$resv_count = $resv['party_size'];
		$resv_time = $resv['reservation_time'];

		$reservations = $reservations . "Id: $resv_id Party: $resv_count Time: $resv_time<br>";
	}
	// echo "Table $rest_table->table_id max chairs $rest_table->max_chairs Number reservations: <br>";
?>
	<tr>
		<td><?= $rest_table->table_id ?></td>
		<td><?= $rest_table->max_chairs ?></td>
		<td><?= $reservations ?></td>
	</tr>
<?php } ?>
</table>