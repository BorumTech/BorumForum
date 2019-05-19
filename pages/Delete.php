<?php 

require('includes/header.html');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$confirmation = $_POST['confirm'];
} else {
	echo "<form method = 'post' action = '/Questions'>";
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