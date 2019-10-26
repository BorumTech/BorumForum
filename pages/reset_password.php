<?php 
$page_title = "Reset your Password - Borum";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require('../../mysqli_connect.inc.php');
	if (isset($_POST['email'])) {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	} else {
		$errors[] = "No email";
	}

	if (empty($errors)) {
		include('includes/header.html');
		echo '<div class = "col-sm-10" id = "reset-password-body">';		
		sendEmail('Reset your Password', 'Click the link below to reset your Borum password. ', $e, 'An email was sent to you. Click the link in the email to reset your password.');
		exit();
	}

}

ob_start();
include('includes/header.html');

echo '<div class = "col-sm-10" id = "reset-password-body">';

if (LOGGEDIN) {
	@require('includes/login_functions.inc.php');
	redirect_user();
}

ob_flush();

?>

<h1>Reset your Borum Password</h1>
<form method = "post" action = "" id = 'reset-form' name = 'reset-form' onsubmit = 'return validateForm()'>
	<p>
		<label for = 'email'>Enter the email associated with your account</label>
		<span>Email: </span><input name = 'email' id = 'email' type = "email">
	</p>
	<input type = "submit" value = "Reset my password">
</form>

<script type="text/javascript" charset="utf-8">
	function validateForm() {
		if (document.forms['reset-form']['email'].value == '') {
			alert('You must enter a valid email into the box');
			window.location.reload();
		}
	}
</script>

<?php
include_once('includes/footer.html');

?>
