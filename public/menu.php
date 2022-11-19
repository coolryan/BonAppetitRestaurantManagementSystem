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

		function getByCategory($qry_result) {
			$menu_by_cat = array();
			foreach($qry_result as $menu_item) {
				$cat = $menu_item['category'];
				if(!array_key_exists($cat, $menu_by_cat)) {
					$menu_by_cat[$cat] = array();
				}
				array_push($menu_by_cat[$cat], $menu_item);
			}
			return $menu_by_cat;
		}

		$qry_result = mysqli_query($conn, "SELECT * FROM menu_item WHERE active>0")->fetch_all(MYSQLI_ASSOC);
		$menu_by_cat = getByCategory($qry_result);

		$category_order = array("Appetizers", "Main Dishes", "Desserts");

	foreach($category_order as $cat) {
		$menu_items = $menu_by_cat[$cat];
		if(!array_key_exists($cat, $menu_by_cat)) {
			continue;
		}
		echo "<h4 class='menuCategory'>{$cat}</h4>";
		foreach($menu_items as $menu_item) {
?>
		<div class="menuItem">
			<div class="menuItemName"><?= $menu_item["name"]; ?></div>
			<div class="menuItemPrice"><?= $menu_item["price"]; ?></div>
			<div class="menuItemDescription"><?= $menu_item["description"]; ?></div>
			<img class="menuItemImage" src="<?= $menu_item["image_path"]; ?>"> 
		</div>
<?php
		}

		include_once('Footer.php'); 
	?>
</body>
</html>