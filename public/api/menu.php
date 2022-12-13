<?php
// Filename: api/menu.php
// Author: Ryan Setaruddin
// BCS 350- Web Database Developement
// Professor Kaplan
// Date: December 7, 2022
// Purpose: Entry point for menu API
use api\Controller\MenuController;
require_once($_SERVER['DOCUMENT_ROOT']."/utils.php");
checkAndStartSession();
require_once($_SERVER['DOCUMENT_ROOT']."/Connect.php");
require($_SERVER['DOCUMENT_ROOT']."/api/controller/MenuController.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );



$requestMethod = $_SERVER["REQUEST_METHOD"];

// pass the request method and user ID to the MenuController and process the HTTP request:
$controller = new MenuController($conn, $requestMethod);
$controller->processRequest();

?>