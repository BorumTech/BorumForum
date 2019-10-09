<?php 

// Connect to the db
file_exists('../../../../mysqli_connect.inc.php') ? require_once('../../../../mysqli_connect.inc.php') : require_once('../../../../Users/VSpoe/mysqli_connect.inc.php');

$searchq = "SELECT * FROM messages WHERE MATCH (subject, body) AGAINST (\"{$_POST['q']}\")";

$searchr = mysqli_query($dbc, $searchq);

$searchresult = "";

while ($searchrow = mysqli_fetch_array($searchr, MYSQLI_ASSOC)) {
   	$searchresult .= "<h3>{$searchrow['subject']}</h3><p>{$searchrow['body']}</p>";
}

echo $searchresult;

?>

