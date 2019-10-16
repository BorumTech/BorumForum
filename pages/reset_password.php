<?php 

$page_title = "Reset your Password - Borum";
require_once('includes/header.html');
?>
<div class = "col-sm-10" id = "reset-password-body">
<h1>Reset your Borum Password</h1>

<form method = "post" action = "" id = 'reset-form'>
	<p>
		<label for = 'email'>Enter the email associated with your account</label>
		<span>Email: </span><input name = 'email' id = 'email' type = "email">
	</p>
	<input type = "submit" value = "Reset my password">
</form>

<?php
include_once('includes/footer.html');

?>
