<!--
Filename: editmenuitem.php
Author: Ryan Setaruddin
BCS 350- Web Database Developement
Professor Kaplan
Date: November 26, 2022
Purpose: To allow the owners/mamngers to edit the menu item from customers
-->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Menu Item Page</title>
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

			// Check if the user is creating/editing a menu item
			if (isset($_POST['name'])) {
				$item_id = (empty($_POST['item_id'])) ? null : $_POST['item_id'];
				$name = $_POST['name'];
				$category = $_POST["category"];
				$price = $_POST["price"];
				$active = (isset($_POST["active"])) ? 1 : 0;
				$description = $_POST["description"];
				
				// Handle uploading files for menu item
				if(isset($_FILES["photo"])) {
					$errors= array();
					$file_name = $_FILES['photo']['name'];
					$file_size =$_FILES['photo']['size'];
					$file_tmp =$_FILES['photo']['tmp_name'];
					$file_type=$_FILES['photo']['type'];
					$file_ext=strtolower(end(explode('.',$_FILES['photo']['name'])));
					// echo "Found photo: ".$file_name . ". File size: ".$file_size . "<br>";
					$extensions= array("jpeg","jpg","png");
					if(in_array($file_ext,$extensions)=== false){
		        		$errors[]="extension not allowed, please choose a JPEG or PNG file.";
		      		}
		      		if($file_size > 2097152){
		        		$errors[]='File size must be excately 2 MB';
		    		}
					if(empty($errors)==true){
						// Set the target directory for the menu item image.
						$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/images/menu/";
						$target_file = $target_dir . basename($file_name);
						$relative_path = "/images/menu/" . basename($file_name);
						// Move the photo to the proper location
						move_uploaded_file($file_tmp,$target_file);
					}else{
						echo "Errors: " . $errors;
						$file_name = "";
					}
				} else {
					echo "No photo: ".$_FILES["photo"];
				}
				
				// Make sure the required details are filled out when creating/editing
				if($name != "" && $category != "" && $price != "") {
					echo "Item: $item_id";
					if(!isset($relative_path)) {
						$relative_path = null;
					}
					// Adding a new menu item
					if($item_id == null) {
						$qry = "INSERT INTO menu_item (name, description, price, active, image_path, category) VALUES ('{$name}', '{$description}', {$price}, {$active}, '{$relative_path}', '{$category}')";
					}
					// Updating a menu item
					else {
						$qry = "UPDATE menu_item SET name='{$name}', description='{$description}', price={$price}, active={$active}, image_path='{$relative_path}', category='{$category}' WHERE id={$item_id}";
					}
					$qry_result = mysqli_query($conn, $qry);
					if($qry_result) {
						$success = True;
					}
				} else {
					$error_msg = "Must enter all values";
				}

				// Show any errors to the user
				if(isset($error_msg)) {
					echo "<p color='red'>".$error_msg."</p>";
				}
				// Show success to the user.
				else if(isset($success) && $success) {
					echo "<p color='green'>Menu item saved!</p>";
				}
			// The user is retrieving details for a specific menu item/
			} else if(!empty($_GET['item_id'])) {
				$item_id = $_GET['item_id'];
				$qry_result = mysqli_query($conn, "SELECT * FROM menu_item where id= {$item_id}");
				$menu_item = mysqli_fetch_assoc($qry_result);
				$name = $menu_item["name"];
				$description = $menu_item["description"];
				$category = $menu_item["category"];
				$price = $menu_item["price"];
				$active = ($menu_item["active"] >0) ? True : False;
			}
			// New menu item to be created, so start all variables to empty.
			else {
				$item_id = "";
				$name = "";
				$description = "";
				$category = "";
				$price = "";
				$active = True;
			}
		?>

		<form action="editmenuitem.php" class="form" method="POST" enctype="multipart/form-data">
			<input name="item_id" type="hidden" value="<?= $item_id; ?>">
			<label for="name">Name</label>
			<input type="text" name="name" value="<?= $name; ?>" autocomplete="off" required>
			<label for="description">Description</label>
			<input type="text" name="description" value="<?= $description; ?>" autocomplete="off" required>
			<label for="category">Category</label>
			<select name="category" id="category">
		<?php
			// Add the menu categories, and preselect a category if relevant
			$qry_result = mysqli_query($conn, "SELECT name FROM menu_category")->fetch_all(MYSQLI_ASSOC);
			foreach($qry_result as $category_vals):
				$selected = ($category == $category_vals["name"]) ? "selected" : "";
		?>
			<option value="<?= $category_vals['name']; ?>" <?= $selected; ?> ><?= $category_vals['name']; ?></option>
			<?php endforeach; ?>
			</select>
			<label for="price">Price</label>
			<!-- Prices can only be incremented by cents. -->
			<input type="number" min="0.00" step="0.01" name="price" value="<?= $price; ?>" autocomplete="off" required>
			<label for="active">Active</label>
			<input type="checkbox" name="active" <?= $active ? "checked" : "" ?> />
			<input type="file" name="photo" id="photo">

			<input type="submit" name="save" value="Save">
			<input type="button" name="cancel" value="Cancel" onClick="window.location.href='/editmenu.php';">
		</form>
		<?php include_once($_SERVER['DOCUMENT_ROOT']."/Footer.php"); ?>
	</div>
</body>
</html>	
