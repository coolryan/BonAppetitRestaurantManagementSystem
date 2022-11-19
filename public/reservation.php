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

        if (isset($_POST['name'])) {
            $reservation_id = (empty($_POST['reservation_id'])) ? null : $_POST['reservation_id'];
            $party_size = $_POST['party_size'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $date = $_POST['reservation_date'];
            $time = $_POST['reservation_time'];

            if($reservation_id == null) {
                $qry = "INSERT INTO reservation_table (party_size, name, email, phone, reservation_date, reservation_time) VALUES ({$party_size}, '{$name}', '{$email}', '{$phone}', '{$date}', '{$time}')";
            }
            else {
                $qry = "UPDATE reservation_table SET party_size={$party_size}, name='{$name}', email='{$email}', phone='{$phone}', reservation_date= '{$date}',reservation_time= '{$time}'  WHERE reservation_id={$reservation_id}";
            }

            $qry_result = mysqli_query($conn, $qry);
            if($qry_result) {
                $success = True;
            }

            if(isset($error_msg)) {
                echo "<p class='error'>".$error_msg."</p>";
            } else if(isset($success) && $success) {
                echo "<p class='success'>Reservation saved!</p>";
            }
        }

        else if(!empty($_GET['reservation_id'])) {
            $reservation_id = $_GET['reservation_id'];
            $qry_result = mysqli_query($conn, "SELECT * FROM reservation_table where reservation_id= {$reservation_id}");
            $restaurant_table = mysqli_fetch_assoc($qry_result);
            $party_size = $restaurant_table["party_size"];
            $name = $restaurant_table["name"];
            $email = $restaurant_table["email"];
            $phone = $restaurant_table["phone"];
            $date = $restaurant_table["reservation_date"];
            $time = $restaurant_table["reservation_time"];
        } 
        else {
            $reservation_id = "";
            $party_size = 0;
            $name = "";
            $email = "";
            $phone = "";
            $date = "";
            $time = "";
        }
    ?>
    <form action="reservation.php" class="form" method="POST">
        <input type="hidden" name="reservation_id" value="<?=$reservation_id?>">

        <label for="party_size">Enter a number of people:</label>
        <input type="number" min="1" step="1" id="party_size" name="party_size" value="<?=$party_size?>" placeholder="Provide a number">

        <label>Select a date:</label>
        <input type="date" name="reservation_date" value="<?=$date?>">

        <label>Select a time:</label>
        <input type="time" name="reservation_time" value="<?=$time?>">

        <label for="name">Enter your name:</label>
        <input type="text" id="name" name="name" value="<?=$name?>" placeholder="Provide an name" required>

        <label for="email">Enter your email:</label>
        <input type="email" id="email" name="email" value="<?=$email?>" placeholder="Provide an email" required>

        <label for="phone">Enter your phone number:</label>
        <input type="tel" id="phone" name="phone" value="<?=$phone?>" placeholder="Provide an phone" required>

        <input type="submit" name="Submit">
    </form>

    <?php
        include_once('Footer.php'); 
    ?>
</body>
</html>