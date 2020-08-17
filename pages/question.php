<?php
	file_exists('../../mysqli_connect.inc.php') ? require_once('../../mysqli_connect.inc.php') : require_once('../../../mysqli_connect.inc.php');

	// Generate query for question's information
	$query = '
	SELECT messages.parent_id, users.id AS usr_id, messages.id AS msg_id, messages.subject AS subject, messages.body AS ques_body, users.profile_picture AS ques_profile_pic, users.first_name AS ques_asker, messages.forum_id, topics.name AS topic
	FROM messages
	LEFT JOIN users
	ON messages.user_id = users.id
	JOIN topics
	ON messages.forum_id = topics.id
	WHERE messages.id = ' . $_GET['id'];
	$result = mysqli_query($dbc, $query);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

	$queryCorr = "SELECT id, SUM(vote), message_id FROM `user-message-votes` WHERE message_id = {$_GET['id']} GROUP BY message_id";
	$resultCorr = mysqli_query($dbc, $queryCorr);

	$query2 = '
	SELECT messages.id AS msg_id, users.id AS usr_id, messages.body AS msg_body, users.profile_picture AS profile, users.first_name AS fn, SUM(`user-message-votes`.vote) AS votes
	FROM messages
	JOIN users
	ON users.id = messages.user_id
	LEFT OUTER JOIN `user-message-votes`
	ON messages.id = `user-message-votes`.`message_id`
	WHERE messages.parent_id = ' . $_GET['id'] . '
	GROUP BY messages.id ORDER BY SUM(`user-message-votes`.vote) DESC';
	$result2 = mysqli_query($dbc, $query2);

	define("QUESNOVOTES", mysqli_num_rows($resultCorr) == 0);

	$page_title = $row['subject'];
	include('includes/header.html');
	include('includes/login_functions.inc.php');
