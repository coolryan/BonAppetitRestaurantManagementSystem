<?php
// Filename: api/menuorder.php
// Author: Ryan Setaruddin
// BCS 350- Web Database Developement
// Professor Kaplan
// Date: December 9, 2022
// Purpose: Entry point for menu order API
use api\Controller\MenuOrderController;
require_once($_SERVER['DOCUMENT_ROOT']."/Connect.php");
require($_SERVER['DOCUMENT_ROOT']."/api/controller/MenuOrderController.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );



$requestMethod = $_SERVER["REQUEST_METHOD"];

// pass the request method and user ID to the MenuOrderController and process the HTTP request:
$controller = new MenuOrderController($conn, $requestMethod);
$post_data = json_decode(file_get_contents('php://input'), true);
$controller->processRequest($post_data);
?>