<?php
// Filename: DAO/menu.php
// Author: Ryan Setaruddin
// BCS 350- Web Database Developement
// Professor Kaplan
// Date: December 9, 2022
// Purpose: This class provides a wrapper the IMS MySQL DB.
namespace dao;

class MenuDAO {

    private $conn = null;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function find_all()
    {
        $qry = "
            SELECT 
                id, name, description, price, active, category, image_path
            FROM
                menu_item;
        ";

        try {
            $qry_result = mysqli_query($this->conn, $qry);
            $menu_data = $qry_result->fetch_all(MYSQLI_ASSOC);
            return $menu_data;
        } catch (Exception $e) {
            echo 'Caught exception fetching all menu items: ',  $e->getMessage(), "\n";
        }
    }
    public function find_all_active()
    {
        $qry = "
            SELECT 
                id, name, description, price, active, category, image_path
            FROM
                menu_item
            WHERE 
            	active>0;
        ";

        try {
            $qry_result = mysqli_query($this->conn, $qry);
            $menu_data = $qry_result->fetch_all(MYSQLI_ASSOC);
            return $menu_data;
        } catch (Exception $e) {
            echo 'Caught exception fetching all menu items: ',  $e->getMessage(), "\n";
        }
    }
    // Adds a menu item to an order. Creates the order it doesn't exist yet.
    public function add_item_to_meal_order($order_id, $restaurant_table_id, $in_store, $server_id, $menu_item, $instructions)
    {
    	if(empty($order_id)) {
    		$order_id = create_meal_order($restaurant_table_id, $in_store, $server_id, 0);
    	}
    	$qry = "INSERT INTO meal_order_menu_item (meal_order_id, menu_item_id, instructions) " . 
    		"VALUES ($order_id, $menu_item, '$instructions')";
    	echo $qry;
    	try {
    		$qry_result = mysqli_query($this->conn, $qry);
            if($qry_result)
    			return $order_id;
    		else
    			throw new Exception("Failure to add item to meal order.");
    	} catch (Exception $e) {
            echo 'Caught exception creating meal order: ',  $e->getMessage(), "\n";
        }
    }
    public function create_meal_order($restaurant_table_id, $in_store, $server_id, $tip) {
    	if($in_store!=0)
    		$in_store = 1;

    	if(!isset($restaurant_table_id) || empty($restaurant_table_id))
    		$restaurant_table_id = "NULL";
    	if(!isset($server_id) || empty($server_id))
    		$server_id = "NULL";

    	$qry = "INSERT INTO meal_order (restaurant_table_id, in_store, server_id, tip) " .
    		"VALUES ($restaurant_table_id, $in_store, $server_id, $tip)";
    	try {
    		$qry_result = mysqli_query($this->conn, $qry);
    		if($qry_result)
    			$order_id = mysqli_insert_id($this->conn);
    		else
    			throw new Exception("Failure to create meal order.");
            
            return $order_id;
    	} catch (Exception $e) {
            echo 'Caught exception creating meal order: ',  $e->getMessage(), "\n";
        }
    }
}
?>