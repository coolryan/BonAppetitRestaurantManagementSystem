<!--
Filename: staff.php
Author: Ryan Setaruddin
BCS 350- Web Database Developement
Professor Kaplan
Date: November 26, 2022
Purpose: To view the staff. Only owners and managers allowed.
-->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Staff page</title>
	<link rel="stylesheet" type="text/css" href="CSS/Main.css">
</head>
<body>
	<div id="content">
		<?php  
			// Display the header
			require_once($_SERVER['DOCUMENT_ROOT']."/Header.php");
			// Import some needed PHP files
			require_once($_SERVER['DOCUMENT_ROOT']."/utils.php");

			// Start the session so we know if a user is logged in and who it is
			checkAndStartSession();
			$allowed = isOwner() || isManager();
			
			// If the user is not owner or manager, they shouldn't be here
			if(!$allowed) {
				echo "You shouldn't be here!";
				include_once($_SERVER['DOCUMENT_ROOT']."/Footer.php");
				exit();
			}
			// Connect to MySQL
			require_once($_SERVER['DOCUMENT_ROOT']."/Connect.php");

		?>
		<div class="actionbtn">
			<!-- Allow adding a new staff member -->
			<button><a href="/edit_staff.php">Add staff member</a></button>
		</div>
		<br>
		<table>
			<tr>
				<th>Name</th>
				<th>Role</th>
				<th>Phone</th>
				<th>Email</th>
				<th>Active</th>
				<th>Hire Date</th>
			</tr>
		<?php
		// Get all the current users/staff and their type
			$qry_result = mysqli_query($conn, "SELECT u.*, ut.name as user_type_name FROM user u left join user_type ut on u.user_type=ut.id")->fetch_all(MYSQLI_ASSOC);
			foreach($qry_result as $user_data)	{
				$edit_link = "/edit_staff.php?user_id={$user_data['id']}";
				$full_name = "{$user_data['first_name']} {$user_data['last_name']}";
				$is_active = $user_data['status'] == 1 ? "Y" : "N";
		?>
			<tr>
				<td><?= $full_name ?></td>
				<!-- Cast the user type to first character capitalized -->
				<td><?= ucfirst($user_data['user_type_name']) ?></td>
				<td><?= $user_data['phone'] ?></td>
				<td><?= $user_data['email'] ?></td>
				<td><?= $is_active ?></td>
				<td><?= $user_data['date_created'] ?></td>
			
				<td><a href='<?= $edit_link ?>'>Edit</a></td>
			</tr>
		<?php
			}
		?>
		</table>
		<!-- Footer  -->
		<?php require_once($_SERVER['DOCUMENT_ROOT']."/Footer.php"); ?>
	</div>
</body>
</html>