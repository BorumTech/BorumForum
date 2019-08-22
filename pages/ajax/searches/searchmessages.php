<?php 

// Connect to the db
file_exists('../../../../mysqli_connect.inc.php') ? require_once('../../../../mysqli_connect.inc.php') : require_once('../../../../Users/VSpoe/mysqli_connect.inc.php');

$searchq = "SELECT * FROM messages WHERE MATCH (subject, body) AGAINST (\"bork\")";
$searchr = mysqli_query($dbc, $searchq);

while ($searchrow = mysqli_fetch_array($searchr, MYSQLI_ASSOC)) {
	echo "<h3>{$searchrow['subject']}</h3>";
	echo "<p>{$searchrow['body']}</p>";
}

?>

