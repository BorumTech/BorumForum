<?php 
require('../../../svj_connect.inc.php');
$result = mysqli_query($dbc, "SELECT * FROM articles");
$row = mysqli_fetch_array($result, MYSQLI_BOTH);

$page_title = $row[1];
include('includes/header.html');
include('includes/footer.html');

?>