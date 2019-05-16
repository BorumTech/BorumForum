<?php
	file_exists('../../mysqli_connect.inc.php') ? require_once('../../mysqli_connect.inc.php') : require_once('../../Users/VSpoe/mysqli_connect.inc.php');

	// Generate query for question's information
	$query = '
	SELECT users.id AS usr_id, messages.id AS msg_id, messages.subject AS subject, messages.body AS ques_body, users.profile_picture AS ques_profile_pic, users.first_name AS ques_asker, messages.forum_id, topics.name AS topic
	FROM messages 
	JOIN users 
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
	GROUP BY messages.id';
	$result2 = mysqli_query($dbc, $query2);

	define("QUESNOVOTES", mysqli_num_rows($resultCorr) == 0);

	$page_title = $row['subject'];
	include('includes/header.html');
	include('includes/login_functions.inc.php');
?>
	<h1><?php echo $row['subject']; ?></h1>     </div>
		<div class = "col-sm-10">
		<table id = "question-page-table">
			<tbody>
				<tr>					
					<td class = "vote-container">
					<?php 
						function votedOnQuestion($msg_id, $vote) {
							global $dbc;
							if (isset($_COOKIE['id'])) {
								$query = "SELECT vote FROM `user-message-votes` WHERE user_id = {$_COOKIE['id']} AND message_id = $msg_id ORDER BY id DESC LIMIT 1"; // Select latest vote for the user for the question
								$result = mysqli_query($dbc, $query);
								return mysqli_fetch_array($result, MYSQLI_NUM)[0] == $vote;							
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

						$ques_id = $row['msg_id'];	

						$fillColor = votedOnQuestion($row['msg_id'], 1) ? 'lightgreen' : 'rgb(221, 221, 221)';
						$uparrow = getUpArrow();
						$noAccountVoteUpBtn = getNoAccountButton($uparrow);

						$fillColor = votedOnQuestion($row['msg_id'], -1) ? 'lightgreen' : 'rgb(221, 221, 221)';
						$downarrow = getDownArrow();
						$noAccountVoteDownBtn = getNoAccountButton($downarrow);

						$voteupbtn = isset($_COOKIE['id']) ? "<button type = 'button' id = 'ques-vote-up-btn' onclick = \"loadXMLDoc('up', {$_COOKIE['id']}, $ques_id, 'ques-vote-count')\">$uparrow</button>\n" : $noAccountVoteUpBtn;
						$votedownbtn = isset($_COOKIE['id']) ? "<button type = 'button' id = 'ques-vote-down-btn' onclick = \"loadXMLDoc('down', {$_COOKIE['id']}, $ques_id, 'ques-vote-count')\">$downarrow</button>\n" : $noAccountVoteDownBtn;

						$rowCorr = !QUESNOVOTES ? mysqli_fetch_array($resultCorr, MYSQLI_NUM) : array(NULL, 0);

						echo $voteupbtn;
						echo "\t\t<div class = 'vote-counter' id = 'ques-vote-count'>{$rowCorr[1]}</div>\n";
						echo $votedownbtn;

					?>				
					</td>
					<td>
						<p id = "ques-body"><?php echo $row['ques_body'] ?></p>						
					</td>
				</tr>
				<tr class = 'user-profile-container'>
					<td colspan = "2" class = "question-poster">
						<div>
							<span><?php echo $row['ques_asker'] ?></span>
							<img height = '30' src = '../pages/show_image.php?image=<?php echo $row['ques_profile_pic']?>'>
						</div>	
					</td>
				</tr>
				<tr>
					<td class = "question-tags">
						<a href = "../Topics/<?php echo $row['topic']; ?>"><?php echo $row['topic'] ?></a>
					</td>
				</tr>
				<?php 

					$counter = 1;
					while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
						$ans_id = $row2['msg_id'];

						$fillColor = votedOnQuestion($row2['msg_id'], 1) ? 'lightgreen' : 'rgb(221, 221, 221)';
						$uparrow = getUpArrow();
						$noAccountVoteUpBtn = getNoAccountButton($uparrow);

						$fillColor = votedOnQuestion($row2['msg_id'], -1) ? 'lightgreen' : 'rgb(221, 221, 221)';
						$downarrow = getDownArrow();
						$noAccountVoteDownBtn = getNoAccountButton($downarrow);

						$voteupbtn = isset($_COOKIE['id']) ? "\t<button type = 'button' onclick = \"loadXMLDoc('up', {$_COOKIE['id']}, {$row2['msg_id']}, 'ans-$counter-vote-count')\">$uparrow</button>\n" : $noAccountVoteUpBtn;
						$votedownbtn = isset($_COOKIE['id']) ? "\t\t<button type = 'button' onclick = \"loadXMLDoc('down', {$_COOKIE['id']}, {$row2['msg_id']}, 'ans-$counter-vote-count')\">$downarrow</button>\n" : $noAccountVoteDownBtn; 
						
						echo "<tr>";
						echo "<td>";
						echo $voteupbtn;
            
 						$voteCount = $row2['votes'] == null ? 0 : $row2['votes'];
            
						echo "\t\t<br><div class = 'vote-counter' id = 'ans-$counter-vote-count'>$voteCount</div>";
						echo $votedownbtn;
						echo "</td>";
						// Generate query for answers' information
						echo "<td>";
						echo "\t\t<p class = 'ans-body'>{$row2['msg_body']}</p>\n";
						echo "\t\t<div class = 'ans-poster'>";
						echo "\t\t<span class = 'poster-name'>{$row2['fn']}</span>\n";
						echo "\t\t<img class = 'poster-profile-pic' height = '30' src = '../pages/show_image.php?image={$row2['profile']}'>\n";
						echo "</div>";
						echo "</td>";
						echo "</tr>\n";
						$counter++;
					}

				?>
			</tbody>
		</table>
	<h2>Your Answer</h2>
	<form action = "" method = "post">
	<br>
	<p>
	<textarea name = "answer" cols = '125' rows = '20'></textarea>
	</p>
	<input type = 'submit' value = 'Post your Answer'>
	</form>
	<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			// Validate the form elements
			$ans = mysqli_real_escape_string($dbc, trim($_POST['answer']));
			// Check if its okay for the user to answer the question
			if (isset($_COOKIE['id'])) {
				$user_id = $_COOKIE['id'];
				$q = "SELECT id FROM messages WHERE parent_id = $ques_id AND body = '$ans'";
				$r = mysqli_query($dbc, $q);
				$num = mysqli_num_rows($r);

				if ($num == 0) { // No answers that match this one (no duplicates) on the current question
					$q = "INSERT INTO messages (parent_id, user_id, body, date_entered) VALUES ({$row['msg_id']}, $user_id, '$ans', NOW())";
					mysqli_query($dbc, $q);
				}


			} else {
				redirect_user('../Login');
			}
		}

		mysqli_close($dbc);	
		include('includes/footer.html');
	?>