?>
	<div class = "col-sm-10">
	<h1><?php echo $row['subject']; ?></h1>

	<table id = "question-page-table">
		<tbody>
			<tr>
				<td class = "vote-container">
				<!-- PHP Functions -->
				<?php
					/**
					 * Returns whether or not the currently logged in user has voted on the current question
					 * @param $msg_id The id of the ques
					 * @param $vote b
					 */
					function votedOnPost($msg_id, $vote) {
						global $dbc;
						if (isset($_SESSION['id'])) {
							$query = "SELECT vote FROM `user-message-votes` WHERE user_id = {$_SESSION['id']} AND message_id = $msg_id ORDER BY id DESC LIMIT 1"; // Select latest vote for the user for the question
							$result = mysqli_query($dbc, $query);
							return @mysqli_fetch_array($result, MYSQLI_NUM)[0] == $vote;
						}

					}

					function getUpArrow() {
						global $fillColor;
						return '<svg aria-hidden="true" class="svg-icon m0 iconArrowUpLg" width="36" height="36" viewBox="0 0 36 36"><path style = "fill:' . $fillColor . '" d="M2 26h32L18 10z"></path></svg>';
					}

					function getDownArrow() {
						global $fillColor;
						return '<svg aria-hidden="true" class="svg-icon m0 iconArrowDownLg" width="36" height="36" viewBox="0 0 36 36"><path style = "fill:' . $fillColor . '" d="M2 10h32L18 26z"></path></svg>';
					}

					function getNoAccountButton($way) {
						return "\t<button type = 'button' onclick = \"window.location.href = '/Login'\">$way</button>\n";
					}
				?>
				<?php

					$ques_id = $row['msg_id'];

					$fillColor = votedOnPost($ques_id, 1) ? 'lightgreen' : 'rgb(221, 221, 221)';
					$uparrow = getUpArrow();
					$noAccountVoteUpBtn = getNoAccountButton($uparrow);

					$fillColor = votedOnPost($ques_id, -1) ? 'lightgreen' : 'rgb(221, 221, 221)';
					$downarrow = getDownArrow();
					$noAccountVoteDownBtn = getNoAccountButton($downarrow);
					$voteupbtn = isset($_SESSION['id']) ? "<button type = 'button' id = 'ques-vote-up-btn' onclick = \"loadXMLDoc('up', {$_SESSION['id']}, $ques_id, 'ques-vote-count')\">$uparrow</button>\n" : $noAccountVoteUpBtn;
					$votedownbtn = isset($_SESSION['id']) ? "<button type = 'button' id = 'ques-vote-down-btn' onclick = \"loadXMLDoc('down', {$_SESSION['id']}, $ques_id, 'ques-vote-count')\">$downarrow</button>\n" : $noAccountVoteDownBtn;

					$rowCorr = !QUESNOVOTES ? @mysqli_fetch_array($resultCorr, MYSQLI_NUM) : array(NULL, 0);
					echo $voteupbtn;
					echo "\t\t<div class = 'vote-counter' id = 'ques-vote-count'>{$rowCorr[1]}</div>\n";
					echo $votedownbtn;

				?>
				</td>
				<td>
					<p id = "ques-body"><?php echo $row['ques_body'] ?></p>
				</td>
			</tr>
			<tr>
				<td>
					<div class = "question-tags">
						<a href = "../Topics/<?php echo $row['topic']; ?>"><?php echo $row['topic'] ?></a>
					</div>
				</td>
			</tr>
			<tr id = 'ucp-0' class = 'user-profile-container'>
				<?php
				function visibilityProperty() {
					global $row;
					define('SHOWMODIFYLINKS', ISADMIN || (LOGGEDIN && $_SESSION['id'] === $row['usr_id']));
					return SHOWMODIFYLINKS ? 'visibility: visible' : 'visibility: hidden';
				}
				?>
				<td class = "modify-links" style = "<?php echo visibilityProperty(); ?>">
					<a href = "<?php echo $ques_id . '/Edit'; ?>">Edit</a>
					<a href = "<?php echo $ques_id . '/Delete'; ?>">Delete</a>
				</td>
				<?php
					if (ISADMIN || (LOGGEDIN && $_SESSION['id'] === $row['usr_id'])) {
					}
				?>
				<td colspan = "2" class = "question-poster">
					<div>
						<a href = '<?php echo "/Users/{$row['usr_id']}"; ?>'>
							<span><?php echo $row['ques_asker'] ?></span>
						</a>
						<a href = '<?php echo "/Users/{$row['usr_id']}"; ?>'>
							<img height = '30' src = "http://www.bforborum.com/show_image?image=<?php echo isset($row['ques_profile_pic']) ? $row['ques_profile_pic'] : 'unavailable.png'; ?>">
						</a>
					</div>
				</td>
			</tr>
			<?php
				$q = "SELECT comments.body, comments.date_written, comments.usr_id, users.first_name, users.last_name, users.profile_picture AS pr_pi, comments.id FROM comments JOIN users ON users.id = comments.usr_id WHERE msg_id = {$_GET['id']} ORDER BY date_written ASC";
				$r = mysqli_query($dbc, $q);
				if($r && mysqli_num_rows($r) > 0) {
					while ($row = mysqli_fetch_array($r, MYSQLI_BOTH)) {
						echo "<tr id = 'comment-{$row[6]}'><td></td>
						<td class = 'comments'>
						<img style = 'border-radius: 50%;' class = 'comment-profile' src = \"/show_image?image={$row['pr_pi']}\">
						<span style = 'font-weight: bold;'>{$row[3]} {$row[4]}</span>
						<span style = 'margin-left: 10px'>{$row[1]}</span>
						<span>
						<input class=\"edit-button\" type='button' onclick=\"allowCommentEdit({$row[6]})\" value='Edit'>
						<input type='button' onclick=\"deleteComment({$row[6]})\" value='Delete'>
						</span>
						<br><span class=\"comment-body\">{$row['body']}</span>
						</td></tr>";
					}
				}
			ob_start(); ?>
			<tr>
				<td></td>
				<td> <!-- Remove until v1.1.0 -->

					<div class = "new-comment">
						<input type = "text" size = "50" id = 'comment-body' name = 'comment-body'>
						<input type = "button" disabled onclick = "addComment(document.getElementById('comment-body').value, <?php echo $_GET['id']; ?>, <?php echo $_SESSION['id']; ?>)" value = "Add Comment">
					</div>
					<script>
						const commentBodyEl = document.getElementById('comment-body')
						const newCommentBtnEl = commentBodyEl.nextElementSibling;
						
						commentBodyEl.addEventListener('keyup', function(e) {
							if (e.target.value == '') 
								newCommentBtnEl.setAttribute('disabled', true);
							else
								newCommentBtnEl.removeAttribute('disabled');
							
						});
					</script>
				</td>
			</tr>
			<?php
				if(!LOGGEDIN) ob_clean();
				$counter = 1;
				while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
					$ans_id = $row2['msg_id'];
					$fillColor = votedOnPost($row2['msg_id'], 1) ? 'lightgreen' : 'rgb(221, 221, 221)';
					$uparrow = getUpArrow();
					$noAccountVoteUpBtn = getNoAccountButton($uparrow);

					$fillColor = votedOnPost($row2['msg_id'], -1) ? 'lightgreen' : 'rgb(221, 221, 221)';
					$downarrow = getDownArrow();
					$noAccountVoteDownBtn = getNoAccountButton($downarrow);

					$voteupbtn = isset($_SESSION['id']) ? "\t<button type = 'button' onclick = \"loadXMLDoc('up', {$_SESSION['id']}, {$row2['msg_id']}, 'ans-$counter-vote-count')\">$uparrow</button>\n" : $noAccountVoteUpBtn;
					$votedownbtn = isset($_SESSION['id']) ? "\t\t<button type = 'button' onclick = \"loadXMLDoc('down', {$_SESSION['id']}, {$row2['msg_id']}, 'ans-$counter-vote-count')\">$downarrow</button>\n" : $noAccountVoteDownBtn;

					echo "<tr class = 'post-content'>";
					echo "<td>";
					echo $voteupbtn;

						$voteCount = $row2['votes'] == null ? 0 : $row2['votes'];

					echo "\t\t<br><div class = 'vote-counter' id = 'ans-$counter-vote-count'>$voteCount</div>";
					echo $votedownbtn;
					echo "</td>";
					// Generate query for answers' information
					echo "<td>";
					echo "\t\t<p id = \"{$row2['msg_id']}\" class = 'ans-body'>{$row2['msg_body']}</p>\n";
					echo "</td>";
					echo "</tr>\n";
					echo "<tr id = 'upc-$counter' class = 'user-profile-container'>";
						if (LOGGEDIN && $_SESSION['id'] === $row2['usr_id']) {
							$what_to_echo = $row2['msg_id'] . '/Edit';

							echo '<td class = "modify-links">';
							echo "<a href = '$what_to_echo'>Edit</a> ";

							$what_to_echo = $row2['msg_id'] . '/Delete';

							echo "<a href = '$what_to_echo'>Delete</a>";
							echo "</td>";
						}
						echo "<td colspan = \"2\" class = \"question-poster\">
								<div>
									<a href = '/Users/{$row2['usr_id']}'>
										<span>{$row2['fn']}</span>
									</a>
									<a href = '/Users/{$row2['usr_id']}'>
										<img height = '30' src = \"http://www.bforborum.com/pages/show_image.php?image={$row2['profile']}\">
									</a>
								</div>
							</td>
						</tr>";
						$counter++;
					}

				?>
			</tbody>
	</table>
	<h2>Your Answer</h2>
	<p>
		<textarea id = 'your-answer-ta' name = "answer" cols = '125' rows = '20'></textarea>
	</p>
	<input type = 'button' value = 'Post your Answer' onclick = 'answerQuestion(<?php echo $_GET['id']; ?>, document.getElementById("your-answer-ta").value, <?php echo $counter; ?>)'>
	</form>
	<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle all form submissions
			switch ($_POST['action']) {
				case "edit-question":
					if (isset($_POST['subject'])) {
						$sub = mysqli_real_escape_string($dbc, trim($_POST['subject']));
					}
					if (isset($_POST['body'])) {
						$body = mysqli_real_escape_string($dbc, trim($_POST['body']));
					}
					$id = $_POST['id'];

					$query = isset($sub) ? "UPDATE messages SET subject = '$sub', body = '$body' WHERE id = $id" : "UPDATE messages SET body = '$body' WHERE id = $id";
					mysqli_query($dbc, $query);
					break;
			}
		}

		mysqli_close($dbc);
		include('includes/footer.html');
	?>
