<!--
Filename: schedule_table.php
Author: Ryan Setaruddin
BCS 350- Web Database Developement
Professor Kaplan
Date: December 1, 2022
Purpose: Show all staff schedule in a paginated table.
-->
<?php  
	// Header
	require_once($_SERVER['DOCUMENT_ROOT']."/utils.php");
	checkAndStartSession();
	$logged_in = isLoggedIn();

    // Exit page if not owner or manager
    if(!$logged_in) {
        echo "You shouldn't be here!";
        include_once($_SERVER['DOCUMENT_ROOT']."/Footer.php");
        exit();
    }

    $view_all = isOwner() || isManager();


	// Connect to MySQL
	require_once($_SERVER['DOCUMENT_ROOT']."/Connect.php");

    // This component is sometimes displayed where editing is not ideal, so lets accomodate
    $show_edit = False;
    if(isset($allow_editing) and $allow_editing == True) {
        $show_edit = True;
    }

    // Pagination details
    $page_limit = 20;
    if(!isset ($_GET['page']) ) {
        $page_number = 1;
    } else {
        $page_number = $_GET['page'];
    }
    $initial_page = ($page_number-1) * $page_limit; 

    if($view_all)
    	$qry = "SELECT * FROM staff_schedule ORDER BY start_datetime DESC";
   	else {
   		$user_id = $_SESSION['user_id'];
   		$qry = "SELECT * FROM staff_schedule WHERE user_id=$user_id ORDER BY start_datetime DESC";
   	}

    
    $qry_result = mysqli_query($conn, $qry);

    // Some pagination calculations based on results
    $total_rows = mysqli_num_rows($qry_result);
    $total_pages = ceil ($total_rows / $page_limit);

    // Get the data for the current page
    if($view_all)
    	$qry = "SELECT ss.*, user.first_name, user.last_name, user.email, user.phone FROM staff_schedule ss LEFT JOIN user ON ss.user_id=user.id ORDER BY start_datetime DESC LIMIT " . $initial_page . ',' . $page_limit;
   	else {
   		$user_id = $_SESSION['user_id'];
   		$qry = "SELECT ss.*, user.first_name, user.last_name, user.email, user.phone FROM staff_schedule ss LEFT JOIN user ON ss.user_id=user.id WHERE user_id=$user_id ORDER BY start_datetime DESC LIMIT " . $initial_page . ',' . $page_limit;
   	}
    $qry_result = mysqli_query($conn, $qry);

    $schedule_data = $qry_result->fetch_all(MYSQLI_ASSOC);

    if($show_edit) {
        ?>
        <a href="/staff/schedule.php" class="button">Add To Schedule</a>
        <?php
    }
?>
    
    <table>
        <tr>
            <th>Date</th>
            <th>Start Time</th>
            <th>End Date</th>
            <th>End Time</th>
            <th>Staff Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
        </tr>
<?php 
// Add the reservations to the table
    foreach($schedule_data as $sched_item)  {
        $edit_link = "/staff/schedule.php?schedule_id={$sched_item['id']}";
        $start_datetime = strtotime($sched_item["start_datetime"]);
        $end_datetime = strtotime($sched_item["end_datetime"]);
        
		$start_date = date( 'Y-m-d', $start_datetime );
		$start_time = date( 'H:i', $start_datetime );
		$end_date = date( 'Y-m-d', $end_datetime );
		$end_time = date( 'H:i', $end_datetime );
		$full_name = "{$sched_item['first_name']} {$sched_item['last_name']}";
?>

    <tr>
        <td><?= $start_date ?></td>
        <td><?= $start_time ?></td>
        <td><?= $end_date ?></td>
        <td><?= $end_time ?></td>
        <td><?= $sched_item['user_id'] ?></td>
        <td><?= $full_name ?></td>
        <td><?= $sched_item['email'] ?></td>
        <td><?= $sched_item['phone'] ?></td>
    <?php
    if($show_edit)
        echo "<td><a href='$edit_link'>Edit</a></td>";
    ?>
        
    </tr>
<?php
    } 
?>
</table>
<?php
    // show page number with link   
    for($page_number = 1; $page_number<= $total_pages; $page_number++) {  
        echo '<a href = "/staff/view_schedule.php?page=' . $page_number . '">' . $page_number . ' </a>';  
    }
?>