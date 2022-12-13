<?php
// Filename: api/controller/MenuController.php
// Author: Ryan Setaruddin
// BCS 350- Web Database Developement
// Professor Kaplan
// Date: December 7, 2022
// Purpose: Handle menu API endpoints

namespace api\Controller;
// Import some needed PHP files
require_once($_SERVER['DOCUMENT_ROOT']."/utils.php");
// Start the session so we know if a user is logged in and who it is
checkAndStartSession();

// This allows us to use the MenuDAO for interacting with MySQL
use dao\MenuDAO;
require($_SERVER['DOCUMENT_ROOT']."/DAO/menu.php");

// This class handles requests to the menu api
class MenuController {

	public function __construct($conn, $requestMethod)
    {
        $this->conn = $conn;
        $this->requestMethod = $requestMethod;
        $this->menuDAO = new MenuDAO($conn);
    }

    // Process an HTTP request
    public function processRequest()
    {
    	switch ($this->requestMethod) {
    		case 'GET':
    			$response['status_code_header'] = 'HTTP/1.1 200 OK';
    			$result = $this->menuDAO->find_all_active();
        		$response['body'] = json_encode($result);
    			break;
    		default:
    			$response = $this->notFoundResponse();
    			break;
	    }
		header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
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