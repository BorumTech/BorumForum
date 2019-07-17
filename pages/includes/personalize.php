<?php 
	$q = "SELECT id, profile_picture FROM users WHERE id = {$_COOKIE['id']}";
	$r = mysqli_query($dbc, $q);
	$ro = mysqli_fetch_array($r, MYSQLI_NUM);
	$imgurl = '/show_image?image=' . $ro[1];

	echo '
		<a id = "notification-bell" href = "#">
			<img src = "../images/notification-bell-pngrepo-com.png">
		</a>
		<a href = "/users/' . $_COOKIE['id'] . '">
			<img src = "' . $imgurl . '">
		</a>
		<div id = "notifications" style = "display:none">';

	$questionIds = array();
	$q = "SELECT id, subject FROM messages WHERE user_id = {$_COOKIE['id']} AND parent_id = 0 ORDER BY date_entered DESC";
	$r = mysqli_query($dbc, $q);

	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		array_push($questionIds, $row['id']);
	}

	mysqli_data_seek($r, 0);

	$questionIds = implode("', '", $questionIds);
	echo "('$questionIds')";
	$q = "SELECT id, body FROM messages WHERE parent_id IN ('$questionIds') ORDER BY date_entered DESC";
	$r = mysqli_query($dbc, $q);

	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		echo "<div><p>{$row['body']}<p></div>";
	} 

	echo '</div>';
?>

