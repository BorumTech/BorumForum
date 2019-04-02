<?php
require_once('../../mysqli_connect.inc.php');
$result = mysqli_query($dbc, 'SELECT id, subject, body FROM messages WHERE id = ' . $_GET['id']);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);


$page_title = $row['subject'];
include('includes/header.html');
?>

<?php 

echo "<h1>{$row['subject']}</h1>";
echo "<p>{$row['body']}</p>";

?>

<?php
include('includes/footer.html');
?>