<?php 

$page_title = "Contact Us";
require("includes/header.html");
?>
<div class = "col-sm-7">
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$subject = trim($_POST['subject']);
	$body = trim($_POST['body']);

	// Fetch email from database
	$q = "SELECT id, email FROM users WHERE id = {$_SESSION['id']}";
	$r = mysqli_query($dbc, $q);
	$row = mysqli_fetch_array($r, MYSQLI_NUM);
	$email = $row[1];

	sendEmail($subject, $email . "<br>" . $body, "VSpoet49@gmail.com", "<h3>Thanks for contacting us! We will respond within the next 3 days.</h3>");
	include('includes/footer.html');
	exit();
}

?>

<h1>Contact Us</h1>
<button style = "display: <?php echo !LOGGEDIN ? 'block' : 'none' ?>" type = "button" onclick = "window.location.href = '/Login';">Log In</button>
<form style = "display: <?php echo LOGGEDIN ? 'block' : 'none' ?>" action method = "post">
	<p>
		<label for = "subject">Subject: </label>
		<input required type = "text" id = "subject" name = "subject" size = "100">
	</p>
	<p>
		<label for = "body">Details</label>
		<textarea required name = "body" id = "body" cols = "50"></textarea>
	</p>
	<input type = "submit" value = "Send message">
</form>

<?php 
include('includes/footer.html'); 
?>

