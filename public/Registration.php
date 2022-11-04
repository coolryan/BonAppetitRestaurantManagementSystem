<!--
Filename: Registration.php
Author: Ryan Setaruddin
BCS 350- Web Database Developement
Professor Kaplan
Date: Oct. 11, 2022
Purpose: To create registration page for owner of the restaurant "Bon Appetit Paris" so that he or she can craete thier account
-->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bon Appetit Paris Restaurant Mangement system | registration form</title>
	<link rel="stylesheet" type="text/css" href="CSS/Main.css">
</head>
<body>
	<h1>Bon Appetit Paris Restaurant Mangement System-Register</h1><br>
	<h2><b>Create Owner account</b></h2>
	<?php
		// include our connect script
		require_once("Connect.php");

		// check to see if there is a user already logged in, if so redirect them
		session_start();
		if (isset($_SESSION['email'])) {
			// redirect the user to the home page
			header("Location: Welcome.php");
		}

		// check to see if the user clicked the register button
		if (isset($_POST['email'])) {
			// get all of the form data
			$first_name = $_POST['fname'];
			$last_name = $_POST['lname'];
			$email = $_POST['email'];
			$passwd = $_POST['passwd'];
			$passwd_again = $_POST['confirm_password'];
		}

		// Only the owner can register. Everyone else should be added by the owner or manager
		$result = $conn->query("SELECT * FROM users WHERE user_type=1");
		if ($result->num_rows > 0) {
			$error_msg = "Only the owner can register.";
		}

		// verify all the required form data was entered
		else if ($email != "" && $passwd != "" && $passwd_again != "") {
			// make sure the two passwords are match
			if ($passwd === $passwd_again) {
				// make sure the password meets the min strength requirements
				if (strlen($passwd) >= 8 && strpbrk($passwd, "!#$.,:;()") != false) {
					// query the database to see the email is taken
					// $query = mysqli_query($conn, "SELECT * FROM users WHERE email='{email}'");
					$query = $conn->prepare("SELECT * FROM users WHERE email=?");
					$query->bind_param('s', $email);
					$query->execute();
					$query->store_result();
					if ($query->num_rows == 0) {
						// create and format some variables for the database
						$passwd = md5($passwd);
						$date_created = date('Y-m-d H:i:s');
						$status = true;
						$user_type = 1; // Owner

						// insert the user into database
						$qry = "INSERT INTO users (first_name, last_name, email, password, date_created, status, user_type)
							VALUES ('{$first_name}', '{$last_name}', '{$email}', '{$passwd}', '{$date_created}', '{$status}', '{$user_type}')";
						echo "Executing query: ".$qry;
						$result = mysqli_query($conn, $qry);
						echo "Insert result".$result;
						//verify the user's account was created
						$query = mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'");
						if (mysqli_num_rows($query) == 1) {
							// IF WE ARE HERE THEN THE ACCOUNT WAS CREATED YAY!
							// WE WILL SEND EMAIL ACTIVATION CODE HERE LATER

							$success = true;
						}
						else
							$error_msg = "An error occurred and your account was not created.";
					}
					else
						$error_msg = "The email<i>".$email."</i> is already taken. Please use another.";
				}
				else
					$error_msg = "Your password is not strong enough. Please use another.";
			}
			else
				$error_msg = "Your password did not match.";
		}
		else
			$error_msg = "Please fill out all required fields";

		// check to see if the user successfully created account
		if (isset($success) && $success == true) {
			echo "<p color='green'>Yay!! Your account has been created. <a href='Login.php'>Click here</a> to login!</p>";
		}

		// check to see if the error meeage is set, if so display it
		else if (isset($error_msg)) {
			echo "<p color='red'>".$error_msg."</p>";
		}
		else {
			// do nothing
			echo "Do nothing";
		}
	?>
	<form action="Registration.php" class="form" method="POST">
		<div class="container1">
			First Name:
			<input type="text" name="fname" value="" autocomplete="off" required><br>
			Last Name:
			<input type="text" name="lname" value="" autocomplete="off" required><br>
			Email:
			<input type="text" name="email" value="" placeholder="Provide an email" autocomplete="off" required><br>
			Password:
			<input type="password" name="passwd" value="" placeholder="Enter a password" autocomplete="off" required>
			<p><font>password must be at least 8 characters and<br/> have a special character, e.g. !#$.,:;()</font></p>
			Confirrm password:
			<input type="password" name="confirm_password" value="" placeholder="confirm your password" autocomplete="off" required><br>
			<input type="submit" name="registerBtn" value="Create Owner account"><br>
			<p>Already have an account? <a href="Login.php">Login here</a></p>
		</div>
	</form>
</body>
</html>