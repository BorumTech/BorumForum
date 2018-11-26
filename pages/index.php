<!DOCTYPE html>
<html>
<head>
	<meta charset = "utf-8">
	<title>Preventing SQL Injection to Secure Databases</title>
	<link href = "../css/style.css" type = "text/css" rel = "stylesheet">
</head>
<body>
	<form action = "welcome.php" method = 'post'>
		<p>
			<label for = 'uname'>Username: </label>
			<input type = "text" name = 'uname' id = 'uname' placeholder = 'Username'>
		</p>
		<p>
			<label for = 'pass'>Password: </label>
			<input type = "password" name = 'pass' id = 'pass' placeholder = "Enter Password">
			<button id = "showPassword" type = "button" onclick = "<?php ?>">
				<img style = "height: 1em;"  src = "../images/reveal_password_button.png">
			</button>
		</p>
		<p>
			<input type = "submit" value = "Login">
		</p>
	</form>

	<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
	<script src = "../scripts/script.js"></script>
</body>
</html>