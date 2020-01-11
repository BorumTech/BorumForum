<?php 

file_exists('../../../mysqli_connect.inc.php') ? require_once('../../../mysqli_connect.inc.php') : require_once('../../../../mysqli_connect.inc.php');

$q = "DELETE FROM `topics` WHERE id = {$_GET['topic_id']}";
$r = mysqli_query($dbc, $q);
if (mysqli_affected_rows($dbc) == 1) {
	echo "Topic #{$_GET['topic_id']} was deleted successfully.";
} else {
	echo "Topic was not deleted for some reason.";
}

?>