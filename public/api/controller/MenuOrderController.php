<?php
// Filename: api/controller/MenuOrderController.php
// Author: Ryan Setaruddin
// BCS 350- Web Database Developement
// Professor Kaplan
// Date: December 9, 2022
// Purpose: Handle menu API endpoints
namespace api\Controller;
use dao\MenuDAO;
require($_SERVER['DOCUMENT_ROOT']."/DAO/menu.php");

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
    	switch ($this->requestMethod) {
    		case 'POST':;
    			$response['status_code_header'] = 'HTTP/1.1 200 OK';
                if(!empty($post_data)) {
                    if(empty($post_data["order_id"])) {
                        // New order
                        if(empty($post_data["in_store"])) {
                            $error = "Must define whether in store or not.";
                            break;
                        } else 
                            $in_store = $this->getInStore($post_data["in_store"]);

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
                        if(!isset($post_data["tip"]) || empty($post_data["tip"]))
                            $tip = 0;
                        else
                            $tip = $post_data["tip"];

                        $order_id = $this->menuDAO->create_meal_order($restaurant_table_id, $in_store, $server_id, $tip);

                    } else
                        $order_id = $post_data["order_id"];

                    // Now lets add menu items to order
                    $error = $this->addMenuItemsToOrder($order_id, $post_data);
                }
        		else
                    $error = "Must post some data";

    			break;
    		default:
    			$response = $this->notFoundResponse();
    			break;
	    }
        if(isset($error)) {
            $response['status_code_header'] = 'HTTP/1.1 400 BAD REQUEST';
            header($response['status_code_header']);
            echo $error;
        }
		header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }
    private function getInStore($value) {
        if($value == 0 || $value == "0" || $value == False || strtolower($value) == "false")
            return 0;
        else
            return 1;
    }
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
    private function createOrder($post_data) {

    }
    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}
?>