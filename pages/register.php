<?php 
# Script 9.5 - register.php #2
# This script displays the registration form and handles the results by performing an INSERT query to add a record to the users table AND escapes the problematic characters in the input field using mysqli_real_escape_string()
# Varun Singh, 12/21/2018

$page_title = 'Register';
include('includes/header.html');
?>
<div class = "col-sm-6">
<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$errors = []; // Initialize an error array

	// Check for a first name
	if (empty($_POST['first_name'])) {
		$errors[] = 'You forgot to enter your first name. ';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
	}

	// Check for a last name
	if (empty($_POST['last_name'])) {
		$errors[] = 'You forgot to enter your last name. ';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
	}

	// Check for an email address
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address. ';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}

	// Check for a password and match against the confirmed password
	if (empty($_POST['pass1'])) {
		$errors[] = 'You forgot to enter your password';
	} else {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your password did not match the confirmed password. ';
		} else {
			$p = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
		}	
	}

	// Check if it's OK to register the user
	if (empty($errors)) {
		$checkEmail = "SELECT id FROM users WHERE email = '$e'";
		$ceResult = @mysqli_query($dbc, $checkEmail); // Show the row that already registered that email
		$num = mysqli_num_rows($ceResult);

		if ($num == 0) {

			$query = "INSERT INTO users (first_name, last_name, email, pass, registration_date) VALUES ('$fn', '$ln', '$e', SHA2('$p', 512), NOW() )";
			$result = @mysqli_query($dbc, $query); // Register the user into the database

			if ($result) { // If it ran OK
				// Print a message 
				echo '<h1>Thank you!</h1>
				<p>You are now registered. In Chapter 12, you will actually be able to log in!</p><p><br></p>';
				$msg = 'Hi ' . $fn . '\nThanks for registering on Borum!';
				$msg = wordwrap($msg,70);
				mail($e, 'Registration of Borum', $msg, 'From: admin@bforborum.com');
			} else { // if it ran not OK
				// Public message
				echo '<h1>System Error</h1>
				<p class = "error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';

				// Debugging message
				echo '<p>' . mysqli_error($dbc) . '<br><br>Query: ' . $query . '</p>';
			}

		} else {
			echo '<p class = "error">You could not be registered because that email has already been used.</p>';
		}

		

		mysqli_close($dbc); // Close the database connection

		include('includes/footer.html'); // Include the footer
		exit(); // Quit the script

	} else { // Report the errors
		echo '<h1>Error</h1>
		<p class = "error">The following error(s) occured: <br>'; // Public message

		foreach ($errors as $msg) { // Print each error
			echo " - $msg<br>\n";
		}

		echo '</p><p>Please try again</p><p><br></p>'; // Debugging message
	}

	mysqli_close($dbc);

}

?>

<h1>Register</h1>
<form action = "" method = "post">
	<p>
		<label>First Name: </label>
		<input type = "text" name = "first_name" size = "15" maxlength = "20" value = "<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>">
	</p>
	<p>
		<label>Last Name: </label>
		<input type = "text" name = "last_name" size = "15" maxlength = "40" value = "<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>">
	</p>
	<p>
		<label>Email Address: </label>
		<input type = "email" name = "email" size = "20" maxlength = "60" value = "<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
	</p>
	<p>
		<label>Password: </label>
		<input type = "password" name = "pass1" size = "10" maxlength = "20" value = "<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>">
	</p>
	<p>
		<label>Confirm Password: </label>
		<input type = "password" name = "pass2" size = "10" maxlength = "20"> 
	</p>
	<p>
		<input type = "submit" name = "submit" value = "Register">
	</p>
</form>

<?php include('includes/footer.html'); ?>

