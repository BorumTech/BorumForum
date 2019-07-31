<?php 

file_exists('../../../mysqli_connect.inc.php') ? require_once('../../../mysqli_connect.inc.php') : require_once('../../../Users/VSpoe/mysqli_connect.inc.php');

// Validate the form elements
$ans = $_POST['answer'];
$ques_id = $_POST['ques_id'];
// Check if its okay for the user to answer the question
$user_id = $_COOKIE['id'];
$q = "SELECT id FROM messages WHERE parent_id = $ques_id AND body = '$ans'";
$r = @mysqli_query($dbc, $q);
$num = mysqli_num_rows($r);

if ($num == 0) { // No answers that match this one (no duplicates) on the current question
	$q = "INSERT INTO messages (parent_id, user_id, body, date_entered) VALUES ($ques_id, $user_id, '$ans', NOW())";
	@mysqli_query($dbc, $q);
}

// Return the answer to the question that has just been posted
echo "<tr><td>$ans</td></tr>";

?>

