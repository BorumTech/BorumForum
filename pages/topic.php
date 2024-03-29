<?php
	require_once('../../mysqli_connect.inc.php');
	include('includes/login_functions.inc.php');

	// Generate query for question's information
	$query = 'SELECT id, name FROM topics WHERE name = "' . $_GET['topic'] . '"';
	$result = mysqli_query($dbc, $query);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

	if (mysqli_num_rows($result) == 0) {
		redirect_user('Topics', TRUE);
	}

	$page_title = $row['name'];
	include('includes/header.html');
?>
<div class = "col-sm-6">
	<h1><?php echo $row['name']; ?></h1>
	<?php

		if (isset($_COOKIE['id'])) {
			$followq = 'SELECT topic_id, user_id FROM `followed-topics` WHERE topic_id = ' . $row['id'] . ' AND user_id = ' . $_COOKIE['id'];
			$followr = mysqli_query($dbc, $followq);
			$following = mysqli_num_rows($followr) == 1;

			$ignoreq = 'SELECT topic_id, user_id FROM `ignored-topics` WHERE topic_id = ' . $row['id'] . ' AND user_id = ' . $_COOKIE['id'];
			$ignorer = mysqli_query($dbc, $ignoreq);
			$ignoring = mysqli_num_rows($ignorer) == 1;
			define('FOLLOWTEXT', $following ? "Unfollow" : "Follow Topic");
			define('IGNORETEXT', $ignoring ? "Unignore" : "Ignore Topic");

			echo "<button id = 'follow-btn' class = 'topic-notif' onclick = \"setTopic({$_COOKIE['id']}, {$row['id']}, 'follow')\">" . FOLLOWTEXT . "</button>";
			echo "<button id = 'ignore-btn' class = 'topic-notif' onclick = \"setTopic({$_COOKIE['id']}, {$row['id']}, 'ignore')\">" . IGNORETEXT . "</button>";
			if (ISADMIN) {
				echo "
				<button id = 'delete-topic-btn'
				onclick =
				\"confirmDeletion()\">
				Delete Topic
				</button>";
				$form = "<button onclick = 'deleteTopic({$row['id']})'>Confirm Deletion</button><button>No</button>";
				echo "<div id = 'delete-confirmation' style = 'display:none; border: 1px solid black; position: absolute; background-color: white; top: 40px; width: 70vw; height: 40vh;'><span style = 'text-align:center; display: table-cell; vertical-align:middle;'>Are you sure you want to delete {$_GET['topic']}?</span><div>$form</div></div>";
			}
		}

		require('includes/pagination_functions.inc.php');

		define('DISPLAY', 10); // Number of records to show per page

		$pages = getPagesValue('id', 'messages', 'WHERE forum_id = ' . $row['id']);
		$start = getStartValue();

		$q = 'SELECT id, subject FROM messages';
		$result = performPaginationQuery($dbc, $q, 'date_entered DESC', $start, 'parent_id = 0 AND forum_id = ' . $row['id']);

		echo "<table class = 'question-list' id = 'latest-questions'>";
		while ($row = @mysqli_fetch_array($result, MYSQLI_ASSOC)) { // Loop through the records in an associative array

			echo "
			<tr><td align = \"left\"><a href = \"../Questions/{$row['id']}\">{$row['subject']}</a></td></tr>
			";

		}
		echo "</table>";

		@mysqli_free_result($result);

		setPreviousAndNextLinks('../Topics/' . $_GET['topic']);

		mysqli_close($dbc);
		include('includes/footer.html');
	?>
