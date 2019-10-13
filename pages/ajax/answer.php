<?php 

file_exists('../../../mysqli_connect.inc.php') ? require_once('../../../mysqli_connect.inc.php') : require_once('../../../../mysqli_connect.inc.php');

session_start();

// Validate the form elements
$ans = $_POST['answer'];
$ques_id = $_POST['ques_id'];
// Check if its okay for the user to answer the question
$q = "SELECT id FROM messages WHERE parent_id = $ques_id AND body = '$ans'";
$r = @mysqli_query($dbc, $q);
$num = mysqli_num_rows($r);

if ($num == 0) { // No answers that match this one (no duplicates) on the current question
	$q = "INSERT INTO messages (parent_id, user_id, body, date_entered) VALUES ($ques_id, {$_SESSION['id']}, '$ans', NOW())";
	@mysqli_query($dbc, $q);
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

$ansquery = '
SELECT messages.id AS msg_id, users.id AS usr_id, messages.body AS msg_body, users.profile_picture AS profile, users.first_name AS fn
FROM messages 
JOIN users 
ON users.id = messages.user_id';
$ansresult = mysqli_query($dbc, $ansquery);
$ansrow = mysqli_fetch_array($ansresult, MYSQLI_ASSOC);
$ans_id = $ansrow['msg_id'];
$fillColor = votedOnQuestion($ansrow['msg_id'], 1) ? 'lightgreen' : 'rgb(221, 221, 221)';
$uparrow = getUpArrow();
$noAccountVoteUpBtn = getNoAccountButton($uparrow);

$fillColor = votedOnQuestion($ansrow['msg_id'], -1) ? 'lightgreen' : 'rgb(221, 221, 221)';
$downarrow = getDownArrow();
$noAccountVoteDownBtn = getNoAccountButton($downarrow);

$voteupbtn = isset($_SESSION['id']) ? "\t<button type = 'button' onclick = \"loadXMLDoc('up', {$_SESSION['id']}, {$ansrow['msg_id']}, 'ans-$counter-vote-count')\">$uparrow</button>\n" : $noAccountVoteUpBtn;
$votedownbtn = isset($_SESSION['id']) ? "\t\t<button type = 'button' onclick = \"loadXMLDoc('down', {$_SESSION['id']}, {$ansrow['msg_id']}, 'ans-$counter-vote-count')\">$downarrow</button>\n" : $noAccountVoteDownBtn; 

echo "<tr>";
echo "<td>";
echo $voteupbtn;

$voteCount = $ansrow['votes'] == null ? 0 : $ansrow['votes'];

echo "\t\t<br><div class = 'vote-counter' id = 'ans-$counter-vote-count'>$voteCount</div>";
echo $votedownbtn;
echo "</td>";
// Generate query for answers' information
echo "<td>";
echo "\t\t<p id = \"{$ansrow['msg_id']}\" class = 'ans-body'>{$ansrow['msg_body']}</p>\n";
echo "</td>";
echo "</tr>\n";
echo "<tr class = 'user-profile-container'>";
	if (LOGGEDIN && $_SESSION['id'] === $ansrow['usr_id']) {
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
/*

*/
?>

