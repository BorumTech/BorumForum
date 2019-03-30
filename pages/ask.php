<?php 
$page_title = "Ask a Question";
include('includes/header.html');

require_once('../../../mysqli_connect.inc.php');
require('includes/login_functions.inc.php');

if (!isset($_COOKIE['id'])) {
	redirect_user('register.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$sub = $_POST['subject'];
	$bod = $_POST['body'];
	$id = $_COOKIE['id'];
	mysqli_query($dbc, "INSERT INTO messages (forum_id, user_id, subject, body, date_entered) VALUES (1, $id, $sub, $bod, NOW())");
	echo mysqli_num_rows($result);
	if ($result) {
		$result = @mysqli_query($dbc, "SELECT id FROM messages ORDSER BY id DESC LIMIT 1");
		$val = mysqli_fetch_array($result);
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
	<input type = "Submit" value = "Ask Question">
</form>

<?php

include('includes/footer.html');
?>

