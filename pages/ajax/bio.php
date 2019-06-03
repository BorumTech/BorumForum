<?php

file_exists('../../../mysqli_connect.inc.php') ? require_once('../../mysqli_connect.inc.php') : require_once('../../../Users/VSpoe/mysqli_connect.inc.php');

switch ($_REQUEST['func']) {
	case "select":
		$query = "SELECT bio FROM users WHERE id = {$_REQUEST['id']} LIMIT 1";
		$result = mysqli_query($dbc, $query);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC); 
		echo $row['bio'];	
		break;
	case "update":
		$query = "UPDATE bio FROM users SET bio = {$_REQUEST['bio']} WHERE id = {$_REQUEST['id']} LIMIT 1";
		$query = "SELECT bio FROM users WHERE id = {$_REQUEST['id']} LIMIT 1";
		$result = mysqli_query($dbc, $query);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC); 
		echo $row['bio'];	
		break;
	default:
		break;
}

mysqli_close($dbc);

?>