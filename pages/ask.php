<?php 
$page_title = "Ask a Question";
include('includes/header.html');

require_once('../../../mysqli_connect.inc.php');
require('includes/login_functions.inc.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
}
?>

<form action = "">
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

