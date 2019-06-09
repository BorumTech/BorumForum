<?php
# This script lets a user change their password
# Varun Singh, 12/21/2018

$page_title = 'Change Your Password';
include('includes/header.html');
?>

<?php 

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		require('../../mysqli_connect.inc.php'); // Connect to the database

		$errors = []; // Initialize an error array

		// Check for email address
		if (empty($_POST['email'])) {
			$errors[] = 'You forgot to enter your email address. ';
		} else {
			$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
		}

		// Check for current password
		if (empty($_POST['pass'])) {
			$errors[] = 'You forgot to enter you current password. ';
		} else {
			$p = mysqli_real_escape_string($dbc, trim($_POST['pass'])); 
		}

		// Check for a new password and match against the confirmed password
		if (empty($_POST['pass1'])) {
			$errors[] = 'You forgot to enter your new password. ';
		} else {
			if ($_POST['pass1'] != $_POST['pass2']) { 
				$errors[] = 'Your new password did not match the confirmed password. ';
			} else {
				$np = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
			}
		}

		// If everything is OK
		if (empty($errors)) {

			// Check that they've entered the right email address/password combination
			$query = "SELECT id FROM users WHERE (email = '$e' AND pass = SHA2('$p', 512) )";
			$result = @mysqli_query($dbc, $query);
			$num = @mysqli_num_rows($result);

			// If a match was made
			if ($num == 1) {

				// Get the id
				$row = mysqli_fetch_array($result, MYSQLI_NUM);

				// Make the UPDATE query
				$query = "UPDATE users SET pass = SHA2('$np', 512) WHERE id = $row[0]";
				$result = @mysqli_query($dbc, $query);

				// If it ran OK
				if (mysqli_affected_rows($dbc) == 1) { // If it ran OK

					// Print a message
					echo '<h1>Thank you!</h1>
					<p>Your password has been updated.</p><p><br></p>';

				} else { // If it did not run OK.
					// Public message
					echo '<h1>System Error</h1>
					<p class = "error">Your password could not be changed due to a system error. 
					We apologize for any inconvenience.</p>';

					// Debugging message
					echo '<p>'. mysqli_error($dbc) . '<br><br>Query: '. $query . '</p>';
				}

				mysqli_error($dbc); // Close the database connection

				include('/pages/includes/footer.html'); // Include the footer
				exit(); // Quit the script (to not show the form)
			} else { // Report the errors 
				echo '<h1>Error!</h1>
				<p class = "error">The email address and password do not match those on file.</p>';
			}
		} else {
			echo '>h1>Error!</h1>
			<p class = "error">The following error(s) occured:<br>';
			foreach ($errors as $msg) {
				echo " - $msg<br>\n";
			}
			echo '</p><p>Please try again.</p><p><br></p>';
		}

		mysqli_close($dbc); // Close the database connection

	}
?>

<h1>Change Your Password</h1>
<form action = "" method = "post">
	<p>
		<label>Email Address: </label>
		<input type = "email" name = "email" size = "20" maxlength = "60" value = "<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" >
	</p>
	<p>
		<label>Current Password: </label>
		<input type = "password" name = "pass" size = "10" maxlength = "20" value = "<?php if(isset($_POST['pass'])) echo $_POST['pass']; ?>" >
	</p>
	<p>
		<label>New Password: </label>
		<input type = "password" name = "pass1" size = "10" maxlength = "20" value = "<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>" >
	</p>
	<p>
		<label>Confirm New Password: </label>
		<input type = "password" name = "pass2" size = "10" maxlength = "20">
	</p>
	<p>
		<input type = "submit" name = "submit" value = "Change Password">
	</p>
</form>

<?php include('includes/footer.html'); ?>

