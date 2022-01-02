<?php

file_exists('../../mysqli_connect.inc.php') ? require_once('../../mysqli_connect.inc.php') : require_once('../../../mysqli_connect.inc.php');

$id = $_GET['id'];
$query = 'SELECT id, first_name, last_name, profile_picture, bio FROM users WHERE id = ' . $id . ' LIMIT 1';
$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$bio = $row['bio'];


$page_title = "{$row['first_name']}'s Profile";
include('includes/header.html');


echo "<div class = 'col-sm-6'><output name = 'bio' id = 'bio'>$bio</output>";
if (LOGGEDIN && $_COOKIE['id'] == $id) {
	$onclickFunc = "editBio($id)";
	echo "<input type = 'button' id = 'edit-bio-btn' onclick = \"$onclickFunc\" value = 'Edit Bio'>";
}

$query1 = "SELECT id, subject, date_entered FROM messages WHERE parent_id = 0 AND user_id = $id"; // Get questions
$result1 = mysqli_query($dbc, $query1);
echo "<h2>Questions</h2>
<ul>\n";
while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
	echo "\t<li><a href = '/Questions/{$row1['id']}'>{$row1['subject']}</a></li>\n"; // Show questions
}
echo "</ul>\n";

$query1 = "SELECT answers.user_id, questions.subject, questions.id, answers.parent_id FROM messages AS answers JOIN messages AS questions ON questions.id = answers.parent_id HAVING answers.user_id = $id";
$result1 = mysqli_query($dbc, $query1);
echo "<h2>Answers</h2>
<ul>\n";
while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
	echo "\t<li><a href = '/Questions/{$row1['parent_id']}'>{$row1['subject']}</a></li>\n"; // Show answers
}
echo '</ul>
</div>
<div class = "col-sm-2">';
// If the user is viewing his or her own profile
if (LOGGEDIN && $_COOKIE['id'] == $id) {
	include('../pages/upload_image.php');
	echo '
	<form id = "profile-pic" enctype = "multipart/form-data" action = "" method = "post">
		<input type = "hidden" name = "MAX_FILE_SIZE" value = "524288">
		<p>
			<strong>File:</strong>
			<input type = "file" name = "upload" id = "upload">';
			//<label for = "uploads" class = "button">Select a file</label>
		echo '</p>
		<input type = "submit" name = "submit" value = "Submit">
	</form>';
}

// If the user already has a profile picture
if (isset($row['profile_picture'])) {
	echo '<img width = "300" src = "../pages/show_image.php?image=' . $row['profile_picture'] . '">'; // Show it
}

echo "<p>{$row['first_name']} {$row['last_name']}</p>";

echo "<a href = 'http://meta.borumtech.com/Users/{$_GET['id']}'>Meta Profile</a>";

mysqli_free_result ($result);
mysqli_close($dbc);

include('includes/footer.html');
?>
