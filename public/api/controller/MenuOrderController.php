<?php
// Filename: api/controller/MenuOrderController.php
// Author: Ryan Setaruddin
// BCS 350- Web Database Developement
// Professor Kaplan
// Date: December 9, 2022
// Purpose: Handle menu API endpoints

namespace api\Controller;
// Import some needed PHP files
require_once($_SERVER['DOCUMENT_ROOT']."/utils.php");
// Start the session so we know if a user is logged in and who it is
checkAndStartSession();

// This allows us to use the MenuDAO for interacting with MySQL
use dao\MenuDAO;
require($_SERVER['DOCUMENT_ROOT']."/DAO/menu.php");

// This class handles requests to the menu order api
class MenuOrderController {
	public function __construct($conn, $requestMethod)
    {
        $this->conn = $conn;
        $this->requestMethod = $requestMethod;
        $this->menuDAO = new MenuDAO($conn);
    }

    // This API endpoint's data must come as:
    // {
    //     "order_id": int // Order id. Optional, if excluded will create new order
    //     "restaurant_table_id": int // Id. The table if eating at restaurant
    //     "server_id": int // Id. The server of the table.
    //     "tip": float // The tip given.
    //     "in_store": bool // Whether the orde was in store or online
    //     "order_date": date // Can be left blank and will auto create
    //     "items": [ // A list of items to be added to the order
    //         "menu_item_id" // The menu item being added to the order
    //         "instructions" // Any special instructions
    //     ]
    // }
    public function processRequest($post_data)
    {
        // Handle different request methods
    	switch ($this->requestMethod) {
    		case 'POST':;
    			$response['status_code_header'] = 'HTTP/1.1 200 OK';
                // Make sure data was submitted in the post
                if(!empty($post_data)) {
                    if(empty($post_data["order_id"])) {
                        // New order
                        // If a new order, make sure in_store is defined
                        if(!array_key_exists("in_store", $post_data)) {
                            $error = "Must define whether in store or not.";
                            break;
                        } else 
                        // Translate the instore values
                            $in_store = $this->getInStore($post_data["in_store"]);

                        // If in store, make sure required fields are defined
                        if($in_store == 1) {
                            if(empty($post_data["restaurant_table_id"])) {
                                $error = "If in store, must define restaurant table.";
                                break;
                            }
                            if(empty($post_data["server_id"])) {
                                $error = "If in store, must define the server.";
                                break;
                            }
                            $restaurant_table_id = $post_data["restaurant_table_id"];
                            $server_id = $post_data["server_id"];
                        }
                        // Check for tip, and set to 0 if non-existant
                        if(!isset($post_data["tip"]) || empty($post_data["tip"]))
                            $tip = 0;
                        else
                            $tip = $post_data["tip"];

                        // Create the new order
                        $order_id = $this->menuDAO->create_meal_order($restaurant_table_id, $in_store, $server_id, $tip);

                    } else
                        $order_id = $post_data["order_id"];

                    // Now lets add menu items to order
                    $error = $this->addMenuItemsToOrder($order_id, $post_data);
                    $results = array("orderId" => $order_id);
                    $response['body'] = json_encode($results);
                }
        		else
                    $error = "Must post some data";

    			break;
    		default:
    			$response = $this->notFoundResponse();
    			break;
	    }
        // Return any errors encountered
        if(isset($error)) {
            $response['status_code_header'] = 'HTTP/1.1 400 BAD REQUEST';
            header($response['status_code_header']);
            echo $error;
            return;
        }
        // Success, so return the result
		header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }
    // Convert different in store values to an int
    private function getInStore($value) {
        if($value == 0 || $value == "0" || $value == False || strtolower($value) == "false")
            return 0;
        else
            return 1;
    }
    // Add menu items to a specific order
    private function addMenuItemsToOrder($order_id, $post_data) {
        if(!isset($post_data["items"]) || empty($post_data["items"]))
            return "There are no items to add to the order";

        foreach($post_data["items"] as $order_item) {
            if(!isset($order_item["menu_item_id"])) {
                return "Missing menu_item_id for menu item.";
            }
            if(!isset($order_item["instructions"])) {
                return "Missing instructions for menu item.";
            }
            $menu_item_id = $order_item["menu_item_id"];
            $instructions = $order_item["instructions"];

            $this->menuDAO->add_item_to_meal_order($order_id, "", "", "", $menu_item_id, $instructions);
        }
    }
    // Return a not found error
    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}
?>