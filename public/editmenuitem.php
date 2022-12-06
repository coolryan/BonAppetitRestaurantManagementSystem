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
	<style type="text/css"><?php include 'CSS/Main.css';?></style>
</head>
<body>
	<div id="content">
		<?php
			require_once("Header.php");
			require_once("Connect.php");
			require_once("utils.php");
			checkAndStartSession();

			if (isset($_POST['name'])) {
				$item_id = (empty($_POST['item_id'])) ? null : $_POST['item_id'];
				$name = $_POST['name'];
				$category = $_POST["category"];
				$price = $_POST["price"];
				$active = (isset($_POST["active"])) ? 1 : 0;
				$description = $_POST["description"];
				
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
						$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/images/menu/";
						$target_file = $target_dir . basename($file_name);
						$relative_path = "/images/menu/" . basename($file_name);
						// echo "Target path and file: " . $target_file;
						move_uploaded_file($file_tmp,$target_file);
					}else{
						echo "Errors: " . $errors;
						$file_name = "";
					}
				} else {
					echo "No photo: ".$_FILES["photo"];
				}
				
				if($name != "" && $category != "" && $price != "") {
					echo "Item: $item_id";
					if(!isset($relative_path)) {
						$relative_path = null;
					}
					// 
					if($item_id == null) {
						$qry = "INSERT INTO menu_item (name, description, price, active, image_path, category) VALUES ('{$name}', '{$description}', {$price}, {$active}, '{$relative_path}', '{$category}')";
					}
					else {
						$qry = "UPDATE menu_item SET name='{$name}', description='{$description}', price={$price}, active={$active}, image_path='{$relative_path}', category='{$category}' WHERE id={$item_id}";
					}
					// echo "Query: " . $qry;
					$qry_result = mysqli_query($conn, $qry);
					if($qry_result) {
						$success = True;
					}
				} else {
					$error_msg = "Must enter all values";
				}

				if(isset($error_msg)) {
					echo "<p color='red'>".$error_msg."</p>";
				} else if(isset($success) && $success) {
					echo "<p color='green'>Menu item saved!</p>";
				}
			} else if(!empty($_GET['item_id'])) {
				$item_id = $_GET['item_id'];
				$qry_result = mysqli_query($conn, "SELECT * FROM menu_item where id= {$item_id}");
				$menu_item = mysqli_fetch_assoc($qry_result);
				$name = $menu_item["name"];
				$description = $menu_item["description"];
				$category = $menu_item["category"];
				$price = $menu_item["price"];
				$active = ($menu_item["active"] >0) ? True : False;
			} else {
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
			$qry_result = mysqli_query($conn, "SELECT name FROM menu_category")->fetch_all(MYSQLI_ASSOC);
			foreach($qry_result as $category_vals):
				$selected = ($category == $category_vals["name"]) ? "selected" : "";
		?>
			<option value="<?= $category_vals['name']; ?>" <?= $selected; ?> ><?= $category_vals['name']; ?></option>
			<?php endforeach; ?>
			</select>
			<label for="price">Price</label>
			<input type="number" min="0.00" step="0.01" name="price" value="<?= $price; ?>" autocomplete="off" required>
			<label for="active">Active</label>
			<input type="checkbox" name="active" <?= $active ? "checked" : "" ?> />
			<input type="file" name="photo" id="photo">

			<input type="submit" name="save" value="Save">
			<input type="button" name="cancel" value="Cancel" onClick="window.location.href='/editmenu.php';">
		</form>
		<?php include_once('Footer.php'); ?>
	</div>
</body>
</html>	
