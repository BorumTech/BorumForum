<?php 
# Script 10.3 - edit_user.php
# This page is for editing a user record, accessed through view_users.php
# Made by Varun Singh, adapted from Larry Ullman, 1/3/2019

$page_title = 'Edit a User';
include('includes/header.html');
echo "<div class = 'col-sm-6'>";
require('includes/login_functions.inc.php');
if (!ISADMIN && !(isset($_SESSION['id']) && isset($_GET['id']) && $_SESSION['id'] == $_GET['id'])) {
	redirect_user('../index');
}

?>

<h1>Edit a User</h1>

<?php 

// Check for a valid user ID value using get or post
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
	$id = $_GET['id'];
} elseif (isset($_POST['id']) && is_numeric($_POST['id'])) {
	$id = $_POST['id'];
} else { // If no valid ID, kill the script
	echo '<p class = "error">This page has been accessed by error</p>';
	include('includes/footer.html');
	exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$errors = [];

	// Validate the first name
	if(empty($_POST['first_name'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
	}

	// Validate the last name
	if(empty($_POST['last_name'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
	}

	// Validate the email address
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}

	// Validate the username
	if (empty($_POSt['username'])) {
		$error[] = 'You forgot to enter your username.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}


	// If there were no errors, check that the submitted email address is not aready in use
	if (empty($errors)) {
		$q = "SELECT id FROM users WHERE email='$e' AND id != $id"; // Check if anyone else has the email address given
		$r = @mysqli_query($dbc, $q);
		if (mysqli_num_rows($r) == 0) { // If no other users have this email address, it is safe to perform the update

			// Perform the update
			$q = "UPDATE users SET first_name='$fn', last_name='$ln', email='$e', username = '$u' WHERE id=$id LIMIT 1";
			$r = @mysqli_query($dbc, $q);

			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK
				echo '<p>The user has been edited.</p>';
			} else { // If it did not run OK
				echo '<p class = "error">The user could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message

				echo '<p>' . mysqli_error($dbc) . '<br>Query: ' . $q . '</p>'; // Debugging message
			}
		} else { // Already registered
			echo '<p class = "error">The email address has already been registered.</p>';
		}
	} else { // Report the errors
		echo '<p class = "error">The following error(s) occured:<br>';
		foreach ($errors as $msg) { // Print each error
			echo " - $msg<br>\n";
		}
		echo '</p><p>Please try again.</p>';
	}
}

$q = "SELECT first_name, last_name, username, email FROM users WHERE id=$id";
$r = @mysqli_query($dbc, $q);
if (mysqli_num_rows($r) == 1) {
	$row = mysqli_fetch_array($r, MYSQLI_NUM);
	echo '<form action = "edit_user.php" method = "post">
		<p>
			<label for = "first_name">First Name: </label>
			<input type = "text" name = "first_name" size = "15" maxlength = "15" value = "' . $row[0] . '">
		</p>
		<p>
			<label for = "last_name">Last Name: </label>
			<input type = "text" name = "last_name" size = "15" maxlength = "30" value = "' . $row[1] . '">
		</p>
		<p>
			<label for = "email">Email Address: </label>
			<input type = "email" name = "email" size = "20" maxlength = "60" value = "' . $row[2] . '">
		</p>
		<p>
			<input type = "submit" name = "submit" value = "Submit">
		</p>
		<input type = "hidden" name = "id" value = "' . $id . '">
		</form>';

} else {
	echo '<p class = "error">This page has been accessed in error.</p>';
}

mysqli_close($dbc);
include('includes/footer.html');

?>

