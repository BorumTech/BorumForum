<?php 
require('../../../svj_connect.inc.php');
$result = mysqli_query($dbc, "SELECT * FROM articles WHERE title = \"{$_GET['name']}\"");
$row = mysqli_fetch_array($result, MYSQLI_BOTH);

$page_title = str_replace('-', " ", $row[1]);
include('includes/header.html');
echo '<div class = "article-body">' . $row[2] . '</div>';
include('includes/footer.html');

?>