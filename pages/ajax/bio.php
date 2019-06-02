<?php

file_exists('../../../mysqli_connect.inc.php') ? require_once('../../mysqli_connect.inc.php') : require_once('../../../Users/VSpoe/mysqli_connect.inc.php');

$query = "SELECT bio FROM users WHERE id = {$_GET['id']} LIMIT 1";
$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC); 
echo $row['bio'];
?>