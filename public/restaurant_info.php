<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Restaurant Information</title>
	<link rel="stylesheet" type="text/css" href="/CSS/Main.css">
</head>
<body>
	<div id="content">
		<?php 
			// Header
			require_once($_SERVER['DOCUMENT_ROOT']."/Header.php");
			require_once($_SERVER['DOCUMENT_ROOT']."/utils.php");
			checkAndStartSession();
			$logged_in = isLoggedIn();

			if(!$logged_in) {
				require_once($_SERVER['DOCUMENT_ROOT']."/Unauthorized_access.php");
				require_once($_SERVER['DOCUMENT_ROOT']."/Footer.php");
				exit();		
			}

			// Connect to MySQL
			require_once($_SERVER['DOCUMENT_ROOT']."/Connect.php");
			//$qry_result = mysqli_query($conn, "SELECT * FROM restaurant")->fetch_assoc();
			//$restaurantName = $qry_result['name'];
		?>
		<?php  
			if (isset($_POST['name'])) {
				// get all of the form data
				$id = (empty($_POST['id'])) ? null : $_POST['id'];
				$name = $_POST['name'];
				$address = $_POST['address'];
				$cuisine_type = $_POST['cuisine_type'];
				$back_story = $_POST['back_story'];

				if($id == null) {
					$qry = "INSERT INTO restaurant (id, name, address, cuisine_type, back_story) VALUES (NULL, '{$name}', '{$address}', '{$cuisine_type}', '{$back_story}')";
				}
				else {
					$qry = "UPDATE restaurant SET name='{$name}', address='{$address}', cuisine_type='{$cuisine_type}', back_story= '{$back_story}' WHERE id={$id}";
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
			else if(!empty($_GET['id'])) {
				$id = $_GET['id'];
				$qry_result = mysqli_query($conn, "SELECT * FROM restaurant where restaurant_id= {$id}");
				$restaurant = mysqli_fetch_assoc($qry_result);
				$name = $restaurant["name"];
				$address = $restaurant["address"];
				$cuisine_type = $restaurant["cuisine_type"];
				$back_story = $restaurant["back_story"];
			} 
			else {
				$id = "";
				$name = "";
				$address = "";
				$cuisine_type = "";
				$back_story = "";
			}
		?>
		<form action="restaurant_info.php" method="POST">
			<input type="hidden" name="id" value="<?=$id?>">

			<label for="name">Name:</label>
			<input type="text" name="name" value="<?=$name?>" autocomplete="off" required>

			<label for="address">Address:</label>
			<input type="text" name="address" value="<?=$address?>" autocomplete="off" required>

			<label for="cuisine_type">Cuisine type:</label>
			<input type="text" name="cuisine_type" value="<?=$cuisine_type?>" autocomplete="off" required>

			<label for="back_story">Back story:</label>
			<textarea rows="5" cols="50" name="back_story" value="<?=$back_story?>" autocomplete="off" required></textarea>

			<input type="submit" name="Submit">
		</form>

		<?php
			require_once($_SERVER['DOCUMENT_ROOT']."/Footer.php"); 
		?>
	</div>
</body>
</html>