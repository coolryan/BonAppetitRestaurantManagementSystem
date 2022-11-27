<!--
Filename: utils.php
Author: Ryan Setaruddin
BCS 350- Web Database Developement
Professor Kaplan
Date: November 26, 2022
Purpose: These are the function helpers 
-->
<?php
	function test() {
		return "The text is from the test";
	}
	function checkAndStartSession() {
		if(session_status() === PHP_SESSION_NONE)
			session_start();
	}
	function isLoggedIn() {
		checkAndStartSession();
		if (isset($_SESSION['email']))
			return true;
		else
			return false;
	}
	function isOwner() {
		// $is_owner = False;
		// if(isLoggedIn()) {
		// 	return $_SESSION['user_type_name']=="owner";
		// }
		// return $is_owner;
		return checkRoles("owner");
	}
	function isManager() {
		// $is_manager = False;
		// if(isLoggedIn()) {
		// 	return $_SESSION['user_type_name']=="manager";
		// }
		// return $is_manager;
		return checkRoles("manager");
	}
	function isStaff() {
		return checkRoles("staff");
	}
	function checkRoles($rolesToCheck) {
		if(!isset($rolesToCheck))
			return False;
		if(!isLoggedIn())
			return False;

		if(!is_array($rolesToCheck))
			$rolesToCheck = array($rolesToCheck);

		foreach($rolesToCheck as $role) {
			if($role == $_SESSION['user_type_name']) {
				return True;
			}
		}
		return False;
	}
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