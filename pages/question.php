<?php
	file_exists('../../mysqli_connect.inc.php') ? require_once('../../mysqli_connect.inc.php') : require_once('../../Users/VSpoe/mysqli_connect.inc.php');
	include('includes/login_functions.inc.php');

	// Generate query for question's information
	$query = 'SELECT messages.id AS msg_id, messages.votes AS votes, messages.subject AS subject, messages.body AS ques_body, users.profile_picture AS ques_profile_pic, users.first_name AS ques_asker FROM messages JOIN users ON messages.user_id = users.id WHERE messages.id = ' . $_GET['id'];
	$result = mysqli_query($dbc, $query);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$query2 = 'SELECT messages.id AS msg_id, messages.votes AS votes, messages.body AS msg_body, users.profile_picture AS profile, users.first_name AS fn FROM messages JOIN users ON users.id = messages.user_id WHERE parent_id = ' . $_GET['id'];
	$result2 = mysqli_query($dbc, $query2);

	$page_title = $row['subject'];
	include('includes/header.html');
?>
</div>
	<h1><?php echo $row['subject']; ?></h1>
	<div class = "col-sm-10">
		<table>
			<tbody>
				<tr>
					<td>
					<?php 
						$ques_id = $row['msg_id'];			
						echo "<button id = 'vote-up-btn' type = 'button' onclick = \"loadXMLDoc('up', $ques_id, 'ques-vote-count')\">Vote Up</button>\n";
						echo "\t\t<br><span id = 'ques-vote-count'>{$row['votes']}</span>\n";
						echo "\t\t<br><button id = 'vote-down-btn' type = 'button' onclick = \"loadXMLDoc('down', $ques_id, 'ques-vote-count')\">Vote Down</button>\n";

					?>				
					</td>
					<td>
						<p id = "ques-body"><?php echo $row['ques_body'] ?></p>
						<div class = "question-poster">
							<span><?php echo $row['ques_asker'] ?></span>
							<img height = '30' src = '../pages/show_image.php?image=<?php echo $row['ques_profile_pic']?>'>
						</div>	
					</td>
				</tr>
				<?php 

					$counter = 1;
					while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
						echo "<tr>";
						echo "<td>";
						echo "\t<button type = 'button' onclick = \"loadXMLDoc('up', {$row2['msg_id']}, 'ans-$counter-vote-count')\">Vote Up</button>\n";
						echo "\t\t<br><span id = 'ans-$counter-vote-count'>{$row2['votes']}</span>";
						echo "\t\t<br><button type = 'button' onclick = \"loadXMLDoc('down', {$row2['msg_id']}, 'ans-$counter-vote-count')\">Vote Down</button>\n";
						echo "</td>";
						// Generate query for answers' information
						echo "<td>";
						echo "<p id = 'ans-$counter-body'>{$row2['msg_body']}</p>";
						echo "<span class = 'poster-name'>{$row2['fn']}</span>";
						echo "<img class = 'poster-profile-pic' height = '30' src = '../pages/show_image.php?image={$row2['profile']}'>";
						echo "</td>";
						echo "</tr>";
						$counter++;
					}

				?>
			</tbody>
		</table>
	</div>
<div class = "col-sm-10">
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