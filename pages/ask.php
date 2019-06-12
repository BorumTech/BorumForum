<?php 
# This script lets a logged in user ask a question on the site
# Varun Singh, 3/30/2019

$page_title = "Ask a Question";
include('includes/header.html');

require('includes/login_functions.inc.php');

if (!isset($_COOKIE['id'])) {
	redirect_user('../Login');
}

?>
<div class = "col-sm-6">
<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Validate the form elements
	$sub = mysqli_real_escape_string($dbc, trim($_POST['subject']));
	$bod = mysqli_real_escape_string($dbc, trim($_POST['body']));
	$tag = mysqli_real_escape_string($dbc, trim($_POST['tag']));
	$id = $_COOKIE['id'];

	// Check if its okay for the user to ask the question
	$q = "SELECT id FROM messages WHERE subject = '$sub' OR body = '$bod'";
	$r = @mysqli_query($dbc, $q);
	$num = mysqli_num_rows($r);

	if ($num == 0) { // No questions that match this one (no duplicates)
		$q = "SELECT id, name FROM topics WHERE name = '$tag'";
		$r = mysqli_query($dbc, $q);
		$val = mysqli_fetch_array($r, MYSQLI_NUM)[0];

		$q = "INSERT INTO messages (parent_id, forum_id, user_id, subject, body, date_entered) VALUES (0, $val, $id, '$sub', '$bod', NOW())";
		$r = @mysqli_query($dbc, $q);

		if ($r) { // If it ran OK
			$r = @mysqli_query($dbc, "SELECT id FROM messages ORDER BY id DESC LIMIT 1");
			$val = mysqli_fetch_array($r, MYSQLI_NUM);
			redirect_user("../Questions/{$val[0]}");
		} else {
			echo "A system error occured. We apologized for the inconvenience. ";
			echo mysqli_error($dbc);
		}
	} else {
		echo "There was a duplicate. Question not asked";
	}

	mysqli_close($dbc);	
}

?>

<form action = "" method = "post">
	<h1>Ask a Question</h1>
	<p>
		<label for = "subject">Question Title:</label> <br>
		<input required type="text" name="subject" id = "subject" size = "90" placeholder="What's your question about Boron? Be specific"> <br>
	</p>
	<p>
		<label for = "body">Question Description:</label> <br>
		<textarea id = "body" name = "body" rows = "10" cols = "50"></textarea> <br>
	</p>
	<p>
		<label for = "tag">Tag</label><br>
		<input type = "text" id = "tag" name = "tag">
	</p>
	<input type = "Submit" value = "Ask Question">
</form>

<?php

include('includes/footer.html');
?>

