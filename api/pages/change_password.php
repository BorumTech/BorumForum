<?php
$page_title = "Change your Password - Borum";

ob_start();
include("includes/header.html");
echo "<div class = 'col-sm-9'>";

if (LOGGEDIN) {
	@require('includes/login_functions.inc.php');
	redirect_user();
}

ob_flush();

if (isset($_GET['code']) && isset($_GET['email'])) { // If the email has been identified
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$np = $_POST['new-password'];
		$cnp = $_POST['confirm-new-password'];
		if ($np == $cnp) {
			$q = "UPDATE users SET pass = SHA2('$np', 512) WHERE email = \"{$_GET['email']}\"";
			$r = mysqli_query($dbc, $q);
			if (mysqli_affected_rows($dbc) == 1) {
				echo "<h1>Success!</h1><p>Your password was updated and you can now log in with this new password. Be sure to write down your password this time so you don't forget! Redirecting you now...";
				$q = "DELETE FROM `password-resets` WHERE email = \"{$_GET['email']}\" AND code = \"{$_GET['code']}\"";
				require('includes/login_functions.inc.php');
				redirect_js('../Login', 6000);
			} else {
				echo "<p>For some reason, your password was not updated. Please try again. </p>";
			}
			exit();
		} else {
			echo "<p>Error - Your passwords did not match!</p>";
		}
		include('includes/footer.html');
	}

	$q = "SELECT * FROM `password-resets` WHERE code = \"{$_GET['code']}\" AND email = \"{$_GET['email']}\"";
	$r = mysqli_query($dbc, $q);
	$num = mysqli_num_rows($r);
	if ($num >= 1) {
		ob_start(); // Displays the below HTML code if the conditional above is true

		?>
		<h1>Reset your Borum Password</h1>
		<form action = "" method = "post">
			<p class = "form-inputs">
				<label for = 'new-password'>Enter your new password</label>
				<span>New Password: </span><input name = "new-password" id = "new-password" type = "password" required>
			</p>
			<p class = "form-inputs">
				<label for = 'confirm-new-password'>Confirm your new password</label>
				<span>Confirm Password: </span><input name = "confirm-new-password" id = "confirm-new-password" type = "password" required>
			</p>
			<p>
				<input type = "submit" value = "Reset my Password">
			</p>
		</form>
		<?php
		echo ob_get_clean();
		exit();
	}
}


include('includes/footer.html');
?>
