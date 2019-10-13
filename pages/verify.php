<!DOCTYPE html>
<html>
<head>
	<title>Email Verification</title>
</head>
<body>
<?php 
file_exists('../../mysqli_connect.inc.php') ? require_once('../../mysqli_connect.inc.php') : require_once('../../../mysqli_connect.inc.php');
$query = "SELECT * FROM verifying WHERE code = \"{$_GET['v']}\"";
$result = mysqli_query($dbc, $query);
if (mysqli_num_rows($result) == 0) {
	echo "<p>This email has already been verified or has not been registered.</p>";
} else {
	$row = mysqli_fetch_array($result, MYSQLI_BOTH);
	$query = "INSERT INTO users (first_name, last_name, email, pass, registration_date) VALUES (\"{$row['first_name']}\", \"{$row['last_name']}\", \"{$row['email']}\", \"{$row['code']}\", NOW() )";
	$result = mysqli_query($dbc, $query); // Register the user into the database
	if ($result) {
		$query = "DELETE FROM verifying WHERE code = \"{$_GET['v']}\"";
		$result = mysqli_query($dbc, $query);
		echo "Thanks for verifying!";
	} else {
		echo "A system error occured: " . $query;
	}
}
?>
</body>
</html>