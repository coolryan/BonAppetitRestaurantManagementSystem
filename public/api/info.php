<?php
// Filename: api/info.php
// Author: Ryan Setaruddin
// BCS 350- Web Database Developement
// Professor Kaplan
// Date: December 13, 2022
// Purpose: Entry point for some general info provided by BE

// Import some needed PHP files
require_once($_SERVER['DOCUMENT_ROOT']."/utils.php");
// Start the session so we know if a user is logged in and who it is
checkAndStartSession();
require_once($_SERVER['DOCUMENT_ROOT']."/Connect.php");

// Set some headers necessary for making PHP be an API
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

// Set the user type
if(!isLoggedIn()) {
	$user = "Anonymous";
} else if(isOwner()) {
	$user = "Owner";
} else if(isManager()) {
	$user = "Manager";
} else if(isStaff()) {
	$user = "Staff";
} else {
	$user = "Anonymous";
}

// Build the response
$info = array("user"=>$user);
if($user!="Anonymous") {
	$info["userId"] = $_SESSION['userID'];
} else {
	$info["userId"] = null;
}


$response['status_code_header'] = 'HTTP/1.1 200 OK';
$response['body'] = json_encode($info);

// Return teh response
echo $response['body'];

?>