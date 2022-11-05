<?php
	if(!empty($_GET['item'])) {
		echo "You want menu item: {$_GET['item']}";
	} else {
		echo "You want to create a new menu item";
	}
?>