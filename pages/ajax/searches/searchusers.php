<?php 

// Connect to the db
file_exists('../../../../mysqli_connect.inc.php') ? require_once('../../../../mysqli_connect.inc.php') : require_once('../../../../../mysqli_connect.inc.php');

$searchq = "SELECT * FROM users WHERE MATCH (first_name, last_name) AGAINST (\"{$_GET['q']}\")";

$searchr = mysqli_query($dbc, $searchq); 

while ($searchrow = mysqli_fetch_array($searchr, MYSQLI_ASSOC)) {
   	echo "<tr><td class = \"links\"><a href = \"/Users/{$searchrow['id']}\">View Profile</a></td><td class = \"output\">{$searchrow['last_name']}</td><td class = \"output\">{$searchrow['first_name']}</td></tr>";
}

?>

