<?php
require_once('../../../mysqli_connect.inc.php'); // Retrieve db connection
$q = "INSERT INTO comments (body, msg_id, usr_id)";
$r = mysqli_query($dbc, $q);
if($r) {
	$row = mysqli_fetch_array($r, MYSQLI_ASSOC);
	echo "<tr><td></td><td class = 'comments'>{$row['body']}</td></tr>";
}

?>
