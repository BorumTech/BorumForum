<?php

file_exists('../../../mysqli_connect.inc.php') ? require_once('../../../mysqli_connect.inc.php') : require_once('../../../Users/VSpoe/mysqli_connect.inc.php');

switch ($_REQUEST['func']) {
	case "select":
		$query = "SELECT bio FROM users WHERE id = {$_REQUEST['id']} LIMIT 1";
		$result = mysqli_query($dbc, $query);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC); 
		echo $row['bio'];	
		@mysqli_free_result($result);
		break;
	case "update":
		$bio = mysqli_real_escape_string($dbc, trim($_REQUEST['bio']));
		$query = "UPDATE users SET bio = '$bio' WHERE id = '{$_REQUEST['id']}' LIMIT 1";
		mysqli_query($dbc, $query);

		$query = "SELECT bio FROM users WHERE id = {$_REQUEST['id']} LIMIT 1";
		$result = mysqli_query($dbc, $query);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC); 
		echo $row['bio'];		
		@mysqli_free_result($result);
		break;
	default:
		break;
}

mysqli_close($dbc);

?>