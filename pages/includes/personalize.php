<?php 

	// Find url of logged in user's profile picture
	$q3 = "SELECT id, profile_picture FROM users WHERE id = {$_COOKIE['id']}";
	$r3 = mysqli_query($dbc, $q3);
	$row3 = mysqli_fetch_array($r3, MYSQLI_NUM);
	$imgurl = '/show_image?image=' . $row3[1];

	// Display Help, Notification bar, and Profile
	echo '
		<a id = "notification-bell" href = "#">
			<img src = "../images/notification-bell-pngrepo-com.png">
		</a>
		<a href = "/users/' . $_COOKIE['id'] . '">
			<img src = "' . $imgurl . '">
		</a>
		<div id = "notifications" style = "display:none">';

	// Create notification center
	$questionIds = array();
	$q4 = "SELECT id, subject FROM messages WHERE user_id = {$_COOKIE['id']} AND parent_id = 0 ORDER BY date_entered DESC";
	$r4 = mysqli_query($dbc, $q4);

	while ($row4 = mysqli_fetch_array($r4, MYSQLI_ASSOC)) {
		$questionIds[] = $row4['id'];
	}

	mysqli_data_seek($r4, 0);

	$questionIds = implode("', '", $questionIds);
	$q5 = "SELECT id, parent_id, body FROM messages WHERE parent_id IN ('$questionIds') ORDER BY date_entered DESC";
	$r5 = mysqli_query($dbc, $q5);

	while ($row5 = mysqli_fetch_array($r5, MYSQLI_ASSOC)) {
		echo "
		<div>
			<a href = '/Questions/{$row5['parent_id']}'>
				<p>{$row5['body']}<p>
			</a>
		</div>
		";
	} 

	echo '</div>';
?>

