<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Reservation Page</title>
	<link rel="stylesheet" type="text/css" href="CSS/Main.css">
</head>
<body>
<div id="content">
	<?php  
		// Header
		require_once("Header.php");
		require_once("utils.php");
		checkAndStartSession();
		$logged_in = isLoggedIn();

		// Connect to MySQL
		require_once("Connect.php");
	?>
    <?php 
        if (isset($_POST['variable'])) {
            $reservation_id = (empty($_POST['reservation_id'])) ? null : $_POST['reservation_id'];
            $numberOfPeople = $_POST['numberOfPeople'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $date = $_POST['rest_date'];
            $time = $_POST['rest_time'];

            if($reservation_id == null) {
                $qry = "INSERT INTO reservation_table (reservation_id, numberOfPeople, name, email, phone, rest_date, rest_time) VALUES (NULL, '{$email}', '{$phone}', '{$date}', '{$time}')";
            }
            else {
                $qry = "UPDATE reservation_table SET name='{$name}', email='{$email}', phone='{$cuisine_type}', rest_date= '{$date}',rest_time= '{$time}'  WHERE reservation_id={$reservation_id}";
            }

            $qry_result = mysqli_query($conn, $qry);
            if($qry_result) {
                $success = True;
            }

            if(isset($error_msg)) {
                echo "<p class='error'>".$error_msg."</p>";
            } else if(isset($success) && $success) {
                echo "<p class='success'>Menu item saved!</p>";
            }
        }

        else if(!empty($_GET['$reservation_id'])) {
            $reservation_id = $_GET['$reservation_id'];
            $qry_result = mysqli_query($conn, "SELECT * FROM reservation_table where $reservation_id= {$reservation_id}");
            $restaurant_table = mysqli_fetch_assoc($qry_result);
            $numberOfPeople = $restaurant_table["numberOfPeople"];
            $name = $restaurant_table["name"];
            $email = $restaurant_table["email"];
            $phone = $restaurant_table["phone"];
            $date = $restaurant_table["rest_date"];
            $time = $restaurant_table["rest_time"];
        } 
        else {
            $reservation_id = "";
            $numberOfPeople = "";
            $name = "";
            $email = "";
            $phone = "";
            $date = "";
            $time = "";
        }
    ?>
	<form action="reservation.php" method="POST">
        <input type="hidden" name="reservation_id" value="<?=$reservation_id?>">

        <label>Enter a number of people:</label>
        <input type="text" name="numberOfPeople" value="<?=$numberOfPeople?>" placeholder="Provide a number">

        <label>Select a date:</label>
        <input type="date" name="dateForm" value="<?=$date?>">

        <label>Select a time:</label>
        <input type="time" name="timeForm" value="<?=$time?>">

        <label>Enter your name:</label>
        <input type="text" name="name" value="<?=$name?>" placeholder="Provide an name" required>

        <label>Enter your email:</label>
        <input type="text" name="email" value="<?=$email?>" placeholder="Provide an email" required>

        <label>Enter your phone number:</label>
        <input type="text" name="phone" value="<?=$phone?>" placeholder="Provide an phone" required>

        <input type="submit" name="Submit">
    </form>
	<?php
		// Footer 
		require_once("Footer.php"); 
	?>
</div>
</body>
</html>