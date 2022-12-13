<?php  
	// Header
	require_once($_SERVER['DOCUMENT_ROOT']."/utils.php");
	checkAndStartSession();

    $allowed = isOwner() || isManager();

    // Exit page if not owner or manager
    if(!$allowed) {
        echo "You shouldn't be here!";
        include_once($_SERVER['DOCUMENT_ROOT']."/Footer.php");
        exit();
    }

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

    $qry = "SELECT * FROM reservation_table ORDER BY reservation_date, reservation_time DESC";
    $qry_result = mysqli_query($conn, $qry);

    // Some pagination calculations based on results
    $total_rows = mysqli_num_rows($qry_result);
    $total_pages = ceil ($total_rows / $page_limit);

    // Get the data for the current page
    $qry = "SELECT * FROM reservation_table ORDER BY reservation_date, reservation_time DESC LIMIT " . $initial_page . ',' . $page_limit;
    $qry_result = mysqli_query($conn, $qry);

    $reservation_data = $qry_result->fetch_all(MYSQLI_ASSOC);

    if($show_edit) {
        ?>
        <div class="actionbtn">
            <button><a href="/reservation.php" class="button">New Reservation</a></button>
        </div>
        <?php
    }
?>
    
    <table>
        <tr>
            <th>Date</th>
            <th>Time</th>
            <th>Table</th>
            <th>Party Size</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
        </tr>
<?php 
// Add the reservations to the table
    foreach($reservation_data as $reservation_item)  {
        $edit_link = "/reservation.php?reservation_id={$reservation_item['reservation_id']}";
        $date_time = "{$reservation_item['reservation_date']} {$reservation_item['reservation_time']}"; 
?>

    <tr>
        <td><?= $reservation_item['reservation_date'] ?></td>
        <td><?= $reservation_item['reservation_time'] ?></td>
        <td><?= $reservation_item['restaurant_table_id'] ?></td>
        <td><?= $reservation_item['party_size'] ?></td>
        <td><?= $reservation_item['patron_name'] ?></td>
        <td><?= $reservation_item['patron_email'] ?></td>
        <td><?= $reservation_item['patron_phone'] ?></td>
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
        echo '<a href = "view_reservations.php?page=' . $page_number . '">' . $page_number . ' </a>';  
    }
?>