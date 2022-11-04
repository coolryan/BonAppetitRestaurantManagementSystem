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
?>