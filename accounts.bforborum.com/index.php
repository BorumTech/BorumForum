<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>My Borum Account</title>
		<link href = "http://cdn.bforborum.com/images/icon.ico" rel = "shortcut icon" type = "image/x-icon">
		<link href = "style.css" rel = "stylesheet" type = "text/css">
	</head>
	<body>
		<?php var_export($_SESSION); ?>
		<div id = 'log-out-btn-container'>
			<form action = "logout.php" method = "post">
				<input value = "Log Out" type = "submit" id = 'log-out-btn'>
			</form>
		</div>
		<script src = "script.js"></script>
	</body>
</html>
