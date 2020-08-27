<?php 

// Connect to the db
file_exists('../../../../mysqli_connect.inc.php') ? require_once('../../../../mysqli_connect.inc.php') : require_once('../../../../../mysqli_connect.inc.php');

$searchq = "SELECT * FROM topics WHERE name LIKE \"%{$_GET['q']}%\"";

$searchr = mysqli_query($dbc, $searchq); 

while ($searchrow = mysqli_fetch_array($searchr, MYSQLI_ASSOC)) {
   	echo "<li><a>{$searchrow['name']}</a></li>";
}

?>

