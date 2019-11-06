<?php 
$page_title = "Change your Password - Borum";

ob_start();
include("includes/header.html");

if (LOGGEDIN) {
	@require('includes/login_functions.inc.php');
	redirect_user();
}

ob_flush();

if (isset($_GET['code']) && isset($_GET['email'])) { // If the email has been identified
	ob_start(); // Displays the below HTML code if the conditional above is true

	?>

	<h1>Reset your Borum Password</h1>
	<form action = "" method = "post">
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


include('includes/footer.html');
?>