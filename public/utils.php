<!--
Filename: utils.php
Author: Ryan Setaruddin
BCS 350- Web Database Developement
Professor Kaplan
Date: November 26, 2022
Purpose: These are the function helpers 
-->
<?php
	function checkAndStartSession() {
		if((empty(session_id()) && !headers_sent()) || session_status() === PHP_SESSION_NONE)
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
		return checkRoles("owner");
	}
	function isManager() {
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