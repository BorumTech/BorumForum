<?php 

session_start();

if (!isset($_SESSION['id'])) {
	include('../includes/login_functions.inc.php');
	redirect_user('', true);
}

$page_title = "Tag Notifications";

file_exists('../../../mysqli_connect.inc.php') ? require_once('../../../mysqli_connect.inc.php') : require_once('../../../../mysqli_connect.inc.php');
require_once('../includes/header.html');

?>

<div class = "col-sm-6">
	<h2>Tags Following</h2>
	<?php 
	$q = "SELECT `followed-topics`.id, topics.name FROM `followed-topics` JOIN topics ON topics.id = `followed-topics`.topic_id WHERE `followed-topics`.user_id = {$_SESSION['id']}";
	$r = mysqli_query($dbc, $q);
	while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		echo "<p><a href = \"/Topics/{$row['name']}\">{$row['name']}</a></p>";
	}

	?>
	<h2>Tags Ignoring</h2>
	<?php 
	$q = "SELECT `ignored-topics`.id, topics.name FROM `ignored-topics` JOIN topics ON topics.id = `ignored-topics`.topic_id WHERE `ignored-topics`.user_id = {$_SESSION['id']}";
	$r = mysqli_query($dbc, $q);
	while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		echo "<p><a href = \"/Topics/{$row['name']}\">{$row['name']}</a></p>";
	}
	?>

<?php
require_once('../includes/footer.html');
?>

