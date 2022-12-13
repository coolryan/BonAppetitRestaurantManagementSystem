<!--
Filename: edit_staff.php
Author: Ryan Setaruddin
BCS 350- Web Database Developement
Professor Kaplan
Date: November 26, 2022
Purpose: To edit the staff members and their status by owneers/maangers
-->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Staff Page</title>
	<link rel="stylesheet" type="text/css" href="CSS/Main.css">
</head>
<body>
	<div id="content">
		<?php
			require_once($_SERVER['DOCUMENT_ROOT']."/Header.php");
			require_once($_SERVER['DOCUMENT_ROOT']."/Connect.php");
			require_once($_SERVER['DOCUMENT_ROOT']."/utils.php");
			checkAndStartSession();
			$allowed = isOwner() || isManager();
			
			if(!$allowed) {
				echo "You shouldn't be here!";
				include_once($_SERVER['DOCUMENT_ROOT']."/Footer.php");
				exit();
			}

			$user_type_results = mysqli_query($conn, "SELECT id, name FROM user_type")->fetch_all(MYSQLI_ASSOC);
			$user_type_arr = array();
			foreach($user_type_results as $user_type) {
				if($user_type["name"] == "owner") {
					$owner_type_id = $user_type["id"];
				}
			}
			if(!isset($owner_type_id)) {
				echo "Error, no owner type found.";
				include_once($_SERVER['DOCUMENT_ROOT']."/Footer.php");
				exit();
			}

			if (isset($_POST['first_name'])) {
				$user_id = (empty($_POST['user_id'])) ? null : $_POST['user_id'];
				$email = $_POST['email'];
				$phone = $_POST['phone'];
				$first_name = $_POST['first_name'];
				$last_name = $_POST['last_name'];
				$user_type = $_POST['user_type'];
				$status = (isset($_POST["status"])) ? 1 : 0;
				$date_created = $_POST['date_created'];
				$password = md5(generateRandomString());

				if($owner_type_id==$user_type && !isOwner()) {
					echo "Only owners can add owners";
					include_once($_SERVER['DOCUMENT_ROOT']."/Footer.php");
					exit();
				}

				if($user_id == null) {
					$qry = "INSERT INTO user (first_name, last_name, user_type, status, email, phone, date_created, password) VALUES ('{$first_name}', '{$last_name}', {$user_type}, {$status}, '{$email}', '{$phone}', '{$date_created}', '{$password}')";
				}
				else {
					$qry = "UPDATE user SET first_name='{$first_name}', last_name='{$last_name}', user_type={$user_type}, status={$status}, email='{$email}', phone='{$phone}', date_created='{$date_created}' WHERE id={$user_id}";
				}
				$qry_result = mysqli_query($conn, $qry);
				if($qry_result) {
					$success = True;
					$qry_result = mysqli_query($conn, "SELECT id, date_created FROM user where email= {$email}");
					$user_data = mysqli_fetch_assoc($qry_result);
					$date_created = date("Y-m-d", strtotime($user_data["date_created"]));
					$user_id = $user_data['id'];
				}
			} else if(!empty($_GET['user_id'])) {
				$user_id = $_GET['user_id'];
				$qry = "SELECT u.*, user_type.name as user_type FROM user u left join user_type ON u.user_type=user_type.id WHERE u.id= {$user_id}";
				$qry_result = mysqli_query($conn, $qry);
				$user_data = mysqli_fetch_assoc($qry_result);
				$email = $user_data["email"];
				$phone = $user_data["phone"];
				$first_name = $user_data["first_name"];
				$last_name = $user_data["last_name"];
				$user_type = $user_data["user_type"];
				$status = ($user_data["status"] >0) ? True: False;
				$date_created = date("Y-m-d", strtotime($user_data["date_created"]));
			} else {
				$user_id = "";
				$email = "";
				$phone = "";
				$first_name = "";
				$last_name = "";
				$user_type = "";
				$status = "";
				$date_created = "";
			}
		?>
	<form action="edit_staff.php" class="form" method="POST">
		<div class="container1">
			<input name="user_id" type="hidden" value="<?= $user_id; ?>">
			<label for="first_name">First Name</label>
			<input type="text" name="first_name" value="<?= $first_name; ?>" autocomplete="off" required>
			<label for="last_name">Last Name</label>
			<input type="text" name="last_name" value="<?= $last_name; ?>" autocomplete="off" required>
			<label for="email">Email</label>
			<input type="text" name="email" value="<?= $email; ?>" autocomplete="off" required>
			<label for="phone">Phone</label>
			<input type="text" name="phone" value="<?= $phone; ?>" autocomplete="off" required>
			<label for="user_type">User Type</label>
			<select name="user_type" id="user_type">
		<?php
			foreach($user_type_results as $user_type):
				$selected = ($user_type == $user_type["id"]) ? "selected" : "";
		?>
				<option value="<?= $user_type['id']; ?>" <?= $selected; ?> ><?= $user_type['name']; ?></option>
			<?php endforeach; ?>
			</select><br>
			<label for="status">Active</label>
			<input type="checkbox" name="status" <?= $status ? "checked" : "" ?> />
			<label for="date_created">Hire Date</label>
			<input type="date" name="date_created" id="date_created" value="<?= $date_created; ?>" required>

			<input type="submit" name="save" value="Save">
			<input type="button" name="cancel" value="Cancel" onClick="window.location.href='/editmenu.php';">

		</div>
	</form>
		<?php include_once($_SERVER['DOCUMENT_ROOT']."/Footer.php"); ?>
	</div>
</body>
</html>