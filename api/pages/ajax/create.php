<?php 
file_exists('../../../mysqli_connect.inc.php') ? require_once('../../../mysqli_connect.inc.php') : require_once('../../../../mysqli_connect.inc.php');
mysqli_query($dbc, "CREATE DATABASE svjournal");

?>