<?php 
$q = "INSERT INTO `followed-topics` (user_id, topic_id) VALUES ({$_POST['user_id']}, {$_POST['topic_id']})";
$r = mysqli_query($dbc, $q);
if (mysqli_affected_rows($r) == 1) {

}

?>