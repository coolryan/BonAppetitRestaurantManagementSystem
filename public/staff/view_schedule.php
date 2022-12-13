<!--
Filename: view_schedule.php
Author: Ryan Setaruddin
BCS 350- Web Database Developement
Professor Kaplan
Date: December 4, 2022
Purpose: To view user schedules. If staff, only view your own.
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
            // Start the session so we know if a user is logged in and who it is
            checkAndStartSession();
            $logged_in = isLoggedIn();

            $allowed = isOwner() || isManager();
            
            // Only visible if you are logged in
            if(!$logged_in) {
                echo "You shouldn't be here!";
                include_once($_SERVER['DOCUMENT_ROOT']."/Footer.php");
                exit();
            }
            // Show editing controls if you are owner or manager
            if($allowed) {
                $allow_editing = true;
            }
            // Display the schedule table
            require_once($_SERVER['DOCUMENT_ROOT']."/staff/schedule_table.php");
            // Display the footer
            include_once($_SERVER['DOCUMENT_ROOT']."/Footer.php");
        ?>
    </div>
</body>