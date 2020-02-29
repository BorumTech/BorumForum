<?php
include('../../../mysqli_connect.inc.php');
$pass = $_POST['pass'];
$q = "SELECT SHA2('$pass', 512);";
$r = mysqli_query($dbc, $q);
$pass = mysqli_fetch_array($r, MYSQLI_NUM)[0];
echo $pass;
?>
