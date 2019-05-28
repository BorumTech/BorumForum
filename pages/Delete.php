<?php 

$page_title = "Delete a Question";
require('includes/header.html');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$confirmation = $_POST['confirm'];
	if ($confirmation == "no") {
		echo "The question was <em>not</em> deleted. Redirecting you now...";
		redirect_user("/Questions");
	}
	$q = "DELETE FROM messages WHERE id = {$_GET['id']}";
	$r = mysqli_query($dbc, $q);
	if (mysqli_affected_rows($dbc) == 1) {
		echo "The question was successfully deleted. Redirecting you now...";
	} else {
		echo "The deletion was not successful.";
	}
} else {
	echo "<form onsubmit = 'deleteSubmission()' method = 'post' action = ''>";
	?>

	<p>
		<label>Are you sure you want to delete this question?</label>
		<input name = "confirm" type = "radio" id = "yes" value = "Yes">
		<label style = "font-weight: 400" for = "yes">Yes</label>
		<input name = "confirm" type = "radio" value = "No" id = 'no'>
		<label for = "no" style = "font-weight: 400">No</label>
	</p>
	<input type = "submit" value = "Confirm Deletion">

	<?php
	echo "</form>";
}
require('includes/footer.html');

?>