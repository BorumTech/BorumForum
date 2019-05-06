<?php 
	file_exists('../../mysqli_connect.inc.php') ? require_once('../../mysqli_connect.inc.php') : require_once('../../Users/VSpoe/mysqli_connect.inc.php');
	$result = mysqli_query($dbc, "SELECT id FROM `user-message-votes` WHERE message_id = {$_GET['id']}");
	$count = mysqli_num_rows($result);
	echo $count;
?>