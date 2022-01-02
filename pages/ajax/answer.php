<?php

file_exists('../../../mysqli_connect.inc.php') ? require_once('../../../mysqli_connect.inc.php') : require_once('../../../../mysqli_connect.inc.php');
session_start();
require('../includes/helpers.php');

// Define the POST data
$ans = mysqli_real_escape_string($dbc, trim($_POST['answer']));
$ques_id = $_POST['ques_id'];
$counter = $_POST['counter'];
// Check if its okay for the user to answer the question
$q = "SELECT id FROM messages WHERE parent_id = $ques_id AND body = '$ans'";
$r = @mysqli_query($dbc, $q);
$num = mysqli_num_rows($r);

if ($num == 0) { // No answers that match this one (no duplicates) on the current question
	$q = "INSERT INTO messages (parent_id, user_id, body, date_entered) VALUES ($ques_id, {$_COOKIE['id']}, '$ans', NOW())";
	$r = mysqli_query($dbc, $q);
	$num = mysqli_affected_rows($dbc);
} else {
	echo "The answer could not be added because it is a duplicate.";
	exit();
}


function getNoAccountButton($way) {
	return "\t<button type = 'button' onclick = \"window.location.href = '/Login'\">$way</button>\n";
}

function votedOnQuestion($msg_id, $vote) {
	global $dbc;
	if (isset($_COOKIE['id'])) {
		$query = "SELECT vote FROM `user-message-votes` WHERE user_id = {$_COOKIE['id']} AND message_id = $msg_id ORDER BY id DESC LIMIT 1"; // Select latest vote for the user for the question
		$result = mysqli_query($dbc, $query);
		return @mysqli_fetch_array($result, MYSQLI_NUM)[0] == $vote;
	}

}

// Return the answer to the question that has just been posted
function getUpArrow() {
	global $fillColor;
	return '<svg aria-hidden="true" class="svg-icon m0 iconArrowUpLg" width="36" height="36" viewBox="0 0 36 36"><path style = "fill:' . $fillColor . '" d="M2 26h32L18 10z"></path></svg>';
}

function getDownArrow() {
	global $fillColor;
	return '<svg aria-hidden="true" class="svg-icon m0 iconArrowDownLg" width="36" height="36" viewBox="0 0 36 36"><path style = "fill:' . $fillColor . '" d="M2 10h32L18 26z"></path></svg>';
}

if ($num == 1) { // Answer was successfully added to the database
	$ansquery = '
	SELECT messages.id AS msg_id, users.id AS usr_id, messages.body AS msg_body, users.profile_picture AS profile, users.first_name AS fn
	FROM messages
	JOIN users
	ON users.id = messages.user_id
	ORDER BY date_entered DESC
	LIMIT 1';
	$ansresult = mysqli_query($dbc, $ansquery);
	$ansrow = mysqli_fetch_array($ansresult, MYSQLI_ASSOC);
	$ans_id = $ansrow['msg_id'];
	$fillColor = votedOnQuestion($ansrow['msg_id'], 1) ? 'lightgreen' : 'rgb(221, 221, 221)';
	$uparrow = getUpArrow();
	$noAccountVoteUpBtn = getNoAccountButton($uparrow);

	$fillColor = votedOnQuestion($ansrow['msg_id'], -1) ? 'lightgreen' : 'rgb(221, 221, 221)';
	$downarrow = getDownArrow();
	$noAccountVoteDownBtn = getNoAccountButton($downarrow);

	$voteupbtn = isset($_COOKIE['id']) ? "\t<button type = 'button' onclick = \"loadXMLDoc('up', {$_COOKIE['id']}, {$ansrow['msg_id']}, 'ans-$counter-vote-count')\">$uparrow</button>\n" : $noAccountVoteUpBtn;
	$votedownbtn = isset($_COOKIE['id']) ? "\t\t<button type = 'button' onclick = \"loadXMLDoc('down', {$_COOKIE['id']}, {$ansrow['msg_id']}, 'ans-$counter-vote-count')\">$downarrow</button>\n" : $noAccountVoteDownBtn;

	echo "<tr class = 'post-content'>";
	echo "<td>";
	echo $voteupbtn;

	echo "\t\t<br><div class = 'vote-counter' id = 'ans-$counter-vote-count'>0</div>";
	echo $votedownbtn;
	echo "</td>";
	// Generate query for answers' information
	echo "<td>";
	echo "\t\t<p id = \"{$ansrow['msg_id']}\" class = 'ans-body'>{$ansrow['msg_body']}</p>\n";
	echo "</td>";
	echo "</tr>\n";
	echo "<tr id = 'upc-$counter' class = 'user-profile-container'>";
	if (LOGGEDIN && $_COOKIE['id'] === $ansrow['usr_id']) {
		$what_to_echo = $ansrow['msg_id'] . '/Edit';

		echo '<td class = "modify-links">';
		echo "<a href = '$what_to_echo'>Edit</a> ";

		$what_to_echo = $ansrow['msg_id'] . '/Delete';

		echo "<a href = '$what_to_echo'>Delete</a>";
		echo "</td>";
	}
	echo "<td colspan = \"2\" class = \"question-poster\">
			<div>
				<a href = '/Users/{$ansrow['usr_id']}'>
					<span>{$ansrow['fn']}</span>
				</a>
				<a href = '/Users/{$ansrow['usr_id']}'>
					<img height = '30' src = \"../pages/show_image.php?image={row2['profile']}\">
				</a>
			</div>
		</td>
	</tr>";
} else {
	echo "The answer could not be added due to a system error.";
}
/*

*/
?>
