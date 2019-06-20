<?php 
# Script 10.2 - delete_user.php
# This page is for deleting a user record, accesed through the view_user.php page
# Created 1/2/2019 by Varun Singh, adapted from Larry Ullman

$page_title = 'Delete a User';
include('includes/header.html');
echo "<div class = 'col-sm-6'>";
require('includes/login_functions.inc.php');
if (!ISADMIN && !(isset($_COOKIE['id']) && isset($_GET['id']) && $_COOKIE['id'] == $_GET['id'])) {
	redirect_user('../index');
}

define('ISUSER', $_COOKIE['id'] == $_GET['id']);


echo ISUSER ? '<h1 style = "color: red">Delete Your Account</h1>' : '<h1>Delete a User</h1>';


// Check for a valid user ID through GET or POST
if (isset ($_GET['id']) && is_numeric($_GET['id'])) { // From view_users.php
	$id = $_GET['id'];
}  elseif (isset($_POST['id']) && is_numeric($_POST['id'])) {
	$id = $_POST['id'];
} else { // Invalid ID, kill the script
	echo '<p class = "error">This page has been accessed in error.</p>';
	include('includes/footer.html');
	exit();
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($_POST['sure'] == 'Yes') {
		$q = "DELETE FROM users WHERE id=$id LIMIT 1"; // Make the query
		$r = @mysqli_query($dbc, $q); // Run the query

		if (mysqli_affected_rows($dbc) == 1) { // If it ran OK
			echo '<p>The user has been deleted.</p>';
		} else {
			echo '<p class = "error">The user could not be deleted due to a system error.</p>'; // Public message

			echo '<p>' . mysqli_error($dbc) . '<br>Query: ' . $q . '</p>'; // Debugging message
		}

	} else { // No confirmation of deletion
		echo '<p>The user has <em>not</em> been deleted.</p>';
	}

} else { // Show the form
	// Retrieve the user's information
	$q = "SELECT CONCAT(last_name, ', ', first_name) FROM users WHERE id=$id";
	$r = @mysqli_query($dbc, $q);

	if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form
		$row = mysqli_fetch_array($r, MYSQLI_NUM);
		echo "<h3>Name: $row[0]</h3>";
		echo ISUSER ? '<p style = "color:red"><strong>Are you sure you would like to permanently delete your account? If you confirm deletion, there is no going back. All data is deleted permanently</strong></p>' : '<p>Are you sure you want to delete this user?</p>';
		echo '<form action = "" method = "post">
		<input type = "radio" name = "sure" value = "Yes"> Yes
		<input type = "radio" name = "sure" value = "No" checked="checked"> No
		<input type = "submit" name = "submit" value = "Submit">
		<input type = "hidden" name = "id" value="' . $id . '">
		</form>';

	} else { // Invalid user ID
		echo '<p class = "error">This page has been accessed in error.</p>';
	}
}

mysqli_close($dbc);

include('includes/footer.html');
?>

