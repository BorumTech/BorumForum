<?php 
ob_start();
$page_title = "Reset your Password - Borum";
include('includes/header.html');

echo '<div class = "col-sm-10" id = "reset-password-body">';

if (LOGGEDIN) {
	@require('includes/login_functions.inc.php');
	redirect_user();
}

ob_flush();

?>

<h1>Reset your Borum Password</h1>

<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST['email'])) {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}

	sendEmail('Reset your Password', 'Click the link below to reset your Borum password. ');
}

?>

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
