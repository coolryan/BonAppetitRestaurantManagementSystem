<!--
Filename: Login.php
Author: Ryan Setaruddin
BCS 350- Web Database Developement
Professor Kaplan
Date: Oct. 11, 2022
Purpose: To allow the owner, admins, and staff of restaurant to login without having to going back to the registration page
-->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login page</title>
	<link rel="stylesheet" type="text/css" href="CSS/Main.css">
</head>
<body>
	<div id="content">
		<?php
			// include our connect script
			require_once($_SERVER['DOCUMENT_ROOT']."/utils.php");
			// Start the session so we know if a user is logged in and who it is
			checkAndStartSession();
			// Display the header
			require_once($_SERVER['DOCUMENT_ROOT']."/Header.php");
			require_once($_SERVER['DOCUMENT_ROOT']."/Connect.php");
			// check to see if there is a user already logged in, if so redirect them
			
			if (!empty($_SESSION['email'])) {
				// redirect the user to the Welcome page
				header("Location: Welcome.php");
			}
		?>
		<h1>Login</h1>
		<?php
			// check to see if the user clicked the login buttion
			if (!empty($_POST['loginBtn'])) {
				// get the form data for processing
				$email = $_POST['email'];
				$passwd = $_POST['passwd'];

				// make sure the required fileds were entered
				if ($email != "" && $passwd != "") {
					// query the database to see if the email exists
					$query = "SELECT u.*, ut.name as user_type_name FROM user u left join user_type ut on u.user_type=ut.id WHERE email='{$email}'";
					$result = mysqli_query($conn, $query);
					if (mysqli_num_rows($result) == 1) {
						// get the record from the query
						$record = mysqli_fetch_assoc($result);
						// encrypt the user's passowrd
						$passwd = md5($passwd);
						// compare the passwords to make sure they are match
						if ($passwd === $record['password']) {
							// make sure the user has activated their account
							if ($record['status'] == 1) {
								// upadte the last_login tracker
								$last_login = time();

								$user_id = $record['id'];
								$qry = "UPDATE user SET last_login='{$last_login}' WHERE id='{$user_id}'";
								mysqli_query($conn, $qry);

								// IF YOU GET HERE THE USER CAN LOGIN
								$_SESSION['user_id'] = $record['id'];
								$_SESSION['email'] = $record['email'];
								$_SESSION['userID'] = $record['id'];
								$_SESSION['user_type_name'] = $record['user_type_name'];

								$success = true;

								// redirect the user back the home page
								header("Location: Welcome.php");
							}
							else
								$error_msg = "Please activate your account before you login.";
						}
						else
							$error_msg = "Your password was incorrect.";
					}
					else
						$error_msg = "That account does not exist.";
				}
			else
				$error_msg = "Please fill out all required fields";
			}

			// check to see if the user successfully created an account
			if (isset($success) && $success = true) {
				echo "<font color='green'>You have logged in. Please go to the <a href='Welcome.php'>Home</a>.</font>";
			}
			// check to see if the error meesage is set, if so display it
			elseif (isset($error_msg)) {
				echo "<font color='red'>".$error_msg."</font>";
			}
		?>
		<!-- Login Form will take the usre's inputs -->
		<form action="Login.php" method="POST" name="loginForm" id="loginForm">
			<table>
				<tr><td>Email: <font color="red">*</font></td></tr>
				<tr><td><input type="text" name="email" value="" placeholder="Provide an email" size="35" required></td></tr>
				<tr><td>Password: <font color="red">*</font></td></tr>
				<tr><td><input type="password" name="passwd" value="" placeholder="Enter a password" size="35" required></td></tr>
				<tr><td>
					<input type="submit" name="loginBtn" value="Login">
					<font color="red">*</font> = required fields
				</td></tr>
			</table>
		</form>
		<!-- Footer -->
		<?php require_once($_SERVER['DOCUMENT_ROOT']."/Footer.php"); ?>
	</div>
</body>
</html>