<?php 

if (!isset($_COOKIE['id'])) {
	include('../includes/login_functions.inc.php');
	redirect_user('', true);
}

$page_title = "Tag Notifications";
file_exists('../../../mysqli_connect.inc.php') ? require_once('../../../mysqli_connect.inc.php') : require_once('../../../Users/VSpoe/mysqli_connect.inc.php');
require_once('../includes/header.html');
?>

<div class = "col-sm-6">
	<h2>Tags Following</h2>
	<?php 
	$q = "SELECT `ignored-topics`.id, topics.name FROM  "
	?>
	<h2>Tags Ignoring</h2>

<?php
require_once('../includes/footer.html');
?>

