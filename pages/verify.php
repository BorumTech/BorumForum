<!DOCTYPE html>
<html>
<head>
	<title>Email Verification</title>
</head>
<body>
<?php 

file_exists('../../mysqli_connect.inc.php') ? require_once('../../mysqli_connect.inc.php') : require_once('../../../mysqli_connect.inc.php');
$query = "SELECT * FROM verifying WHERE code = \"{$_GET['v']}\" LIMIT 1";
$result = mysqli_query($dbc, $query);

if (mysqli_num_rows($result) == 0) {
	echo "<p>This email has already been verified or has not been registered.</p>";
} else {
	$row = mysqli_fetch_array($result, MYSQLI_BOTH);
	$query = "INSERT INTO users (first_name, last_name, email, pass, registration_date) VALUES (\"{$row['first_name']}\", \"{$row['last_name']}\", \"{$row['email']}\", \"{$row['password']}\", NOW() )";
	$result = mysqli_query($dbc, $query); // Register the user into the database
	if ($result) {
		$query = "DELETE FROM verifying WHERE code = \"{$_GET['v']}\"";
		$result = mysqli_query($dbc, $query);
		echo "Thanks for verifying!";
		require_once('includes/helpers.php');
		sendEmail("Welcome to Borum!", "Hi " . $row['first_name'] . ", <p>My name is Varun Singh, the founder of Borum. I am pleased to welcome you to our Q&A site. On Borum Q&A, you will be able to learn and share information like no other site before us has ever done. Happy Boruming!</p><p><a href = 'http://www.bforborum.com'>Start here</a></p><p>Sincerely, <br>Varun Singh</p>", $row['email'], "<script>console.log('Email sent!')</script>");
	} else {
		echo "A system error occured: " . $query;
	}
}
?>
</body>
</html>