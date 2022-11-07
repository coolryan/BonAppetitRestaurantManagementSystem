<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home Page</title>
	<link rel="stylesheet" type="text/css" href="CSS/Main.css">
</head>
<body>

<?php
	require_once("Header.php");
	require_once("Connect.php");
	require_once("utils.php");
	checkAndStartSession();

	if (isset($_POST['name'])) {
		$item_id = (empty($_POST['id'])) ? null : $_POST['id'];
		$name = $_POST['name'];
		$category = $_POST["category"];
		$price = $_POST["price"];
		$active = (isset($_POST["active"])) ? 1 : 0;

		if($name != "" && $category != "" && $price != "") {
			if($item_id == null) {
				$qry = "INSERT INTO menu_item (id, name, price, active, category) VALUES (NULL, '{$name}', {$price}, {$active}, '{$category}')";
			}
			else {
				$qry = "UPDATE menu_item SET name='{$name}', price={$price}, active={$active}, category='{$category}' WHERE id={$item_id}";
			}

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
	} else if(!empty($_GET['item'])) {
		$item_id = $_GET['item'];
		$qry_result = mysqli_query($conn, "SELECT * FROM menu_item where id= {$item_id}");
		$menu_item = mysqli_fetch_assoc($qry_result);
		$name = $menu_item["name"];
		$category = $menu_item["category"];
		$price = $menu_item["price"];
		$active = ($menu_item["active"] >0) ? True : False;
	} else {
		$item_id = "";
		$name = "";
		$category = "";
		$price = "";
		$active = True;
	}
?>

<form action="editmenuitem.php" class="form" method="POST">
	<div class="container1">
		<input name="id" type="hidden" value="<?= $item_id; ?>">
		<label for="name">Name</label>
		<input type="text" name="name" value="<?= $name; ?>" autocomplete="off" required><br>
		<label for="category">Category</label>
		<select name="category" id="category">
	<?php
		$qry_result = mysqli_query($conn, "SELECT name FROM menu_category")->fetch_all(MYSQLI_ASSOC);
		foreach($qry_result as $category_vals):
			$selected = ($category == $category_vals["name"]) ? "selected" : "";
	?>
			<option value="<?= $category_vals['name']; ?>" <?= $selected; ?> ><?= $category_vals['name']; ?></option>
		<?php endforeach; ?>
		</select><br>
		<label for="price">Price</label>
		<input type="number" min="0.00" step="0.01" name="price" value="<?= $price; ?>" autocomplete="off" required><br>
		<label for="active">Active</label>
		<input type="checkbox" name="active" <?= $active ? "checked" : "" ?> /> <br>

		<input type="submit" name="save" value="Save"><br>
	</div>
</form>
<?php include_once('Footer.php'); ?>
</body>
</html>	
