<?php 

$page_title = "Delete a Post";
require('includes/header.html');

echo "<div class = 'col-sm-6'>";

require('includes/login_functions.inc.php');

$query = "SELECT subject, body, user_id FROM messages WHERE id = {$_GET['id']}";
$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

if (!LOGGEDIN || $row['user_id'] !== $_COOKIE['id']) { // Make sure user is author of the question by redirecting everyone else
	redirect_user();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$confirmation = $_POST['confirm'];
	if ($confirmation == "no") { // If the user cancels the deletion
		echo "The post was <em>not</em> deleted. Redirecting you now...";
		echo "<script>	setTimeout(function() {
		console.log(\"Hello, Hello\");
		window.location.href = \"/Questions\";
	}, 1000);</script>";
	} else { // If the user confirms deletion
		$q = "DELETE FROM messages WHERE id = {$_GET['id']}";
		$r = mysqli_query($dbc, $q);
		if (mysqli_affected_rows($dbc) == 1) { // If the deletion was successful
			echo "The post was successfully deleted. Redirecting you now...";
			echo "<script>	setTimeout(function() {
			console.log(\"Hello, Hello\");
			window.location.href = \"/Questions\";
			}, 1000);</script>";
		} else {
			echo "The deletion was not successful.";
		}		
	}

} else {
	echo "<form id = 'delete-post' method = 'post' action = ''>";
	?>

	<p>
		<label>Are you sure you want to delete this post?</label>
		<input name = "confirm" type = "radio" id = "yes" value = "Yes">
		<label style = "font-weight: 400" for = "yes">Yes</label>
		<input name = "confirm" type = "radio" value = "no" id = 'no'>
		<label for = "no" style = "font-weight: 400">No</label>
	</p>
	<input type = "submit" value = "Confirm Deletion">

	<?php
	echo "</form>";
}
require('includes/footer.html');

?>