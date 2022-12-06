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
            require_once("../Connect.php");
            // Header
            require_once("../Header.php");
            require_once("../utils.php");
            checkAndStartSession();
            $logged_in = isLoggedIn();

            $allowed = isOwner() || isManager();
            
            if(!$logged_in) {
                echo "You shouldn't be here!";
                include_once('../Footer.php');
                exit();
            }
            if($allowed) {
                $allow_editing = true;
            }
            require_once("schedule_table.php");
            include_once('../Footer.php');
        ?>
    </div>
</body>