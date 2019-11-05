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
		echo '<div>An email was sent to your account</div>';	
		sendEmail('Reset your Password', 'Click the link below to reset your Borum password. ', $e, 'An email was sent to you. Click the link in the email to reset your password.');
		include('includes/footer.html');
		exit();
	}

}

ob_start();
include('includes/header.html');

echo '<div class = "col-sm-6 page-with-form-body">';

if (LOGGEDIN) {
	@require('includes/login_functions.inc.php');
	redirect_user();
}

ob_flush();

if (isset($_GET['code']) && isset($_GET['email'])) {
	ob_start(); // Displays the below HTML code if the conditional above is true

	?>

	<h1>Reset your Borum Password</h1>
	<form>
		<p class = "form-inputs">
			<label for = 'new-password'>Enter your new password</label>
			<span>New Password: </span><input name = "new-password" id = "new-password" type = "password">
		</p>
		<p class = "form-inputs">
			<label for = 'confirm-new-password'>Confirm your new password</label>
			<span>Confirm Password: </span><input name = "confirm-new-password" id = "confirm-new-password" type = "password">
		</p>
		<p>
			<input type = "submit" value = "Reset my Password">
		</p>
	</form>

	<?php
	echo ob_get_clean();
	exit();
}

?>

<h1>Reset your Borum Password</h1>
<form method = "post" action = "" id = 'reset-form' name = 'reset-form' onsubmit = 'return validateForm()'>
	<p class = "form-inputs">
		<label for = 'email'>Enter the email associated with your account</label>
		<span>Email: </span><input name = 'email' id = 'email' type = "email">
	</p>
	<p>
		<input type = "submit" value = "Submit">
	</p>
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
