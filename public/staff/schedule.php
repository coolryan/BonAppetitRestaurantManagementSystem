<!--
Filename: schedule.php
Author: Ryan Setaruddin
BCS 350- Web Database Developement
Professor Kaplan
Date: December 4, 2022
Purpose: To create/view/edit staff schedules
-->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Staff Schedule</title>
	<link rel="stylesheet" type="text/css" href="../CSS/Main.css">
</head>
<body>
    <div id="content">
        <?php
            // Connect to MySQL
            require_once($_SERVER['DOCUMENT_ROOT']."/Connect.php");
            // Display the header
            require_once($_SERVER['DOCUMENT_ROOT']."/Header.php");
            // Import some needed PHP files
            require_once($_SERVER['DOCUMENT_ROOT']."/utils.php");
            checkAndStartSession();
            $logged_in = isLoggedIn();

            $allowed = isOwner() || isManager();
            
            // Only admin/managers allowed
            if(!$allowed) {
                echo "You shouldn't be here!";
                include_once($_SERVER['DOCUMENT_ROOT']."/Footer.php");
                exit();
            }

            // Creating/editing a user schedule
            if (isset($_POST['user_id'])) {
                $mysql_dt_format = "Y-m-d H:i:s";
                $schedule_id = (empty($_POST['schedule_id'])) ? null : $_POST['schedule_id'];
                $user_id = $_POST['user_id'];
                $start_date = $_POST['start_date'];
                $start_time = $_POST['start_time'];
                $end_date = $_POST['end_date'];
                $end_time = $_POST['end_time'];
                $start_str = "$start_date $start_time";
                $end_str = "$end_date $end_time";
                echo "Start str: $start_str<br>";
                echo "End str: $end_str<br>";
                $start_unix_time = strtotime($start_str);
                $end_unix_time = strtotime($end_str);
                $start_datetime = date($mysql_dt_format, $start_unix_time);
                $end_datetime = date($mysql_dt_format, $end_unix_time);

                // Creating a new schedule for a user
                if($schedule_id == null) {
                    $qry = "INSERT INTO staff_schedule (user_id, start_datetime, end_datetime) VALUES ({$user_id}, '{$start_datetime}', '{$end_datetime}')";
                }
                // Editing an existing schedule
                else {
                    $qry = "UPDATE staff_schedule SET start_datetime='{$start_datetime}', end_datetime='{$end_datetime}' WHERE id={$schedule_id}";
                }
                echo $qry;
                $qry_result = mysqli_query($conn, $qry);
                if($qry_result) {
                    $success = True;
                }

                // Show any errors
                if(isset($error_msg)) {
                    echo "<p class='error'>".$error_msg."</p>";
                }
                // Show success
                else if(isset($success) && $success) {
                    echo "<p class='success'>Reservation saved!</p>";
                }
            // Get the details for a specific schedule
            } else if(!empty($_GET['schedule_id'])) {
                $schedule_id = $_GET['schedule_id'];
                $qry = "SELECT * FROM staff_schedule WHERE id= {$schedule_id}";
                $qry_result = mysqli_query($conn, $qry);
                $sched_data = mysqli_fetch_assoc($qry_result);
                $user_id = $sched_data["user_id"];
                $start_date = date("Y-m-d", strtotime($sched_data["start_datetime"]));
                $start_time = date("H:i", strtotime($sched_data["start_datetime"]));
                $end_date = date("Y-m-d", strtotime($sched_data["end_datetime"]));
                $end_time = date("H:i", strtotime($sched_data["end_datetime"]));
            }
            // New schedule, so set all variables to blank
            else {
                $schedule_id = "";
                $user_id = "";
                $user_name = "";
                $user_email = "";
                $start_date = "";
                $start_time = "";
                $end_date = "";
                $end_time = "";
            }

        ?>

        <form action="schedule.php" class="form" method="POST">
            <input type="hidden" name="schedule_id" value="<?=$schedule_id?>">

            <label for="user_id">Staff Id:</label>
            <input type="text" id="user_id" name="user_id" value="<?=$user_id?>" placeholder="Staff Id" required>

            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" value="<?=$start_date?>">

            <label for="start_time">Start Time:</label>
            <input type="time" name="start_time" value="<?=$start_time?>">

            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" value="<?=$end_date?>">

            <label for="end_time">End Time:</label>
            <input type="time" name="end_time" value="<?=$end_time?>">

            <input type="submit" name="Submit">
        </form>