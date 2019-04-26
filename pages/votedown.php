<?php 
	file_exists('../../mysqli_connect.inc.php') ? require_once('../../mysqli_connect.inc.php') : require_once('../../Users/VSpoe/mysqli_connect.inc.php');
	mysqli_query($dbc, "UPDATE messages SET votes = votes - 1 WHERE id = {$_REQUEST['id']}");
	$result = mysqli_query($dbc, "SELECT votes FROM messages WHERE id = {$_REQUEST['id']}");
	$rows = mysqli_fetch_array($result, MYSQLI_NUM);
	echo $rows[0];
?>