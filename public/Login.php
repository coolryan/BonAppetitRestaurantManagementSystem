<!--
Filename: Login.php
Author: Ryan Setaruddin
BCS 350- Web Database Developement
Professor Kaplan
Date: Oct. 11, 2022
Purpose: To allow the owner of restaurant "Bon Appetit Paris" to login without having to going back to the registration page
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
	<h1>Bon Appetit Paris Restaurant Mangement system - Login</h1>

	<?php
	require_once("Header.php");
	?>
	<div class="container1">
		<?php
			
			// include our connect script
			require_once("Connect.php");

			// check to see if there is a user already logged in, if so redirect them
			session_start();
			if (isset($_SESSION['email'])) {
				// redirect the user to the Home page
				header("Location: Welcome.php");
			}

			// check to see if the user clciked the login buttion
			
			if (empty($_POST['loginBtn'])) {
				// get the form data for processing
				$email = $_POST['email'];
				$passwd = $_POST['passwd'];

				// make sure the required fileds were entered
				if ($email != "" && $passwd != "") {
					// query the database to see if the email exists
					$query = mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'");
					if (mysqli_num_rows($query) == 1) {
						// get the record from the query
						$record = mysqli_fetch_assoc($query);
						// encrypt the user's passowrd
						$passwd = md5($passwd);
						// compare the passwords to make sure they are match
						if ($passwd === $record['password']) {
							// make sure the user has activated their account
							if ($record['status'] == 1) {
								// upadte the last_login tracker
								$last_login = time();

								$user_id = $record['id'];
								$qry = "UPDATE users SET last_login='{$last_login}' WHERE id='{$user_id}'";
								mysqli_query($conn, $qry);

								// IF YOU GET HERE THE USER CAN LOGIN
								$_SESSION['email'] = $record['em'];
								$_SESSION['userID'] = $record['id'];

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
	</div>
	<div class="container2">
		<form action="Login.php" method="POST" name="loginForm">
			<table>
				<tr><td>username: <font color="red">*</font></td></tr>
				<tr><td><input type="text" name="username" value="" size="35"></td></tr>
				<tr><td>Password: <font color="red">*</font></td></tr>
				<tr><td><input type="password" name="passwd" value="" size="35"></td></tr>
				<tr><td>
					<input type="submit" name="loginBtn" value="Login">
					<font color="red">*</font> = required fields
				</td></tr>
			</table>
		</form>
	</div>
</body>
</html>