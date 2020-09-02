<?php
require_once('../../../mysqli_connect.inc.php'); // Retrieve db connection
$body = mysqli_real_escape_string($dbc, trim($_POST['body']));
$q = "INSERT INTO comments (body, msg_id, usr_id) VALUES (\"$body\", {$_POST['msg_id']}, {$_POST['usr_id']})";
$r = mysqli_query($dbc, $q);

header("Content-Type: application/json");
if(mysqli_affected_rows($dbc) == 1) {
	echo json_encode([
			"ok" => TRUE, 
			"data" => "<tr><td></td><td class = 'comments'>{$_POST['body']}</td></tr>"
		]);
} else {
	echo json_encode([
			"ok" => FALSE,
			"reason" => "Database not updated"
		]);
}

?>
