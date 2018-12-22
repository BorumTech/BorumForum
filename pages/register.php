<h1>Register</h1>
<form action = "" method = "post">
	<p>
		<label>First Name: </label>
		<input type = "text" name = "first_name" size = "15" maxlength = "20" value = "<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>">
	</p>
	<p>
		<label>Last Name: </label>
		<input type = "text" name = "last_name" size = "15" maxlength = "40" value = "<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>">
	</p>
	<p>
		<label>Email Address: </label>
		<input type = "email" name = "email" size = "20" maxlength = "60" value = "<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
	</p>
	<p>
		<label>Password: </label>
		<input type = "password" name = "pass1" size = "10" maxlength = "20" value = "<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>">
	</p>
	<p>
		<label>Confirm Password: </label>
		<input type = "password" name = "pass2" size = "10" maxlength = "20">
	</p>
	<p>
		<input type = "submit" name = "submit" value = "Register">
	</p>
</form>

