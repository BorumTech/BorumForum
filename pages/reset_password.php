<?php
$page_title = "Reset your Password - Borum";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require('../../mysqli_connect.inc.php');

	include('includes/header.html');
	echo '<div class = "col-sm-6">';

	if (isset($_POST['email'])) {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	} else {
		$errors[] = "No email";
	}

	$q = "SELECT email FROM users WHERE email = '$e'";
	$r = mysqli_query($dbc, $q);
	if (mysqli_num_rows($r) == 0) {
		$errors[] = "That is not a registered email. ";
	}


	if (empty($errors)) {

		echo '<div class = "col-sm-10" id = "reset-password-body">';
		$q = "SELECT SHA2(CONCAT(NOW(), RAND(), UUID()), 512)";
		$r = mysqli_query($dbc, $q);
		$row = mysqli_fetch_array($r, MYSQLI_NUM);
		$q = "INSERT INTO `password-resets` (code, email) VALUES ('{$row[0]}', '$e')";
		$r = mysqli_query($dbc, $q);
		sendEmail('Reset your Password', 'Click the link below to reset your Borum password. <br><a href = "http://www.borumtech.com/pages/change_password.php?code=' . $row[0] . '&email=' . $e . '">Click here</a>', $e, 'An email was sent to you. Click the link in the email to reset your password.');
		include('includes/footer.html');
		exit();
	} else {
		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br>';
		foreach ($errors as $msg) {
			echo " - $msg<br>\n";
		}
		echo '</p><p>Please try again.</p>';
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

?>

<!-- If the email has not been identified -->
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
