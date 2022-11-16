<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Reservation Page</title>
	<link rel="stylesheet" type="text/css" href="CSS/Main.css">
</head>
<body>
	<?php
        require_once("Header.php");
        require_once("Connect.php");
        require_once("utils.php");
        checkAndStartSession();

        function getByID($qry_result) {
            $reservation_by_cat = array();
            foreach($qry_result as $reservation_item) {
                $cat = $reservation_item['reservation_id'];
                if(!array_key_exists($cat, $reservation_by_cat)) {
                    $reservation_by_cat[$cat] = array();
                }
                array_push($reservation_by_cat[$cat], $reservation_item);
            }
            return $reservation_by_cat;
        }

        $qry_result = mysqli_query($conn, "SELECT * FROM reservation_table WHERE reservation_id={$reservation_id}")->fetch_all(MYSQLI_ASSOC);
        $reservation_by_cat = getByCategory($qry_result);

        $category_order = array("Name", "Phone", "Party size","Date","Time");

        foreach($category_order as $cat) {
            $reservation_items = $reservation_by_cat[$cat];
            if(!array_key_exists($cat, $reservation_by_cat)) {
                continue;
            }
            echo "<h4 class='reservationCategory'>{$cat}</h4>";
            foreach($reservation_items as $reservation_item) {
    ?>
            <div class="reservationItem">
                <div class="reservationName"><?= $reservation_item["name"]; ?></div>
                <div class="reservationParty_size"><?= $reservation_item["party_size"]; ?></div>
                <div class="reservationEmail"><?= $reservation_item["email"]; ?></div>
                <div class="reservationPhone"><?= $reservation_item["phone"]; ?></div>
                <div class="reservationDate"><?= $reservation_item["reservation_date"]; ?></div>
                <div class="reservationTime"><?= $reservation_item["reservation_time"]; ?></div>
            </div>
    <?php
            }
        }

        include_once('Footer.php'); 
    ?>
</body>
</html>