<?php
require_once('../../../mysqli_connect.inc.php'); // Retrieve db connection
$q = "INSERT INTO comments (body, msg_id, usr_id)
VALUES (\"{$_POST['body']}\",
	{$_POST['msg_id']},
	{$_POST['usr_id']})";
$r = mysqli_query($dbc, $q);
if(mysqli_affected_rows($dbc) == 1) {
	echo "<tr><td></td><td class = 'comments'>{$_POST['body']}</td></tr>";
}

?>
