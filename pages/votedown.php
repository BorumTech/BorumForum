<?php 
	// Connect to the db
	file_exists('../../mysqli_connect.inc.php') ? require_once('../../mysqli_connect.inc.php') : require_once('../../Users/VSpoe/mysqli_connect.inc.php');

	// Find the current number of votes before any changes occur
	function getVotes() { 
		global $dbc;
		$result = mysqli_query($dbc, "SELECT SUM(vote) FROM `user-message-votes` WHERE message_id = {$_REQUEST['message_id']}"); 
		$rows = mysqli_fetch_array($result, MYSQLI_NUM);
		return $rows[0];
	}

	// Check whether the user already voted on this message
	$firstq = "SELECT id FROM `user-message-votes` WHERE user_id = {$_GET['user_id']} AND message_id = {$_GET['message_id']} AND vote = -1 ORDER BY id";
	$firstr = mysqli_query($dbc, $firstq);
	if (mysqli_num_rows($firstr) >= 1) {
		// If they just voted this question up and want to undo their vote

		// Delete other rows
		mysqli_query($dbc, "DELETE FROM `user-message-votes` WHERE user_id = {$_GET['user_id']} AND message_id = {$_GET['message_id']} ");
		echo !empty(getVotes()) ? getVotes() : 0;
	} else {
		// Voted uo and want to change to vote down
		$secondq = "SELECT id FROM `user-message-votes` WHERE user_id = {$_GET['user_id']} AND message_id = {$_GET['message_id']} AND vote = 1";
		$secondr = mysqli_query($dbc, $secondq);
		$changedVote = mysqli_num_rows($secondr) >= 1;

	 	$q2 = "INSERT INTO `user-message-votes` (user_id, message_id, parent_id, vote) VALUES ({$_GET['user_id']}, {$_GET['message_id']}, {$_GET['parent_id']}, -1)";
	 	$r2 = mysqli_query($dbc, $q2); // Insert into logs
	 	if($changedVote) {
	 		mysqli_query($dbc, $q2);
	 	}
	 	$result = getVotes();
		
	 	echo $result;
	}
?>