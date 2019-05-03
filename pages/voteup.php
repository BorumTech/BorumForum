<?php 
	file_exists('../../mysqli_connect.inc.php') ? require_once('../../mysqli_connect.inc.php') : require_once('../../Users/VSpoe/mysqli_connect.inc.php');

	$result = mysqli_query($dbc, "SELECT votes FROM messages WHERE id = {$_REQUEST['user_id']}");
	$rows = mysqli_fetch_array($result, MYSQLI_NUM);

	$firstq = "SELECT id FROM `user-message-votes` WHERE user_id = {$_GET['user_id']} AND message_id = {$_GET['message_id']} AND vote = 1";
	$firstr = mysqli_query($dbc, $firstq);
	$firsta = mysqli_num_rows($firstr);
	if ($firsta == 1) {
		echo $rows[0];
		exit;
	}
	else {
		$q2 = "INSERT INTO `user-message-votes` (user_id, message_id, vote) VALUES ({$_GET['user_id']}, {$_GET['message_id']}, 1)";
		$r2 = mysqli_query($dbc, $q2);
		mysqli_query($dbc, "UPDATE messages SET votes = votes + 1 WHERE id = {$_REQUEST['user_id']}");
		$result = mysqli_query($dbc, "SELECT votes FROM messages WHERE id = {$_REQUEST['user_id']}");
		
		echo $rows[0];
	}

?>