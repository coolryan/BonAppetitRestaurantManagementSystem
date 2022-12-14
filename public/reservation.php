<!--
Filename: reservation.php
Author: Ryan Setaruddin
BCS 350- Web Database Developement
Professor Kaplan
Date: Novermber 26, 2022
Purpose: To create reservation page for customers
-->
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
            // Display the header
            require_once($_SERVER['DOCUMENT_ROOT']."/Header.php");
            // Import some needed PHP files
            require_once($_SERVER['DOCUMENT_ROOT']."/Connect.php");
            require_once($_SERVER['DOCUMENT_ROOT']."/utils.php");
            // Start the session so we know if a user is logged in and who it is
            checkAndStartSession();
            $logged_in = isLoggedIn();
        ?>
        <h1>Reservation</h1>
        <?php
            // Check if a reservation is being created/edited
            if (isset($_POST['name'])) {
                
                $reservation_id = (empty($_POST['reservation_id'])) ? null : $_POST['reservation_id'];
                $party_size = $_POST['party_size'];
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $date = $_POST['reservation_date'];
                $time = $_POST['reservation_time'];
                $table_id = (!isset($_POST['table'])) ? null : $_POST['table'];

                // Creating a new reservation
                if($reservation_id == null) {
                    // The table may be defined if being created by a logged in user where they are putting a guest party to a specific table
                    if($table_id !=null)
                        // If we want to support more than one restaurants, this query will need to make sure the restaurant_table_id is from the right restaurant
                        $qry = "INSERT INTO reservation_table (party_size, patron_name, patron_email, patron_phone, reservation_date, reservation_time, restaurant_table_id) VALUES ({$party_size}, '{$name}', '{$email}', '{$phone}', '{$date}', '{$time}', (SELECT restaurant_table_id FROM restaurant_table where table_number='{$table_id}'))";
                    else
                        $qry = "INSERT INTO reservation_table (party_size, patron_name, patron_email, patron_phone, reservation_date, reservation_time) VALUES ({$party_size}, '{$name}', '{$email}', '{$phone}', '{$date}', '{$time}')";
                }
                // Editing an existing reservation
                else {
                    // The table may be defined if being created by a logged in user where they are putting a guest party to a specific table
                    if($table_id !=null)
                        // If we want to support more than one restaurants, this query will need to make sure the restaurant_table_id is from the right restaurant
                        $qry = "UPDATE reservation_table SET party_size={$party_size}, patron_name='{$name}', patron_email='{$email}', patron_phone='{$phone}', reservation_date= '{$date}', reservation_time= '{$time}', restaurant_table_id= (SELECT restaurant_table_id FROM restaurant_table where table_number='{$table_id}') WHERE reservation_id={$reservation_id}";
                    else
                        $qry = "UPDATE reservation_table SET party_size={$party_size}, patron_name='{$name}', patron_email='{$email}', patron_phone='{$phone}', reservation_date= '{$date}', reservation_time= '{$time}' WHERE reservation_id={$reservation_id}";
                }
                $qry_result = mysqli_query($conn, $qry);
                if($qry_result) {
                    $success = True;
                }
                // Show any errors that happened
                if(isset($error_msg)) {
                    echo "<p class='error'>".$error_msg."</p>";
                }
                // Show success to the user
                else if(isset($success) && $success) {
                    echo "<p class='success'>Reservation saved!</p>";
                }
            }
            // Get the details for a specific reservation
            else if(!empty($_GET['reservation_id'])) {
                $reservation_id = $_GET['reservation_id'];
                $qry_result = mysqli_query($conn, "SELECT * FROM reservation_table where reservation_id= {$reservation_id}");
                $restaurant_table = mysqli_fetch_assoc($qry_result);
                $party_size = $restaurant_table["party_size"];
                $name = $restaurant_table["patron_name"];
                $email = $restaurant_table["patron_email"];
                $phone = $restaurant_table["patron_phone"];
                $date = $restaurant_table["reservation_date"];
                $time = $restaurant_table["reservation_time"];
                $table_id = $restaurant_table["table_number"];
            } 
            // A new reservation, so set all variables to blank
            else {
                $reservation_id = "";
                $party_size = 0;
                $table_id = null;
                $name = "";
                $email = "";
                $phone = "";
                $date = "";
                $time = "";
            }
        ?>
        <!-- Rservation form will take the user's input -->
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

        <!-- If the user is logged in, show the Table input to allow setting the table-->
        <?php
            if($logged_in) {
        ?>
            <label for="table">Assigned Table:</label>
            <input type="number" id="table" name="table" value="<?=$table_id?>" placeholder="Assigned Table" required>
        <?php
            }
        ?>
            <input type="submit" name="Submit">
        </form>

        <?php 
            // If the user is logge din, show the restaurant tables so they know where to assign a guest party
            if($logged_in) {
                require_once($_SERVER['DOCUMENT_ROOT']."/view_tables.php");
            }
            // Footer
            require_once($_SERVER['DOCUMENT_ROOT']."/Footer.php");
        ?>
    </div>
</body>
</html>