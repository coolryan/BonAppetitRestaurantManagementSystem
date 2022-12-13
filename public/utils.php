<?php
// Filename: utils.php
// Author: Ryan Setaruddin
// BCS 350- Web Database Developement
// Professor Kaplan
// Date: November 26, 2022
// Purpose: These are the function helpers 

// If a session is not yet started, start one
function checkAndStartSession() {
	if((empty(session_id()) && !headers_sent()) || session_status() === PHP_SESSION_NONE)
		session_start();
}
// Return whether the user is logged in or not
function isLoggedIn() {
	checkAndStartSession();
	if (isset($_SESSION['email']))
		return true;
	else
		return false;
}
// Return whether the user is an owner
function isOwner() {
	return checkRoles("owner");
}
// Return whether the user is a manager
function isManager() {
	return checkRoles("manager");
}
// Return whether the user is a staff member
function isStaff() {
	return checkRoles("staff");
}
// Check the user roles for a specific defined role
function checkRoles($rolesToCheck) {
	if(!isset($rolesToCheck))
		return False;
	if(!isLoggedIn())
		return False;

	// This function supports either a single role or an array, so cast to array if single
	if(!is_array($rolesToCheck))
		$rolesToCheck = array($rolesToCheck);

	// Loop through the roles and check if the logged in in user has any of them
	foreach($rolesToCheck as $role) {
		if($role == $_SESSION['user_type_name']) {
			return True;
		}
	}
	return False;
}
// Generate a random string from a set of characters. The length can be defined.
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@$^&*().,?';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>