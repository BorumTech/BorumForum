<?php

include('../../../mysqli_connect.inc.php');
$id = isset($_GET['id']) ? mysqli_real_escape_string($dbc, $_GET['id']) : $_COOKIE['id'];
$query = 'SELECT id, first_name, last_name FROM users WHERE id = ' . $id . ' LIMIT 1';
$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($result);

$page_title = "{$row['first_name']}'s Profile";
include('includes/header.html');

echo "<div style = 'float:right'><p>{$row['first_name']} {$row['last_name']}</p></div>";

include('includes/footer.html');
?>
<textarea rows="10" cols="50"></textarea>
<br>
<a href = "settings.html">Settings</a>

