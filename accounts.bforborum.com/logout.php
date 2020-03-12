<?php
session_start();
$_SESSION = []; // Erase data from text file of sessions on server
session_destroy(); // Remove the session data from the server
setcookie('PHPSESSID', '', time()-3600, '/', '', 0, 0);
?>
<html>
<head>
<link href = "style.css" rel = "stylesheet" type = "text/css">
</head>
<body>
	<h1 id = 'successful-logout'>Logged out successfully</h1>
	<a href = "http://www.bforborum.com">Back to Borum</a>
	<a href = "http://audio.bforborum.com">Back to Flytrap</a>
</body>
</html>
