<h1>Login</h1>
<form action = "" method = "post">
	<fieldset>
		<legend>Login Details</legend>
		<p>
			<label>Email Address: </label>
			<input type = "email" name = "email" size = "20" maxlength = "60" value = "<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
		</p>
		<p>
			<label>Password: </label>
			<input type = "password" name = "pass1" size = "10" maxlength = "20">
		</p>
	</fieldset>
	<p>
		<input type = "submit" name = "submit" value = "Login">
	</p>
</form>

