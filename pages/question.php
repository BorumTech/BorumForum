<?php
	file_exists('../../mysqli_connect.inc.php') ? require_once('../../mysqli_connect.inc.php') : require_once('../../Users/VSpoe/mysqli_connect.inc.php');
	// Generate query for question's information
	$query = 'SELECT messages.votes AS votes, messages.id AS msg_id, messages.subject AS subject, messages.body AS ques_body, users.profile_picture AS ques_profile_pic, users.first_name AS ques_asker FROM messages JOIN users ON messages.user_id = users.id WHERE messages.id = ' . $_GET['id'];
	$result = mysqli_query($dbc, $query);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);


	$page_title = $row['subject'];
	include('includes/header.html');
?>
	</div>
	<div class = "col-sm-10">
	<h1><?php echo $row['subject']; ?></h1>

	<div class = "vote col-sm-2">
		<?php 
			$cur_votes = $row['votes'];
			$ques_id = $row['msg_id'];			
			echo "<button type = 'button' onclick = 'loadXMLDoc(\"up\")'>Vote Up</button>";
			echo "<br><span id = 'ques-vote-count'>$cur_votes</span>";
			echo "<br><button type = 'button' onclick = 'loadXMLDoc(\"down\")'>Vote Down</button>";
		?>
	</div>
	<div class = "posts col-sm-8">
		<p><?php echo $row['ques_body'] ?></p>
		<div class = "question-poster">
			<span><?php echo $row['ques_asker'] ?></span>
			<img height = '30' src = '../pages/show_image.php?image=<?php echo $row['ques_profile_pic']?>'>
		</div>
		<div class = "answers">
			<?php 
				// Generate query for answers' information
				$query2 = 'SELECT body FROM messages WHERE parent_id = ' . $_GET['id'];
				$result2 = mysqli_query($dbc, $query2);
				while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
					echo "<p>{$row2['body']}</p>";
				}
			?>
		</div>
	</div>
	<?php

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			// Validate the form elements
			$ans = mysqli_real_escape_string($dbc, trim($_POST['answer']));
			// Check if its okay for the user to answer the question
			if (isset($_COOKIE['id'])) {
				$user_id = $_COOKIE['id'];
				$q = "SELECT id FROM messages WHERE parent_id = {$row['msg_id']} AND body = '$ans'";
				$r = mysqli_query($dbc, $q);
				$num = mysqli_num_rows($result);

				if ($num == 0) { // No answers that match this one (no duplicates) on the current question
					$q = "INSERT INTO messages (parent_id, user_id, body, date_entered) VALUES ({$row['id']}, $user_id, '$ans', NOW())";
					$r = @mysqli_query($dbc, $q);
				}


			} else {
				redirect_user('../Login');
			}
		}

	?>
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
		mysqli_close($dbc);	
		include('includes/footer.html');
	?>