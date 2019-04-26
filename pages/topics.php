<?php 
$page_title = "Borum - Topics";
include('includes/header.html');

file_exists('../../mysqli_connect.inc.php') ? require_once('../../mysqli_connect.inc.php') : require_once('../../Users/VSpoe/mysqli_connect.inc.php');
?>

<?php 
/* Here is where the fun begins */
echo "<ul>";
$query = "SELECT id, name FROM topics";
$result = mysqli_query($dbc, $query);
while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
	echo "<li><a href = '../Topics/$row[1]'>{$row[1]}</a></li>";
}
echo "</ul>";

?>

<?php
include('includes/footer.html');
?>

