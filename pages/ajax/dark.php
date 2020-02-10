<?php

file_exists('../../../mysqli_connect.inc.php') ? require_once('../../../mysqli_connect.inc.php') : require_once('../../../../mysqli_connect.inc.php');

session_start();
$q = "UPDATE users SET dark = {$_COOKIE['dark']} WHERE id = {$_GET['id']}";
mysqli_query($dbc, $q);

$q = "SELECT dark FROM users WHERE id = {$_GET['id']}";
$r = mysqli_query($dbc, $q);
$row = mysqli_fetch_array($r, MYSQLI_ASSOC);
echo "Dark mode set to {$row['dark']}.";

?>
