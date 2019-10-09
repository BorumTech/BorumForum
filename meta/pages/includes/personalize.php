<?php 

	// Find url of logged in user's profile picture
	$q3 = "SELECT id, profile_picture FROM users WHERE id = {$_SESSION['id']}";
	$r3 = mysqli_query($dbc, $q3);
	$row3 = mysqli_fetch_array($r3, MYSQLI_NUM);
	$imgurl = '/show_image?image=' . $row3[1];

	// Display Help, Notification bar, and Profile
	echo '
		<a id = "notification-bell" href = "#">
			<img src = "/images/notification-bell-pngrepo-com.png">
		</a>
		<a href = "/users/' . $_SESSION['id'] . '">
			<img src = "' . $imgurl . '">
		</a>
		<div id = "notifications" style = "display:none">';

	// Create notification center
	$questionIds = array();
	$q4 = "SELECT id, subject FROM messages WHERE user_id = {$_SESSION['id']} AND parent_id = 0 ORDER BY date_entered DESC";
	$r4 = mysqli_query($dbc, $q4);

	while ($row4 = mysqli_fetch_array($r4, MYSQLI_ASSOC)) {
		$questionIds[] = $row4['id'];
	}

	$questionIds = implode("', '", $questionIds);
	$q5 = "SELECT messages.id, messages.user_id, messages.parent_id, CONCAT(left(messages.body, 200), '...') AS body, users.first_name, users.profile_picture, DATE_FORMAT(messages.date_entered, '%b %e %Y %T') AS date_posted FROM messages JOIN users ON users.id = messages.user_id WHERE parent_id IN ('$questionIds') ORDER BY date_entered DESC";
	$r5 = mysqli_query($dbc, $q5);

	while ($row5 = mysqli_fetch_array($r5, MYSQLI_ASSOC)) {
		echo "
		<div>
			<a href = '/Questions/{$row5['parent_id']}'>
				<div class = 'info'>
					<img class = 'answerer-profile' src = \"/show_image?image={$row5['profile_picture']}\" height = '20'>
					<span class = 'answerer-profile'>{$row5['first_name']} answered</span>
					<span class = 'date'>{$row5['date_posted']}</span>
				</div>	
				<p>{$row5['body']}<p>
			</a>
		</div>
		";
	} 

	echo '</div>';
?>

