<?php 
session_start();
require_once('../../mysqli_connect.inc.php');
$page_title = "Contact Us";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$subject = mysqli_real_escape_string($dbc, trim($_POST['subject']));
	$body = mysqli_real_escape_string($dbc, trim($_POST['body']));
	$email = mysqli_real_escape_string($dbc, trim($_POST['email']));
	$name = isset($_POST['name']) ? mysqli_real_escape_string($dbc, trim($_POST['name'])) : "No name given";

	include('includes/header.html');
	echo "<div class = 'col-sm-7 page-with-form-body'>";
	sendEmail($subject, "Email: " . $email . "<br>" . "Name: " . $name . "<br>" . $body, "boruminc@outlook.com", "<h3>Thanks for contacting us! We will respond within the next 48 hours.</h3>");
	include('includes/footer.html');
	exit();
}

function useUserEmail() {
	global $dbc;

	// Fetch email from database
	$q = "SELECT id, email FROM users WHERE id = {$_SESSION['id']}";
	$r = mysqli_query($dbc, $q);
	$row = mysqli_fetch_array($r, MYSQLI_NUM);
	$email = $row[1];
	return $email;
}

include('includes/header.html');
echo "<div class = 'col-sm-7 page-with-form-body'>";

?>

<h1>Contact Us</h1>
<form action="" method = "post">
	<p>
		<label for="email">Email: </label>
		<input required type="text" id="email" name="email" size="60">
		<span style="color:red">*</span>
	</p>
	<p>
		<label for="name">Name: </label>
		<input type="text" id="subject" name="subject" size="100">
	<p>
		<label for = "subject">Subject: </label>
		<input required type = "text" id = "subject" name = "subject" size = "100">
	</p>
	<p>
		<label for = "body">Details</label>
		<textarea required name = "body" id = "body" cols = "50"></textarea>
	</p>
	<p>
		<input type = "submit" value = "Send message">
	</p>
</form>

<?php 
include('includes/footer.html'); 
?>

