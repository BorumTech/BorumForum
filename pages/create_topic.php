<?php 
# This page is admin-only and used to create new tags/topics
# Made by Varun Singh, 5/12/2019

$page_title = "Create New Topic";
include('includes/header.html');

if (!ISADMIN) {
	redirect_user('../index');
}

?>

<h1>Create a New Topic</h1>

<?php

// Check if a value is set
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$errors = [];

	if (empty($_POST['tagname'])) {
		$errors[] = "You did not enter a tag name";
	} else {
		$nt = mysqli_real_escape_string($dbc, trim($_POST['tagname']));
	}

	if (empty($errors)) {
		$q = "SELECT id, name FROM topics WHERE name = '$nt'";
		$r = @mysqli_query($dbc, $q);

		if (mysqli_num_rows($r) == 0) {

			$q = "INSERT INTO topics (name) VALUES ('$nt')";
			$r = @mysqli_query($dbc, $q);

			if (mysqli_affected_rows($dbc) == 1) {
				echo "<p>The new topic has been added.</p>";
			} else {
				echo '<p class = "error">The topic could not be added due to a system error. We apologize for any inconvenience.</p>'; // Public message

				echo '<p>' . mysqli_error($dbc) . '<br>Query: ' . $q . '</p>'; // Debugging message
			}
		} else {
			echo '<p class = "error">The topic already exists</p>';
		}
	} else {
		echo '<p class = "error">The following error(s) occured:<br>';
		foreach ($errors as $msg) { // Print each error
			echo " - $msg<br>\n";
		}
		echo '</p><p>Please try again.</p>';
	}
}
?>

<form action = "" method = "post">
	<p>
		<label for = "tagname">Name of New Tag</label>
		<input type = "text" name = "tagname" id = "tagname">
	</p>
	<input type = "submit" value = "Create New Tag">
</form>

<?php

include('includes/footer.html');
?>