<?php 
file_exists('../../../mysqli_connect.inc.php') ? require_once('../../../mysqli_connect.inc.php') : require_once('../../../Users/VSpoe/mysqli_connect.inc.php');
$q = "SELECT id FROM `ignored-topics` WHERE user_id = {$_GET['user_id']} AND topic_id = {$_GET['topic_id']}";
$r = mysqli_query($dbc, $q);
if (mysqli_num_rows($r) != 1) {
	$q = "DELETE FROM `followed-topics` WHERE user_id = {$_GET['user_id']} AND topic_id = {$_GET['topic_id']}";
	mysqli_query($dbc, $q);
	$q = "INSERT INTO `ignored-topics` (user_id, topic_id) VALUES ({$_GET['user_id']}, {$_GET['topic_id']})";
	mysqli_query($dbc, $q);
	echo "Unignore";
} else {
	$q = "DELETE FROM `ignored-topics` WHERE user_id = {$_GET['user_id']} AND topic_id = {$_GET['topic_id']}";
	mysqli_query($dbc, $q);
	echo "Ignore Topic";
}


?>