<!DOCTYPE html>
<html>
<head>
	<style>
		a {
			display: block;
			border: 10px double orange;
			width: 200px;
			text-align: center;
			font-family: 'Roboto', sans-serif;
			text-decoration: none;
			margin-bottom: 30px;
			padding: 5px;
		}

		a:visited {
			color: blue;
		}
	</style>
	<title>Settings</title>
</head>
<body>
	<h1>Settings</h1>
	<a href = "password">Change password</a>
	<a href = "edit_user?id=<?php echo $_COOKIE['id']; ?>">Edit Information</a>
	<a style = "color: red" href = "delete_user?id=<?php echo $_COOKIE['id']; ?>">Delete Account</a>
</body>
</html>
